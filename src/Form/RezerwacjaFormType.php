<?php

namespace App\Form;

use App\Entity\Uslugi;
use App\Entity\Rezerwacje;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RezerwacjaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('wiadomosc', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'NAPISZ WIADOMOŚĆ...'
                ],
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 1000,
                        'min' => 30,
                        'maxMessage' => 'Wiadomość nie może być dłuższa niż {{ limit }} znaków.',
                        'minMessage' => 'Wiadomość nie może być krótsza niż {{ limit }} znaków.',
                    ]),
                ],
            ])
            ->add('udostepnijTelefon', CheckboxType::class, [
                'required' => false,
            ])
            ->add('wymiana', CheckboxType::class, [
                'required' => false,
                'mapped' => false
            ])
            ->add('odKiedy', DateType::class, [
                'widget' => 'single_text',  // Użyj pojedynczego pola tekstowego
                'format' => 'yyyy-MM-dd',  // Możesz ustawić format, np. YYYY-MM-DD
                'attr' => [
                    'placeholder' => 'WPROWADŹ DATĘ OD'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Podaj datę rezerwacji.']),
                ],
            ])
            ->add('doKiedy', DateType::class, [
                'attr' => [
                    'placeholder' => 'WPROWADŹ DATĘ DO (OPCJA)'
                ]
            ])
            ->add('uslugaNaWymiane', EntityType::class, [
                'class' => Uslugi::class,
                'choice_label' => 'nazwaUslugi',
                'choices' => $options['mojeUslugi'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rezerwacje::class,
            'mojeUslugi' => []
        ]);
    }
}
