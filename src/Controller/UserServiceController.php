<?php

namespace App\Controller;

use App\Repository\UslugiRepository;
use App\Form\SzybkieSzukanieFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserServiceController extends AbstractController
{
    #[Route('/service_view/{idUslugi}', name: 'app_service_view')]
    public function register(
        int $idUslugi,
        UslugiRepository $uslugi
    ): Response
    {

      $usluga = $uslugi->find($idUslugi);

      $path = 'zdjeciaUslug/' . $usluga->getUzytkownik()->getId() . '/' . $idUslugi;  

      $wszystkiePliki = scandir($path);
      $nazwyZdjec = [];

      foreach ($wszystkiePliki as $plik) {
          if (in_array(pathinfo($plik, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
              $nazwyZdjec[] = $plik;
          }
      }

      $form = $this->createForm(SzybkieSzukanieFormType::class);

      return $this->render('userservice/service_view.html.twig', [
        'szybkieSzukanieForm' => $form->createView(),
        'usluga' => $usluga,
        'zdjecia' => $nazwyZdjec
      ]);
      
    }
}
