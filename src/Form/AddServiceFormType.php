<?php

namespace App\Form;

use App\Entity\Uslugi;
use App\Entity\Kategorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AddServiceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nazwaUslugi', TextType::class, [
                'label' => 'Nazwa Usługi',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Nazwa usługi nie może być pusta.']),
                    new Assert\Length([
                        'max' => 100,
                        'min' => 15,
                        'maxMessage' => 'Nazwa usługi nie może być dłuższa niż {{ limit }} znaków.',
                        'minMessage' => 'Nazwa usługi nie może być krótsza niż {{ limit }} znaków.',
                    ]),
                ],
            ])
            ->add('cena', NumberType::class, [
                'label' => 'Cena (zł)',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Cena nie może być pusta.']),
                    new Assert\Type([
                        'type' => 'numeric',
                        'message' => 'Cena musi być liczbą.',
                    ]),
                    new Assert\Positive(['message' => 'Cena musi być dodatnia.']),
                    new Assert\LessThan([
                        'value' => 1000000,
                        'message' => 'Cena nie może być większa niż {{ compared_value }} zł.',
                    ]),
                ],
            ])
            ->add('images', FileType::class, [
                'label' => 'Prześlij zdjęcia',
                'mapped' => false,  
                'multiple' => true,  
                'required' => true, 
                'attr' => ['accept' => 'image/*'],
            ])
            ->add('kategorie', EntityType::class, [
                'required' => true,
                'class' => Kategorie::class,
                'label' => 'Kategorie',
                'choices' => $options['categories'], 
                'choice_label' => fn ($category) => $category->getNazwaKategorii(),
                'multiple' => true,
                'expanded' => true, 
                'constraints' => [
                    new Assert\Count([
                        'min' => 1,
                        'minMessage' => 'Wybór przynajmniej jednej kategorii jest obowiązkowy!',
                    ]),
                ],
            ])
            ->add('opisUslugi', TextareaType::class, [
                'label' => 'Opis Usługi',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Opis usługi nie może być pusty.']),
                    new Assert\Length([
                        'max' => 1000,
                        'min' => 100,
                        'maxMessage' => 'Opis usługi nie może być dłuższy niż {{ limit }} znaków.',
                        'minMessage' => 'Opis usługi nie może być krótszy niż {{ limit }} znaków.',
                    ]),
                ],
            ])
            ->add('doNegocjacji', CheckboxType::class, [
                'label' => 'Cena do negocjacji',
                'required' => false,
            ])
            ->add('czyFirma', CheckboxType::class, [
                'label' => 'Czy oferujesz jako firma?',
                'required' => false,
            ])
            ->add('czyWymiana', CheckboxType::class, [
                'label' => 'Czy możliwa wymiana?',
                'required' => false,
            ])
            ->add('czyStawkaGodzinowa', CheckboxType::class, [
                'label' => 'Czy stawka godzinowa?',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Uslugi::class,
            'categories' => [],
        ]);
    }
}
