<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VersementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->facture = $options['facture'];
        $facture = $this->facture;
        $builder
            //->add('montant', TextType::class,['attr'=>['class'=>'form-control']])
            ->add('acompte', TextType::class,['attr'=>['class'=>'form-control', 'onkeyup'=>'verse()', 'autocomplete'=> 'off']])
            ->add('reste', TextType::class,['attr'=>['class'=>'form-control']])
            //->add('statut')
            //->add('publiePar')->add('modifiePar')->add('publieLe')->add('modifieLe')
            ->add('facture', EntityType::class,[
                'attr'=> ['class'=>'form-control'],
                'class' =>'AppBundle:Facture',
                'query_builder' =>function(EntityRepository $entityRepository) use ($facture){
                    return $entityRepository->findFacture($facture);
                },
                'choice_label' =>'numero'
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Versement',
            'facture' => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_versement';
    }


}
