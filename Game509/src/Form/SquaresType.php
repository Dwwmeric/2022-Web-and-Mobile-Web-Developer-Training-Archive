<?php

namespace App\Form;

use App\Entity\Squares;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class SquaresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, [
                'label'=> ' ',
                'attr' => ['placeholder' => 'Name'],
            ])
            ->add('order',NumberType::class, [
                'label'=> ' ',
                'attr' => ['placeholder' => 'Order'],
                'html5' => TRUE,
            ])
            ->add('type', ChoiceType::class,[
                'choices'=> [
                    'Starting point'=> 'depart',
                    'Bonus'=> 'bonus',
                    'Malus'=> 'malus',
                    'Collaboration'=> 'collaboration',
                    'Neutral'=> 'neutre',
                    'Moves'=> 'deplacement',
                ],
            ])
            ->add('description',TextareaType::class, [
                'label'=> ' ',
                'attr' => ['placeholder' => 'Description'],
                'required' => false,
                'data_class' => null,
            ])
            ->add('headerColorText',ColorType::class, [
                'label'=> 'Text color at the top of the box',
            ])
            ->add('headerColorBg',ColorType::class, [
                'label'=> 'Color of the top of the box',
            ])
            ->add('headerDisplay', CheckboxType::class, [
                'label'=> 'Activate the top of the box',
                'required' => false,
                'data_class' => null,
            ])
            ->add('bodyColorText',ColorType::class, [
                'label'=> 'Box body text color',
            ])
            ->add('bodyColorBg',ColorType::class, [
                'label'=> 'Box body color',
            ])
            ->add('bodyImg', FileType::class, [
                'label'=> 'Picture of the box',
                'required' => false,
                'data_class' => null,
            ])
            ->add('bodyText',TextType::class, [
                'label'=> ' ',
                'attr' => ['placeholder' => 'Box text'],
                'required' => false,
                'data_class' => null,
             ])
            ->add('footerColorText',ColorType::class,[
                'label'=> 'Text color at the bottom of the box',
            ])
            ->add('footerColorBg',ColorType::class,[
                'label'=>'Bottom color of the box',
            ])
            ->add('footerValue',TextType::class, [ 
                'label'=> ' ',
                'attr' => ['placeholder' => 'Value'],
                'required' => false,
                'data_class' => null,
            ])
            ->add('footerDisplay', CheckboxType::class, [
                'label'=> 'Activate the bottom of the box',
                'required' => false,
                'data_class' => null,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Squares::class,
            'translation_domain'=>'messages',
        ]);
    }
}


