<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SettingsController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {

      if($this->getUser() == null)
      {
        return $this->redirectToRoute('app_login');
      }

      return $this->render('settings/profile.html.twig', [
      ]);
    
    }

    #[Route('/myservices', name: 'app_myservices')]
    public function services(): Response
    {

      if($this->getUser() == null)
      {
        return $this->redirectToRoute('app_login');
      }

      return $this->render('settings/myservices.html.twig', [
      ]);
    
    }

}
