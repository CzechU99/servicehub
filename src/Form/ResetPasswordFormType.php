<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ResetPasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
