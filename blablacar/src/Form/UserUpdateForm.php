<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use App\Entity\Utilisateur;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserUpdateForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
			->add('nom', TextType::class, ['label'=>'Nom', 'attr'=>['placeholder' => 'Nom',],'row_attr' => ['class' => 'form-floating pad',],])
			->add('prenom', TextType::class, ['label'=>'Prénom', 'attr'=>['placeholder' => 'Prénom',],'row_attr' => ['class' => 'form-floating pad',],])
			->add('username', TextType::class, ['label'=>'Pseudonyme', 'attr'=>['placeholder' => 'Pseudonyme',],'row_attr' => ['class' => 'form-floating pad',],])
			->add('email', TextType::class, ['label'=>'Email', 'attr'=>['placeholder' => 'email',],'row_attr' => ['class' => 'form-floating pad',],])
			->add('telephone', TextType::class, ['label'=>'Numéro de téléphone', 'attr'=>['placeholder' => 'telephone',],'row_attr' => ['class' => 'form-floating pad',],])
			->add('profileImage', FileType::class, ['label'=>'Avatar', 'attr'=>['placeholder' => 'Avatar',],'row_attr' => ['class' => 'form-floating pad',], 'mapped' => false, 'required' => false])
			->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,  'required' => false,
                'first_options' => [
                    'attr' => ['autocomplete' => 'new-password'],
					'row_attr' => ['class' => 'form-floating pad'],
                    'constraints' => [
					
                    ],
                    'label' => 'Nouveau mot de passe',
                ],
                'second_options' => [
                    'attr' => ['autocomplete' => 'new-password'],
					'row_attr' => ['class' => 'form-floating pad'],
                    'label' => 'Répétez le passe',
                ],
                'invalid_message' => 'Les deux champs doivent être identiques.',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
			->add('save', SubmitType::class, ['label'=>'Valider', 'attr'=>['class'=>'btn btn-dark pad']]);
	}
	
	#@param OptionsResolver $resolver
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array('data_class'=>'App\Entity\Utilisateur','route'=>null));
	}
}
