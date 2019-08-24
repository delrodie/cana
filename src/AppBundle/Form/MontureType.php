<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MontureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reference', TextType::class, [
                'attr' => ['class'=> 'form-control', 'placeholder'=>'La reference de la monture']
            ])
            ->add('col', TextType::class, [
                'attr' => ['class'=> 'form-control', 'placeholder'=>'Col de la monture'], 'required'=>false
            ])
            ->add('taille', TextType::class, [
                'attr' => ['class'=> 'form-control', 'placeholder'=>'La taille de la monture'], 'required'=>false
            ])
            ->add('montant', IntegerType::class,[
                'attr' => ['class'=> 'form-control', 'placeholder'=> 'Le montant de la monture']
            ])
            ->add('genre', ChoiceType::class,[
                'attr' =>['class' => 'form-control'],
                'choices' => [
                    ''=> '-- Selectionnez le genre de monture',
                    'ENFANT' => 'Enfant',
                    'FEMME' => 'Femme',
                    'HOMME' => 'Homme',
                    'MIXTE' => 'Mixte',
                    'SOLAIRE' => 'Solaire'
                ],
                'multiple' => false,
                'expanded' => false
            ])
            ->add('stock', IntegerType::class,[
                'attr' => ['class'=> 'form-control', 'placeholder'=>'Le nombre de montures en stock']
            ])
            ->add('statut', CheckboxType::class,[
                'attr'=>['class'=>'custom-control-input'], 'required'=> false
            ])
            //->add('slug')->add('publiePar')->add('modifiePar')->add('publieLe')->add('modifieLe')
            ->add('marque', null, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'selectionnez la marque'
                ],
                'class' => 'AppBundle:Marque',
                'query_builder' => function(EntityRepository $er){
                    return $er->findList(1);
                },
                'choice_label' => 'libelle'
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Monture'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_monture';
    }


}
