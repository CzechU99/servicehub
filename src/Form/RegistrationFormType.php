<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Wpisz adres email!',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',
                        'message' => 'Niepoprawny adres email!'
                    ])
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Musisz zaakceptować regulamin!',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Hasła muszą być takie same!',
                'attr' => ['autocomplete' => 'new-password'],
                'first_options' => [
                    'label' => 'Password',
                    'mapped' => false
                ],
                'second_options' => [
                    'label' => 'Powtórz hasło',
                    'mapped' => false
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Wpisz hasło!',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Twoje hasło musi mieć min. {{ limit }} znaków!',
                        'max' => 15,
                        'maxMessage' => 'Twoje hasło może mieć maks. {{ limit }} znaków!',
                    ]),
                    new Regex([
                        'pattern' => '/[A-Z]/',
                        'message' => 'Hasło musi zawierać dużą literę!',
                    ]),
                    new Regex([
                        'pattern' => '/[a-z]/',
                        'message' => 'Hasło musi zawierać małą literę!',
                    ]),
                    new Regex([
                        'pattern' => '/[0-9]/',
                        'message' => 'Hasło musi zawierać jedną cyfrę!',
                    ]),
                    new Regex([
                        'pattern' => '/[\W_]/',
                        'message' => 'Hasło musi zawierać znak specjalny!',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
