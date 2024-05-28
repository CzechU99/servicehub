<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Skill;
use App\Form\AddPostFormType;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
        SkillRepository $skills
    ): Response
    {
        return $this->render('main/skills_list.html.twig', [
            'skills' => $skills->findAll()
        ]);
    }

    #[Route('/add_skill', name: 'app_add_skill')]
    #[IsGranted('ROLE_USER')]
    public function addSkill(
        SkillRepository $skills,
        EntityManagerInterface $entityManager,
        Request $request
    ): Response
    {
        $form = $this->createForm(AddPostFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $skill = $form->getData();
            $skill->setUser($this->getUser());
            $skill->setCreated(new DateTime());
            $entityManager->persist($skill);
            $entityManager->flush();

            return $this->redirectToRoute('app_skills_list');
        }

        return $this->render('main/add_skill.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/app_my_skills_list', name: 'app_my_skills_list')]
    #[IsGranted('ROLE_USER')]
    public function mySkillList(
        SkillRepository $skills
    ): Response
    {

        $skillsList = $skills->findBy(['user' => $this->getUser()]);

        return $this->render('main/my_skill_list.html.twig', [
            'skills' => $skillsList
        ]);
    }

    #[Route('/delete_skill/{id}', name: 'app_delete_skill')]
    #[IsGranted('ROLE_USER')]
    public function deleteSkill(
        SkillRepository $skills,
        EntityManagerInterface $entityManager,
        Skill $id
    ): Response{

        $skill = $skills->find($id);
        $entityManager->remove($skill);
        $entityManager->flush();

        $skillsList = $skills->findBy(['user' => $this->getUser()]);

        return $this->render('main/my_skill_list.html.twig', [
            'skills' => $skillsList
        ]);
    }

    #[Route('/edit_skill/{id}', name: 'app_edit_skill')]
    #[IsGranted('ROLE_USER')]
    public function editSkill(
        Skill $id,
        SkillRepository $skills,
        EntityManagerInterface $entityManager,
        Request $request
    ): Response
    {
        $form = $this->createForm(AddPostFormType::class);
        $form->handleRequest($request);

        $skill = $skills->find($id);

        if ($form->isSubmitted() && $form->isValid()) {
            $skill->setTitle($form->get('title')->getData());
            $skill->setLevel($form->get('level')->getData());
            $skill->setDescription($form->get('description')->getData());
            $skill->setCreated(new DateTime());
            $entityManager->persist($skill);
            $entityManager->flush();

            return $this->redirectToRoute('app_my_skills_list');
        }

        return $this->render('main/edit_skill.html.twig', [
            'form' => $form->createView(),
            'skill' => $skill
        ]);
    }

}
