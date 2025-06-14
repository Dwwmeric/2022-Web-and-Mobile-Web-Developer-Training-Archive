<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label'=> ' ',
                'attr' => array(
                    'placeholder' => 'Email'
                )
            ])
            ->add('password', PasswordType::class, [
                'label'=> ' ',
                'attr' => array(
                    'placeholder' => 'Password'
                )
            ])
            ->add('roles', ChoiceType::class, [
                'label'=> ' ',
                'choices'=> [
                    'Super Administrator'=> 'Super Administrator',
                    'Client administrator'=> 'Client administrator',
                ],  
            ]);

            //roles field data transformer
            $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesArray) {
                    // transform the array to a string
                    return count($rolesArray)? $rolesArray[0]: null;
                },
                function ($rolesString) {
                    // transform the string back to an array
                    return [$rolesString];
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'translation_domain'=>'messages',
        ]);
    }
}
