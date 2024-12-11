<?php

namespace App\Form;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
            'constraints' => [
                new Assert\NotBlank([
                    'message' => 'Email jest wymagany',
                ]),
                new Assert\Email([
                    'message' => 'Adres email "{{ value }}" jest nieprawidłowy',
                ]),
            ],
        ])
        ->add('password', PasswordType::class, [
            'constraints' => [
                new Assert\NotBlank([
                    'message' => 'Hasło jest wymagane',
                ]),
                new Assert\Length([
                    'min' => 6,
                    'minMessage' => 'Hasło musi mieć min. {{ limit }} znaków',
                    'max' => 15,
                    'maxMessage' => 'Hasło nie może być dłuższe niż {{ limit }} znaków',
                ]),
            ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
