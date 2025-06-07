<?php

namespace App\Form;

use App\Entity\Setting;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class SettingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('settingKey', TextType::class, [
                'label'=> ' ',
                'attr' => array(
                    'placeholder' => 'Name of the action'
                )
            ])
            ->add('value', TextType::class, [
                'label'=> ' ',
                'attr' => array(
                    'placeholder' => 'Default value'
                )
            ]);
            
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Setting::class,
            'translation_domain'=>'messages',
        ]);
    }
}
