<?php

namespace Cma\CmaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class sendMailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email','email',array('required'    => TRUE, 'attr' => array('id'=>'email','class'=>'form_field')))
            ->add('telephone','text',array( 'attr' => array('class' => 'form-control login-input span12')))
            ->add('name','text',array('required'    => TRUE, 'attr' => array('class' => 'form-control login-input span12')))
            ->add('content','textarea',array('required'    => TRUE, 'attr' => array('class' => 'form-control login-input span12')))
             
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cma\CmaBundle\Entity\sendmail'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cma_cmabundle_sendmail';
    }
}
