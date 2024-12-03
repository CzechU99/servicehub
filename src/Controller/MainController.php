<?php

namespace App\Controller;

use App\Repository\UslugiRepository;
use App\Repository\DaneUzytkownikaRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
        ]);
    }

    #[Route('/skills_list', name: 'app_skills_list')]
    public function skillsList(
        UslugiRepository $uslugi,
        DaneUzytkownikaRepository $daneUzytkownika,
        // UserRepository $user
    ): Response
    {

        // $uslugiList = $uslugi->createQueryBuilder('u')
        //     ->select('u', 'user', 'dane')
        //     ->join('u.uzytkownik', 'user') // Połączenie Uslugi -> User
        //     ->join('user.daneUzytkownika', 'dane') // Połączenie User -> DaneUzytkownika
        //     ->getQuery()
        //     ->getResult();

        $wszystkieUslugi = $uslugi->findAll();

        return $this->render('main/skills_list.html.twig', [
            'uslugi' => $wszystkieUslugi
            // 'uslugi' => $uslugiList
        ]);
    }

    #[Route('/add_skill', name: 'app_add_skill')]
    #[IsGranted('ROLE_USER')]
    public function addSkill(
        // EntityManagerInterface $entityManager,
        // Request $request
    ): Response
    {
        // $form = $this->createForm(AddPostFormType::class);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $skill = $form->getData();
        //     $skill->setUser($this->getUser());
        //     $skill->setCreated(new DateTime());
        //     $entityManager->persist($skill);
        //     $entityManager->flush();

        //     return $this->redirectToRoute('app_skills_list');
        // }

        return $this->render('main/add_skill.html.twig', [
            // 'form' => $form->createView()
        ]);
    }

    

}
