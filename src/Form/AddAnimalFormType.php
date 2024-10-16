<?php

namespace App\Form;

use App\Entity\Animaux;
use App\Entity\Habitats;
use App\Repository\AnimauxRepository;
use App\Repository\HabitatsRepository;
use PhpParser\Node\Stmt\Label;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddAnimalFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('race')
            ->add('default_image', TextType::class, ['label' => 'image'])
            ->add('habitat', EntityType::class, [
                'class' => Habitats::class,
                'choice_label' => 'nomHab',
                'query_builder' => function (HabitatsRepository $ar) {
                    return $ar->createQueryBuilder('h')
                        ->orderBy('h.nomHab', 'ASC');
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animaux::class,
        ]);
    }
}