<?php

namespace Cma\CmaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MetaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('slogon')
            ->add('title')
            //->add('path','file', array('required'=> TRUE,'attr'=>array('class'=>'btn btn-small btn-info m-b-small')))
             ->add('description','textarea')
            ->add('author')
            ->add('keyword')
            ->add('script','textarea')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cma\CmaBundle\Entity\Meta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cma_cmabundle_meta';
    }
}
