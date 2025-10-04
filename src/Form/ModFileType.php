<?php

namespace App\Form;

use App\Entity\GameVersion;
use App\Entity\ModFile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModFileType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('name', TextType::class)
            ->add('modVersion', TextType::class)
            ->add('changelog', TextType::class)
            ->add('gameVersions', EntityType::class, [
                'class' => GameVersion::class,
                'choice_label' => 'slug',
                'multiple' => true,
                'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => ModFile::class,
            'csrf_protection' => false
        ]);
    }
}
