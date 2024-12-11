<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginFormType;
use Symfony\Component\Mime\Email;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Form\ResetPasswordFormType;
use App\Form\PasswordReminderFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(
        AuthenticationUtils $utils,
        Request $request,
    ): Response
    {

        if($this->getUser()){
            return $this->redirectToRoute('app_skills_list'); 
        }

        $form = $this->createForm(LoginFormType::class);
        $form->handleRequest($request);

        $lastUsername = $utils->getLastUsername();
        $error = $utils->getLastAuthenticationError();

        return $this->render('login/index.html.twig', [
            'loginForm' => $form,
            'lastUsername' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {
    }

    #[Route('/send_email', name: 'app_send_email')]
    public function sendEmail(
        UserRepository $users,
        MailerInterface $mailer,
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response
    {

        $form = $this->createForm(PasswordReminderFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $email = $form->get('email')->getData();
            $user = $users->findOneBy(['email' => $email]);

            if ($user) {
                $resetToken = bin2hex(random_bytes(32));
                $expiresAt = new \DateTime('+1 hour');

                $user->setResetToken($resetToken);
                $user->setResetTokenWaznosc($expiresAt);
                
                $entityManager->persist($user);
                $entityManager->flush();

                $resetLink = $this->generateUrl('app_reset_password', ['token' => $resetToken], UrlGeneratorInterface::ABSOLUTE_URL);
                
                $emailMessage = (new Email())
                    ->from('no-reply@servicehub.com')
                    ->to($user->getEmail())
                    ->subject('Zresetuj swoje hasło')
                    ->html('<p>Kliknij poniższy link, aby zresetować swoje hasło:</p><p><a href="' . $resetLink . '">Zresetuj hasło</a></p>');

                $mailer->send($emailMessage);

                $this->addFlash('success', 'Wysłano wiadomość z resetowaniem hasła!');
                return $this->redirectToRoute('app_login');
            }

            $this->addFlash('error', 'Nie znaleziono takiego adresu e-mail!');

        }

        return $this->render('login/email_verify.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    #[Route('/reset_password/{token}', name: 'app_reset_password')]
    public function resetPassword(
        string $token,
        Request $request,
        UserRepository $users,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager, 
    ): Response
    {
        $user = $users->findOneBy(['resetToken' => $token]);

        if (!$user || $user->getResetTokenWaznosc() < new \DateTime()) {
            $this->addFlash('error', 'Token jest nieprawidłowy lub wygasł!');
            return $this->redirectToRoute('app_send_email');
        }

        $form = $this->createForm(ResetPasswordFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $newPassword = $form->get('password')->getData();
            $encodedPassword = $userPasswordHasher->hashPassword($user, $newPassword);
            $user->setPassword($encodedPassword);

            $user->setResetToken(null);
            $user->setResetTokenWaznosc(null);

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Hasło zostało zmienione!');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('login/reset_password.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request, 
        UserPasswordHasherInterface $userPasswordHasher, 
        EntityManagerInterface $entityManager
    ): Response
    {

        if($this->getUser()){
            return $this->redirectToRoute('app_skills_list'); 
        }

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            $userId = $user->getId();
            $folderPath = $this->getParameter('kernel.project_dir') . '/public/zdjeciaUslug/' . $userId;

            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            $this->addFlash('success', 'Zarejestrowano pomyślnie! Możesz się zalogować.');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('login/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    
}
