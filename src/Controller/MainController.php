<?php

namespace App\Controller;

use App\Repository\UslugiRepository;
use App\Repository\UserRepository;
use App\Form\SzybkieSzukanieFormType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\DaneUzytkownikaRepository;
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
        Request $request
    ): Response
    {

        $form = $this->createForm(SzybkieSzukanieFormType::class);
        $form->handleRequest($request);

        $filteredUslugi = $uslugi->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $searchTerm = $form->get('nazwaUslugi')->getData();

            $filteredUslugi = $uslugi->createQueryBuilder('u')
                ->where('u.nazwaUslugi LIKE :searchTerm')
                ->setParameter('searchTerm', '%' . $searchTerm . '%')
                ->getQuery()
                ->getResult();

        }

        $searchTerm = "";

        return $this->render('main/skills_list.html.twig', [
            'uslugi' => $filteredUslugi,
            'daneUzytkownika' => $searchTerm
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
