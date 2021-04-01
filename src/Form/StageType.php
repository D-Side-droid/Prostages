<?php

namespace App\Form;

use App\Entity\Stage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Formation;

class StageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule')
            ->add('description')
            ->add('dateDebut')
            ->add('duree')
            //->add('competenceRequise')
            //->add('experienceRequise')
            ->add('formation', EntityType::class, array(
				'class'=> Formation::class,
				'choice_label'=>'intitule',
				'multiple'=>True,'expanded'=>True)) 
            ->add('entreprises', EntrepriseType::class) // A gérer en formulaires imbriqués
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}
