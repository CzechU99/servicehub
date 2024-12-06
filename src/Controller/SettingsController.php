<?php

namespace App\Controller;

use App\Form\DaneFormType;
use App\Entity\DaneUzytkownika;
use App\Service\GeocoderService;
use App\Repository\UslugiRepository;
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

}
