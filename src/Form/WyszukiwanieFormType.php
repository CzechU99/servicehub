<?php

namespace App\Form;

use App\Entity\Kategorie;
use App\Entity\Uslugi;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WyszukiwanieFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nazwaUslugi', null, [
                'required' => false,
            ])
            ->add('cenaMin', null, [
                'required' => false,
            ])
            ->add('cenaMax', null, [
                'required' => false,
            ])
            ->add('lokalizacja', null, [
                'required' => false,
            ])
            ->add('dystans', null, [
                'required' => false,
            ])
            ->add('kategorie', EntityType::class, [
                'class' => Kategorie::class,
                'choice_label' => 'nazwaKategorii',
                'placeholder' => 'KATEGORIA',
                'required' => false,
            ])
        ;
    }
    
}
