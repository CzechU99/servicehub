<?php

namespace App\Controller;

use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(
        AuthenticationUtils $utils
    ): Response
    {
        $lastUsername = $utils->getLastUsername();
        $error = $utils->getLastAuthenticationError();

        if($this->getUser()){
            return $this->redirectToRoute('app_skills_list'); 
        }

        return $this->render('login/index.html.twig', [
            'lastUsername' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {
    }

    #[Route('/email_verify', name: 'app_email_verify')]
    public function changePassword()
    {
        return $this->render('login/email_verify.html.twig', [ 
        ]);
    }

    #[Route('/send_email', name: 'app_send_email')]
    public function sendEmail(
        UserRepository $users,
        MailerInterface $mailer
    ): Response
    {
        if (isset($_POST['email']) && $users->findOneBy(['email' => $_POST['email']]) !== null) {

            $user = $users->findOneBy(['email' => $_POST['email']]);
            $userEmail = $user->getEmail();

            $email = (new Email())
                ->from('nor-replay@skills.com')
                ->to($userEmail)
                ->subject('Zresetuj hasło')
                ->text('Kliknij w link, aby zresetować hasło')
                ->html('<a href="http://localhost/servicehub/public/index.php/reset_password/'.$user->getId().'">Zresetuj hasło</a>');

            $mailer->send($email);
            
            $this->addFlash('success', 'Wysłano wiadomość e-mail!');
            return $this->redirectToRoute('app_login');
        }else{
            $this->addFlash('error', 'Nie znaleziono adresu e-mail!');
            return $this->redirectToRoute('app_email_verify');
        }

    }

    #[Route('/reset_password/{id}', name: 'app_reset_password')]
    public function resetPassword(
        int $id,
        UserRepository $users,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $userPasswordHasher
    ): Response
    {
        $user = $users->find($id);
        if(isset($_POST['password']) && $_POST['password'] == $_POST['passwordRepeat'] && $users->find($id)){   
            $user->setPassword($userPasswordHasher->hashPassword($user, $_POST['password']));
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Hasło zostało zmienione!');
            return $this->redirectToRoute('app_login');
        }
        
        if(isset($_POST['password']) && $_POST['password'] != $_POST['passwordRepeat'] && $users->find($id)){
            $this->addFlash('error', 'Hasła nie są identyczne!');
        }
        
        return $this->render('login/reset_password.html.twig', [
            'user' => $user
        ]);

    }
}
