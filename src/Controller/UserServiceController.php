<?php

namespace App\Controller;

use App\Form\AddServiceFormType;
use App\Repository\UslugiRepository;
use App\Form\SzybkieSzukanieFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
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

    #[Route('/add_skill', name: 'app_add_skill')]
    #[IsGranted('ROLE_USER')]
    public function addSkill(
        EntityManagerInterface $entityManager,
        Request $request
    ): Response
    {
        $form = $this->createForm(AddServiceFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            
            
            // $skill = $form->getData();
            // $skill->setUser($this->getUser());
            // $skill->setCreated(new DateTime());
            // $entityManager->persist($skill);
            // $entityManager->flush();

            // return $this->redirectToRoute('app_skills_list');
        }

        return $this->render('userservice/add_skill.html.twig', [
            'dodajUslugeForm' => $form->createView()
        ]);
    }

}
