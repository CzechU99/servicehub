<?php

namespace App\Controller;

use App\Service\GeocoderService;
use App\Form\WyszukiwanieFormType;
use App\Repository\UserRepository;
use App\Repository\UslugiRepository;
use App\Form\SzybkieSzukanieFormType;
use App\Repository\KategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(
        UserRepository $user,
        UslugiRepository $uslugi
    ): Response
    {

        $wszystkieUslugi = $uslugi->findAll();
        $uzytkownicy = $user->findAll();

        $form = $this->createForm(SzybkieSzukanieFormType::class);

        return $this->render('main/index.html.twig', [
            'szybkieSzukanieForm' => $form->createView(),
            'uzytkownicy' => $uzytkownicy,
            'wszystkieUslugi' => $wszystkieUslugi,
        ]);

    }

    #[Route('/skills_list', name: 'app_skills_list')]
    public function skillsList(
        UslugiRepository $uslugi,
        Request $request,
        KategorieRepository $kategorie
    ): Response
    {

        $form = $this->createForm(WyszukiwanieFormType::class);

        $szybkiFormularz = $this->createForm(SzybkieSzukanieFormType::class);
        $szybkiFormularz->handleRequest($request);

        $filteredUslugi = $uslugi->findAll();
        $wszystkieKategorie = $kategorie->findAll();

        if ($szybkiFormularz->isSubmitted() && $szybkiFormularz->isValid()) {
            $searchTerm = $szybkiFormularz->get('nazwaUslugi')->getData();

            $filteredUslugi = $uslugi->createQueryBuilder('u')
                ->where('u.nazwaUslugi LIKE :searchTerm')
                ->setParameter('searchTerm', '%' . $searchTerm . '%')
                ->getQuery()
                ->getResult();
        }else{
            $searchTerm = "";
        }

        $form->get('nazwaUslugi')->setData($searchTerm);

        return $this->render('main/skills_list.html.twig', [
            'wyszukiwanieForm' => $form->createView(),
            'uslugi' => $filteredUslugi,
            'daneUzytkownika' => $searchTerm,
            'kategorie' => $wszystkieKategorie,
        ]);

    }

    #[Route('/filtrowane_uslugi_list', name: 'app_filtrowane_uslugi_list')]
    public function filtrowaneUslugiList(
        UslugiRepository $uslugi,
        Request $request,
        KategorieRepository $kategorie,
        GeocoderService $geocoderService,
        EntityManagerInterface $entityManager
    ): Response
    {

        $form = $this->createForm(WyszukiwanieFormType::class);
        $form->handleRequest($request);

        $filteredUslugi = $uslugi->findAll();
        $wszystkieKategorie = $kategorie->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            
            $data = $form->getData();

            $uslugiQuery = $uslugi->createQueryBuilder('u')
                ->leftJoin('u.kategorie', 'k') 
                ->leftJoin('u.uzytkownik', 'us')
                ->leftJoin('us.daneUzytkownika', 'd') 
                ->where('u.nazwaUslugi LIKE :nazwa')
                ->setParameter('nazwa', '%' . $data['nazwaUslugi'] . '%');

            if ($data['cenaMin']) {
                $uslugiQuery->andWhere('u.cena >= :cenaMin')
                    ->setParameter('cenaMin', $data['cenaMin']);
            }

            if ($data['cenaMax']) {
                $uslugiQuery->andWhere('u.cena <= :cenaMax')
                    ->setParameter('cenaMax', $data['cenaMax']);
            }

            if ($data['kategorie']) {
                $uslugiQuery->andWhere('k.id = :kategorie')
                    ->setParameter('kategorie', $data['kategorie']);
            }

            if ($data['lokalizacja']) {
                $lokalizacja = $data['lokalizacja'];

                $commaPosition = strpos($lokalizacja, ',');

                if ($commaPosition !== false) {
                    $lokalizacja = substr($lokalizacja, 0, $commaPosition);
                }

                $connection = $entityManager->getConnection();

                if($data['dystans']){
                
                    $coordinates = $geocoderService->geocode($lokalizacja);

                    if($coordinates){

                        $sql = '
                            SELECT * FROM dane_uzytkownika WHERE ST_Distance_Sphere(POINT(dlugosc_geograficzna, szerokosc_geograficzna), POINT(:longitude, :latitude)) <= :distance
                        ';

                        $stmt = $connection->prepare($sql);

                        $result = $stmt->executeQuery([
                            'longitude' => $coordinates['longitude'],  
                            'latitude' => $coordinates['latitude'],
                            'distance' => ($data['dystans'] * 1000) * 0.80,  
                        ]);

                    }

                }else{
                
                    $sql = 'SELECT * FROM dane_uzytkownika WHERE miasto = :lokalizacja';

                    $stmt = $connection->prepare($sql);

                    $result = $stmt->executeQuery([
                        'lokalizacja' => $lokalizacja,  
                    ]);
                
                }

                $uslugiFiltered = $result->fetchAllAssociative();

                $uzytkownikIds = array_column($uslugiFiltered, 'uzytkownik_id');

                $filteredUslugi = $uslugiQuery
                    ->andWhere('u.uzytkownik IN (:uzytkownikIds)')
                    ->setParameter('uzytkownikIds', $uzytkownikIds);

            }

            $filteredUslugi = $uslugiQuery->getQuery()->getResult();

        }

        return $this->render('main/skills_list.html.twig', [
            'wyszukiwanieForm' => $form->createView(),
            'uslugi' => $filteredUslugi,
            'kategorie' => $wszystkieKategorie,
        ]);

    }

    #[Route('/filter_reset', name: 'app_filter_reset')]
    public function filterReset(
        UserRepository $user,
        UslugiRepository $uslugi,
        KategorieRepository $kategorie
    ): Response
    {

        $wszystkieUslugi = $uslugi->findAll();
        $wszystkieKategorie = $kategorie->findAll();

        $form = $this->createForm(WyszukiwanieFormType::class);

        return $this->render('main/skills_list.html.twig', [
            'wyszukiwanieForm' => $form->createView(),
            'uslugi' => $wszystkieUslugi,
            'kategorie' => $wszystkieKategorie,
        ]);

    }

}
