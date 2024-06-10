<?php

namespace App\Form;

use App\Entity\Player;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AddPlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Prénom',
                ],
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('lastName', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Nom',
                ],
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('teams', EntityType::class, [
                'class' => Team::class,
                'required' => false,
                'choice_label' => 'name',
                'autocomplete' => true,
                'attr' => [
                    'placeholder' => 'Pas d\'équipe',
                ],
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
