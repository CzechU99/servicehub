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
    ): Response
    {

      $queryBuilder = $rezerwacje->createQueryBuilder('r')
        ->leftJoin('r.uslugaDoRezerwacji', 'u')
        ->where('r.uzytkownikId = :userId')
        ->setParameter('userId', $this->getUser())
        ->orderBy('r.id', 'DESC');

      $queryBuilder->andWhere('r.uslugaNaWymiane IS NULL');
      $queryBuilder->orWhere('r.uslugaNaWymiane IS NOT NULL');
      $queryBuilder->orWhere('u.uzytkownik = :userId');
      $rezerwacje = $queryBuilder->getQuery()->getResult();

      return $this->render('settings/rezerwacje.html.twig', [
        'rezerwacje' => $rezerwacje
      ]);
    
    }

    #[Route('/rezerwacje_oczekujace', name: 'app_rezerwacje_oczekujace')]
    #[IsGranted('ROLE_USER')]
    public function rezerwacjeOczekujace(
      RezerwacjeRepository $rezerwacje,
    ): Response
    {

      $queryBuilder = $rezerwacje->createQueryBuilder('r')
        ->leftJoin('r.uslugaDoRezerwacji', 'u')
        ->where('r.czyOdrzucona = 0')
        ->andWhere('r.czyAnulowana = 0')
        ->andWhere('r.czyPotwierdzona = 0')
        ->andWhere('(
          r.uzytkownikId = :userId
          OR r.uslugaNaWymiane IS NULL 
          OR r.uslugaNaWymiane IS NOT NULL 
          OR u.uzytkownik = :userId
        )')
        ->setParameter('userId', $this->getUser())
        ->orderBy('r.id', 'DESC');
      
      $rezerwacje = $queryBuilder->getQuery()->getResult();

      return $this->render('settings/rezerwacje.html.twig', [
        'rezerwacje' => $rezerwacje
      ]);
    
    }

    #[Route('/rezerwacje_odrzucone', name: 'app_rezerwacje_odrzucone')]
    #[IsGranted('ROLE_USER')]
    public function rezerwacjeOdrzucone(
      RezerwacjeRepository $rezerwacje,
    ): Response
    {

      $queryBuilder = $rezerwacje->createQueryBuilder('r')
        ->leftJoin('r.uslugaDoRezerwacji', 'u')
        ->where('r.czyOdrzucona = 1')
        ->andWhere('(
          r.uzytkownikId = :userId
          OR r.uslugaNaWymiane IS NULL 
          OR r.uslugaNaWymiane IS NOT NULL 
          OR u.uzytkownik = :userId
        )')
        ->setParameter('userId', $this->getUser())
        ->orderBy('r.id', 'DESC');
      
      $rezerwacje = $queryBuilder->getQuery()->getResult();

      return $this->render('settings/rezerwacje.html.twig', [
        'rezerwacje' => $rezerwacje
      ]);
    
    }

    #[Route('/rezerwacje_anulowane', name: 'app_rezerwacje_anulowane')]
    #[IsGranted('ROLE_USER')]
    public function rezerwacjeAnulowane(
      RezerwacjeRepository $rezerwacje,
    ): Response
    {

      $queryBuilder = $rezerwacje->createQueryBuilder('r')
        ->leftJoin('r.uslugaDoRezerwacji', 'u')
        ->where('r.czyAnulowana = 1')
        ->andWhere('(
          r.uzytkownikId = :userId
          OR r.uslugaNaWymiane IS NULL 
          OR r.uslugaNaWymiane IS NOT NULL 
          OR u.uzytkownik = :userId
        )')
        ->setParameter('userId', $this->getUser())
        ->orderBy('r.id', 'DESC');
      
      $rezerwacje = $queryBuilder->getQuery()->getResult();

      return $this->render('settings/rezerwacje.html.twig', [
        'rezerwacje' => $rezerwacje
      ]);
    
    }

    #[Route('/rezerwacje_potwierdzone', name: 'app_rezerwacje_potwierdzone')]
    #[IsGranted('ROLE_USER')]
    public function rezerwacjePotwierdzone(
      RezerwacjeRepository $rezerwacje,
    ): Response
    {

      $queryBuilder = $rezerwacje->createQueryBuilder('r')
        ->leftJoin('r.uslugaDoRezerwacji', 'u')
        ->where('r.czyPotwierdzona = 1')
        ->andWhere('(
          r.uzytkownikId = :userId
          OR r.uslugaNaWymiane IS NULL 
          OR r.uslugaNaWymiane IS NOT NULL 
          OR u.uzytkownik = :userId
        )')
        ->setParameter('userId', $this->getUser())
        ->orderBy('r.id', 'DESC');
      
      $rezerwacje = $queryBuilder->getQuery()->getResult();

      return $this->render('settings/rezerwacje.html.twig', [
        'rezerwacje' => $rezerwacje
      ]);
    
    }

    #[Route('/rezerwacje_innych_bez', name: 'app_rezerwacje_innych_bez')]
    #[IsGranted('ROLE_USER')]
    public function rezerwacjeInnychBezWymiany(
      RezerwacjeRepository $rezerwacje,
    ): Response
    {

      $rezerwacjeInnychBezWymiany = $rezerwacje->createQueryBuilder('r')
        ->join('r.uslugaDoRezerwacji', 'u')
        ->where('u.uzytkownik = :userId')
        ->andWhere('r.uslugaNaWymiane IS NULL')
        ->setParameter('userId', $this->getUser())
        ->orderBy('r.id', 'DESC')
        ->getQuery()
        ->getResult();

      return $this->render('settings/rezerwacje.html.twig', [
        'rezerwacje' => $rezerwacjeInnychBezWymiany,
      ]);
    
    }

    #[Route('/rezerwacje_innych_z', name: 'app_rezerwacje_innych_z')]
    #[IsGranted('ROLE_USER')]
    public function rezerwacjeInnychZWymiana(
      RezerwacjeRepository $rezerwacje,
    ): Response
    {

      $rezerwacjeInnychZWymiana = $rezerwacje->createQueryBuilder('r')
        ->join('r.uslugaDoRezerwacji', 'u')
        ->where('u.uzytkownik = :userId')
        ->andWhere('r.uslugaNaWymiane IS NOT NULL')
        ->setParameter('userId', $this->getUser())
        ->orderBy('r.id', 'DESC')
        ->getQuery()
        ->getResult();

      return $this->render('settings/rezerwacje.html.twig', [
        'rezerwacje' => $rezerwacjeInnychZWymiana,
      ]);
    
    }

    #[Route('/rezerwacje_ciebie_z', name: 'app_rezerwacje_ciebie_z')]
    #[IsGranted('ROLE_USER')]
    public function rezerwacjePrzezCiebieZWymiana(
      RezerwacjeRepository $rezerwacje,
    ): Response
    {

      $rezerwacjePrzezCiebieZWymiana = $rezerwacje->createQueryBuilder('r')
        ->where('r.uzytkownikId = :userId')
        ->andWhere('r.uslugaNaWymiane IS NOT NULL')
        ->setParameter('userId', $this->getUser())
        ->orderBy('r.id', 'DESC')
        ->getQuery()
        ->getResult();

      return $this->render('settings/rezerwacje.html.twig', [
        'rezerwacje' => $rezerwacjePrzezCiebieZWymiana,
      ]);
    
    }

    #[Route('/rezerwacje_ciebie_bez', name: 'app_rezerwacje_ciebie_bez')]
    #[IsGranted('ROLE_USER')]
    public function rezerwacjePrzezCiebieBezWymiany(
      RezerwacjeRepository $rezerwacje,
    ): Response
    {

      $rezerwacjePrzezCiebieBezWymiany = $rezerwacje->createQueryBuilder('r')
        ->where('r.uzytkownikId = :userId')
        ->andWhere('r.uslugaNaWymiane IS NULL')
        ->setParameter('userId', $this->getUser())
        ->orderBy('r.id', 'DESC')
        ->getQuery()
        ->getResult();

      return $this->render('settings/rezerwacje.html.twig', [
        'rezerwacje' => $rezerwacjePrzezCiebieBezWymiany,
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
      $rezerwacjaDoPotwierdzenia->setCzyOdrzucona(false);
      $rezerwacjaDoPotwierdzenia->setCzyAnulowana(false);
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
      $rezerwacjaDoPotwierdzenia->setCzyOdrzucona(false);
      $rezerwacjaDoPotwierdzenia->setCzyAnulowana(true);
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
