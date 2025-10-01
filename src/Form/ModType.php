<?php

namespace App\Form;

use App\Entity\License;
use App\Entity\Mod;
use App\Entity\ModCategory;
use App\Entity\ModLoader;
use App\Entity\ModSide;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('categories', EntityType::class, [
                'class' => ModCategory::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('loaders', EntityType::class, [
                'class' => ModLoader::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('side', EnumType::class, [
                'class' => ModSide::class
            ])
            ->add('license', EnumType::class, [
                'class' => License::class,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Mod::class,
            'csrf_protection' => false
        ]);
    }
}
