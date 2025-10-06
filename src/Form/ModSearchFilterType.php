<?php

namespace App\Form;

use App\Entity\GameVersion;
use App\Entity\Mod;
use App\Entity\ModCategory;
use App\Entity\ModFile;
use App\Entity\ModLoader;
use App\Entity\ModSide;
use App\Search\Filter\ModSearchFilter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModSearchFilterType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('query', TextType::class)
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
            ->add('gameVersions', EntityType::class, [
                'class' => GameVersion::class,
                'choice_label' => 'slug',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('side', EnumType::class, [
                'class' => ModSide::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => ModSearchFilter::class,
            'csrf_protection' => false
        ]);
    }
}
