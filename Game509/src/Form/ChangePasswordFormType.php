<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Translation\Translator;
use Symfony\Contracts\Translation\TranslatorInterface;


class ChangePasswordFormType extends AbstractType
{
    // 2. Declare a locally accesible variable
    public $translator;
    
    // 3. Autowire the translator interface and update the local value with the injected one
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
    
        
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => ['autocomplete' => ' ' ],
                    'constraints' => [
                        new NotBlank([
                            'message' => $this->translator->trans('Please enter a password'),
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => $this->translator->trans('Your password should be at least {{ limit }} characters'),
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                    'label' => ' ',
                    'attr' => ['placeholder' => 'New-password'],
                ],
                'second_options' => [
                    'attr' => ['autocomplete' => 'new-password'],
                    'label' => ' ',
                    'attr' => ['placeholder' => 'Repeat-password'],
                ],
                'invalid_message' => $this->translator->trans('The password fields must match.'),
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'translation_domain'=>'messages',
        ]);
    }
}
