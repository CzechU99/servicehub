<?php

namespace App\Form;

use App\Entity\DaneUzytkownika;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class DaneFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imie', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Imię nie może być puste.']),
                    new Assert\Length(['max' => 50, 'maxMessage' => 'Imię może mieć maksymalnie 50 znaków.']),
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ]+$/',
                        'message' => 'Imię może zawierać tylko litery, bez spacji i znaków specjalnych.',
                    ])
                ]
            ])
            ->add('nazwisko', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Nazwisko nie może być puste.']),
                    new Assert\Length(['max' => 50, 'maxMessage' => 'Nazwisko może mieć maksymalnie 50 znaków.']),
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ]+(-[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ]+)*$/',
                        'message' => 'Nazwisko może zawierać tylko litery, ewentualnie podwójne nazwisko z myślnikiem.',
                    ])
                ]
            ])
            ->add('miejscowosc', null, [
                'constraints' => [
                    new Assert\Length(['max' => 100, 'maxMessage' => 'Miejscowość może mieć maksymalnie 100 znaków.']),
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ\s]+$/',
                        'message' => 'Miejscowość może zawierać tylko litery i spacje.',
                    ])
                ]
            ])
            ->add('numer_domu', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Numer domu nie może być pusty.']),
                    new Assert\Length(['max' => 10, 'maxMessage' => 'Numer domu może mieć maksymalnie 10 znaków.'])
                ]
            ])
            ->add('kod_pocztowy', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Kod pocztowy nie może być pusty.']),
                    new Assert\Regex([
                        'pattern' => '/^\d{2}-\d{3}$/',
                        'message' => 'Kod pocztowy musi być w formacie XX-XXX.'
                    ])
                ]
            ])
            ->add('miasto', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Miasto nie może być puste.']),
                    new Assert\Length(['max' => 50, 'maxMessage' => 'Miasto może mieć maksymalnie 50 znaków.']),
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ\s]+$/',
                        'message' => 'Miasto może zawierać tylko litery i spacje.',
                    ])
                ]
            ])
            ->add('telefon', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Telefon nie może być pusty.']),
                    new Assert\Regex([
                        'pattern' => '/^\+(\d{1,2})\d{7,12}$/',
                        'message' => 'Telefon musi zaczynać się od prefiksu (+XX).'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DaneUzytkownika::class,
        ]);
    }
}


