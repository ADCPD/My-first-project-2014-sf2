<?php
namespace LC\WebsiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;

class MailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'attr' => array(
                    'placeholder' => 'Votre nom, ici! ',
                    'pattern'     => '.{2,}' //minlength
                )
            ))
            ->add('email', 'email', array(
                'attr' => array(
                    'placeholder' => 'Votre adresse mail ici.'
                )
            ))
            ->add('subject', 'text', array(
                'attr' => array(
                    'placeholder' => 'Objet de votre message.',
                    'pattern'     => '.{3,}' //minlength
                )
            ))
            ->add('message', 'textarea', array(
                'attr' => array(
                    'cols' => 90,
                    'rows' => 10,
                    'placeholder' => 'et votre message ici...'
                )
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $collectionConstraint = new Collection(array(
            'name' => array(
                new NotBlank(array('message' => 'Votre nom est obligatoire.')),
                new Length(array('min' => 2))
            ),
            'email' => array(
                new NotBlank(array('message' => 'Votre e-mail est obligatoire.')),
                new Email(array('message' => 'Invalid email address.'))
            ),
            'subject' => array(
                new NotBlank(array('message' => 'Object est obligatoire.')),
                new Length(array('min' => 3))
            ),
            'message' => array(
                new NotBlank(array('message' => 'Message est obligatoire.')),
                new Length(array('min' => 5))
            )
        ));

        $resolver->setDefaults(array(
            'constraints' => $collectionConstraint
        ));
    }

    public function getName()
    {
        return 'mail';
    }
}