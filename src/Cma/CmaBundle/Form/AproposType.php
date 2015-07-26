<?php

namespace Cma\CmaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AproposType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description1')
            ->add('description2')
            ->add('tag')
            ->add('imageLocation')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cma\CmaBundle\Entity\Apropos'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cma_cmabundle_apropos';
    }
}
