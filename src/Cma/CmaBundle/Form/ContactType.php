<?php

namespace Cma\CmaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text' ,array('required'    => TRUE, 'attr' => array('class' => 'form-control login-input span12'), 'label' => 'session contact titre: '))
            ->add('postalAdress','textarea', array('required'    => TRUE,'attr' => array('class' => 'form-control login-input span12'), 'label' => 'Adresse postale: '))
            ->add('mail','text',array('required'    => TRUE, 'attr' => array('class' => 'form-control login-input span12'), 'label' => 'Entreprise mail: '))
            ->add('phone','text',array('required'    => TRUE, 'attr' => array('class' => 'form-control login-input span12'), 'label' => 'Entreprise mobile: '))
            ->add('fax','text',array('required'    => TRUE, 'attr' => array('class' => 'form-control login-input span12'), 'label' => 'Entreprise Fax: '))
            ->add('map','textarea',array('required'    => TRUE, 'attr' => array('class' => 'form-control login-input span12'), 'label' => 'script de google Map: '))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cma\CmaBundle\Entity\Contact'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cma_cmabundle_contact';
    }
}
