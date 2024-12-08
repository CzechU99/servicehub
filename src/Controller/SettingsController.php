<?php

namespace App\Controller;

use App\Form\DaneFormType;
use App\Entity\DaneUzytkownika;
use App\Service\GeocoderService;
use App\Repository\UslugiRepository;
use App\Repository\RezerwacjeRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DaneUzytkownikaRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SettingsController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    #[IsGranted('ROLE_USER')]
    public function index(
      DaneUzytkownikaRepository $daneUzytkownika,
      Request $request,
      GeocoderService $geocoderService,
      EntityManagerInterface $entityManager
    ): Response
    {

      $dane = $daneUzytkownika->findOneBy(['uzytkownik' => $this->getUser()]);

      if(!$dane) {
        $dane = new DaneUzytkownika();
        $dane->setUzytkownik($this->getUser());
      }

      $form = $this->createForm(DaneFormType::class, $dane);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        
        if(empty($dane->getDlugoscGeograficzna())){
        
          $address = sprintf('%s %s, %s', 
            $form->get('kod_pocztowy')->getData(),
            $form->get('miasto')->getData(),
            'Poland'
          );

          $coordinates = $geocoderService->geocode($address);

          if ($coordinates) {
              $dane->setSzerokoscGeograficzna($coordinates['latitude']);
              $dane->setDlugoscGeograficzna($coordinates['longitude']);
          }

        }
        
        $entityManager->persist($dane);
        $entityManager->flush();

        $this->addFlash('success', 'DANE ZOSTAŁY ZAPISANE');

        return $this->redirectToRoute('app_profile');
      }

      return $this->render('settings/profile.html.twig', [
        'daneForm' => $form->createView(),
      ]);
    
    }

    #[Route('/myservices', name: 'app_myservices')]
    #[IsGranted('ROLE_USER')]
    public function services(
      UslugiRepository $uslugi,
      DaneUzytkownikaRepository $daneUzytkownika
    ): Response
    {

      $uslugiUzytkownika = $uslugi->findBy(['uzytkownik' => $this->getUser()]);
      $daneUzytkownika = $daneUzytkownika->findOneBy(['uzytkownik' => $this->getUser()]);

      return $this->render('settings/myservices.html.twig', [
        'uslugiUzytkownika' => $uslugiUzytkownika,
        'daneUzytkownika' => $daneUzytkownika,
      ]);
    
    }

    #[Route('/rezerwacje', name: 'app_rezerwacje')]
    #[IsGranted('ROLE_USER')]
    public function rezerwacje(
      RezerwacjeRepository $rezerwacje,
      EntityManagerInterface $entityManager,
    ): Response
    {

      $rezerwacjePrzezCiebie = $rezerwacje->findBy(
        ['uzytkownikId' => $this->getUser()],
        ['id' => 'DESC'] 
      );

      $rezerwacjaInnych = $rezerwacje->createQueryBuilder('r')
        ->join('r.uslugaDoRezerwacji', 'u')
        ->where('u.uzytkownik = :userId')
        ->andWhere('r.czyOdrzucona = true')
        ->setParameter('userId', $this->getUser())
        ->orderBy('r.id', 'DESC')
        ->getQuery()
        ->getResult();

      return $this->render('settings/rezerwacje.html.twig', [
        'rezerwacjePrzezCiebie' => $rezerwacjePrzezCiebie,
        'rezerwacjePrzezInnych' => $rezerwacjaInnych
      ]);
    
    }

    #[Route('/usun_rezerwacje/{idRezerwacji}', name: 'app_usun_rezerwacje')]
    #[IsGranted('ROLE_USER')]
    public function usunRezerwacje(
      RezerwacjeRepository $rezerwacje,
      EntityManagerInterface $entityManager,
      int $idRezerwacji,
    ): Response
    {

      $rezerwacjaDoUsuniecia = $rezerwacje->findOneBy([
        'id' => $idRezerwacji,
        'uzytkownikId' => $this->getUser(), 
      ]);

      $entityManager->remove($rezerwacjaDoUsuniecia);
      $entityManager->flush();
      
      return $this->redirectToRoute('app_rezerwacje');

    }

    #[Route('/potwierdz_rezerwacje/{idRezerwacji}', name: 'app_potwierdz_rezerwacje')]
    #[IsGranted('ROLE_USER')]
    public function potwierdzRezerwacje(
      RezerwacjeRepository $rezerwacje,
      EntityManagerInterface $entityManager,
      int $idRezerwacji,
    ): Response
    {

      $rezerwacjaDoPotwierdzenia = $rezerwacje->findOneBy([
        'id' => $idRezerwacji,
      ]);

      $rezerwacjaDoPotwierdzenia->setCzyPotwierdzona(true);
      $entityManager->flush();
      
      return $this->redirectToRoute('app_rezerwacje');

    }

    #[Route('/anuluj_rezerwacje/{idRezerwacji}', name: 'app_anuluj_rezerwacje')]
    #[IsGranted('ROLE_USER')]
    public function anulujRezerwacje(
      RezerwacjeRepository $rezerwacje,
      EntityManagerInterface $entityManager,
      int $idRezerwacji,
    ): Response
    {

      $rezerwacjaDoPotwierdzenia = $rezerwacje->findOneBy([
        'id' => $idRezerwacji,
      ]);

      $rezerwacjaDoPotwierdzenia->setCzyPotwierdzona(false);
      $rezerwacjaDoPotwierdzenia->setCzyAnulowana(false);
      $entityManager->flush();
      
      return $this->redirectToRoute('app_rezerwacje');

    }

    #[Route('/odrzuc_rezerwacje/{idRezerwacji}', name: 'app_odrzuc_rezerwacje')]
    #[IsGranted('ROLE_USER')]
    public function odrzucRezerwacje(
      RezerwacjeRepository $rezerwacje,
      EntityManagerInterface $entityManager,
      int $idRezerwacji,
    ): Response
    {

      $rezerwacjaDoPotwierdzenia = $rezerwacje->findOneBy([
        'id' => $idRezerwacji,
      ]);

      $rezerwacjaDoPotwierdzenia->setCzyPotwierdzona(false);
      $rezerwacjaDoPotwierdzenia->setCzyAnulowana(false);
      $rezerwacjaDoPotwierdzenia->setCzyOdrzucona(true);
      $entityManager->flush();
      
      return $this->redirectToRoute('app_rezerwacje');

    }

}
