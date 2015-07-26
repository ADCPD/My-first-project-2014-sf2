<?php

namespace Cma\CmaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServiceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text',array('attr'=>array('placeholder'=>'Ajouter le titre du service')))
            ->add('tag','text',array('attr'=>array('placeholder'=>'affecter un nom à l\'icons service' )))
            ->add('file','file', array('required'=> TRUE,'attr'=>array('class'=>'btn btn-small btn-info m-b-small')))
            ->add('descripton','textarea')
             
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cma\CmaBundle\Entity\Service'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cma_cmabundle_service';
    }
}
