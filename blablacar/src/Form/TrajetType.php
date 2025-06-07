<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Trajet;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;

class TrajetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
			

			->add('coordonnees', HiddenType::class, array('mapped' => false,
			'attr'=>array()))
			->add('distanceTrajet', HiddenType::class, array(
				'attr'=>array()))
            ->add('idVilleDepart', TextType::class, array('label'=>'Ville de départ',
			'attr'=>array('id'=>'depart','class'=>'form-control',
			'title'=>'Ville de départ')))	
			->add('idVilleRetour', TextType::class, array('label'=>'Ville d\'arrivée',
			'attr'=>array('id'=>'arrivee','class'=>'form-control',
			'title'=>'Ville d\'arrivée')))		
			->add('dateDepart', DateTimeType::class,[
				'label' => 'Date du trajet ',
				'widget'=>'single_text',
			])
			->add('prixTrajet', RangeType::class, array('label'=>'Prix','attr'=>array('id'=>'prix_trajet','class'=>'range','min' => 0,
			'max' => 100, 'value' => 50)))

			// ->add('etape', TextType::class, array(
			// 'label' => 'Etape du trajet',
			// 'attr' => array('id'=> 'coordonnees',
			// 'class' =>'hidden',
			// )))
			
				
			->add('nbrePlace', ChoiceType::class, [
				'label' => 'Places disponibles ',
			'attr' => ['class'=>'form-control',],
			'choices'  => [
				'1' => 1,
				'2' => 2,
				'3' => 3,
			]])
			
			->add('save', SubmitType::class, array(
			'label' => 'VALIDER',
			'attr' => array(
			'id' => 'trajet_save',
			'class' => 'btn btn-primary btn-margin',
			'title' => 'Enregistrer'
			)));
    }
	


	/**
	* @param OptionsResolver $resolver
	*/
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
		'data_class' => 'App\Entity\Trajet',
		'route'=>null
		));
	}

}
?>