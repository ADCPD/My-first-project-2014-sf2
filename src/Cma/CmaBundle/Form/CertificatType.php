<?php

namespace Cma\CmaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CertificatType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title','text',array('required'    => TRUE, 'attr' => array('class' => 'form-control span12')))
                ->add('description','textarea',array('required'    => TRUE, 'attr' => array('class' => 'form-control span12')))
                ->add('file','file')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cma\CmaBundle\Entity\Certificat'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'Cma_Cmabundle_Certificat';
    }

}
