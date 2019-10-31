<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,[
                'attr' => ['class'=> 'form-control', 'placeholder'=>'Le nom de famille du client', 'autocomplete'=>'off']
            ])
            ->add('prenoms', TextType::class,[
                'attr'=> ['class'=> 'form-control', 'placeholder'=> 'Les prenoms du client', 'autocomplete'=>'off']
            ])
            ->add('sexe', ChoiceType::class,[
                'attr' => ['class' => 'form-control'],
                'choices' => [
                    '-- Selectionnez le type de client' => '', 'Enfant garçon' => 'GARCON', 'Enfant fille' => 'FILLE', 'Homme ' => 'HOMME', 'Femme ' => 'FEMME'
                ],
                'multiple' => false,
                'expanded' => false
            ])
            ->add('adresse', TextType::class,[
                'attr' => ['class' => 'form-control', 'placeholder' => 'La commune ou ville de residence', 'autocomplete'=>'off'],
                'required' => false
            ])
            ->add('cel', TextType::class,[
                'attr' => ['class' => 'form-control', 'placeholder' => 'Le telephone cellulaire du client', 'autocomplete'=>'off'],
                'required' => false
            ])
            ->add('tel', TextType::class,[
                'attr' => ['class' => 'form-control', 'placeholder' => 'Le telephone du client', 'autocomplete'=>'off'],
                'required' => false
            ])
            ->add('garant', TextType::class,[
                'attr' => ['class' => 'form-control', 'placeholder' => "Le garant de l'assurance", 'autocomplete'=>'off'],
                'required' => false
            ])
            ->add('souscripteur', TextType::class,[
                'attr' => ['class' => 'form-control', 'placeholder' => "Le souscripteur de l'assurance", 'autocomplete'=>'off'],
                'required' => false
            ])
            ->add('ticketModerateur', TextType::class,[
                'attr' => ['class' => 'form-control', 'placeholder' => "Le ticket moderateur de l'assurance", 'autocomplete'=>'off'],
                'required' => false
            ])
            ->add('statut', CheckboxType::class,[
                'attr' => ['class' => 'custom-control-input'], 'required' => false
            ])
            //->add('slug')->add('publiePar')->add('modifiePar')->add('publieLe')->add('modifieLe')
            ->add('assurance',null, [
                'attr' => [
                    'class' => 'form-control assurance-select',
                    'placeholder' => 'selectionnez l\'assurance'
                ],
                'class' => 'AppBundle:Assurance',
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
            'data_class' => 'AppBundle\Entity\Client'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_client';
    }


}
