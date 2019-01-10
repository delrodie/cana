<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('numero')
            ->add('montantHT', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>'Montant Hors taxe', 'style'=>'color: blue; text-align: right; font-weight: bold', 'readonly'=>'readonly']])
            ->add('remise', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>'Remise', 'onkeyup'=>'remise()', 'style'=>'text-align: right; font-weight: bold']])
            //->add('tva', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>'TVA']])
            ->add('montantTTC', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>'Montant TTC', 'style'=>'color: green; text-align: right; font-weight: bold', 'readonly'=>'readonly']])
            ->add('acompte', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>'Acompte', 'onkeyup'=>'acompte()', 'style'=>'text-align:right']])
            ->add('rap', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>'Reste à payer', 'style'=>'color: red; text-align: right; font-weight: bold', 'readonly'=>'readonly']])
            ->add('partAssurance', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>'Part Assurance', 'onkeyup'=>'assurance()', 'style'=>'text-align:right']])
            ->add('date', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>'La date']])
            //->add('odSph')->add('odCyl')->add('odAxe')->add('odAdd')
            ->add('odQte', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>'Qte']])
            ->add('odMontant', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>'Montant', 'onkeyup '=> 'odroit()', 'autocomplete'=> 'off', 'style'=>'text-align:right']])
            //->add('ogSph')->add('ogCyl')->add('ogAxe')->add('ogAdd')
            ->add('ogQte', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>'Qte']])
            ->add('ogMontant', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>'Montant', 'onkeyup'=>'ogauche()', 'autocomplete'=> 'off', 'style'=>'text-align:right']])
            ->add('monturePrix', TextType::class,['attr'=>['class'=>'form-control', 'placeholder'=>'Montant', 'onkeyup'=>'montureprix()', 'autocomplete'=> 'off', 'style'=>'text-align:right']])
            ->add('statut', CheckboxType::class,['attr'=>['class'=>'custom-control-input'], 'required'=>false])
            //->add('slug')->add('publiePar')->add('modifiePar')->add('publieLe')->add('modifieLe')
            ->add('client',EntityType::class, [
                'attr' => [
                    'class' => 'form-control facture-select',
                    'placeholder' => 'selectionnez le client'
                ],
                'class' => 'AppBundle:Client',
                'query_builder' => function(EntityRepository $er){
                    return $er->findList(1);
                },
                'choice_label' => function($client){
                    return $client->getNom().' '.$client->getPrenoms();
                }
            ])
            ->add('monture',EntityType::class, [
                'attr' => [
                    'class' => 'form-control facture-select',
                    'placeholder' => 'selectionnez le client'
                ],
                'class' => 'AppBundle:Monture',
                'query_builder' => function(EntityRepository $er){
                    return $er->findList(1);
                },
                'choice_label' => function($monture){
                    return $monture->getMarque()->getLibelle().' => '.$monture->getReference().' ('.$monture->getMontant().')';
                }
            ])
            ->add('traitement',null, [
                'attr' => [
                    'class' => 'form-control facture-select',
                    'placeholder' => 'selectionnez le client'
                ],
                'class' => 'AppBundle:Traitement',
                'query_builder' => function(EntityRepository $er){
                    return $er->findList(1);
                },
                'choice_label' => 'libelle'
            ])
            ->add('typeverre',null, [
                'attr' => [
                    'class' => 'form-control facture-select',
                    'placeholder' => 'selectionnez le client'
                ],
                'class' => 'AppBundle:Typeverre',
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
            'data_class' => 'AppBundle\Entity\Facture'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_facture';
    }


}
