<?php

namespace Papillon\UserBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('oldPassword', 'password', array('mapped' => false, 'constraints' => new UserPassword()));

        $builder->add('password', 'repeated', array(
            'type' => 'password',
            'mapped' => false,
            'invalid_message' => 'The password fields must match.',
            'required' => true,
            'first_options' => array('label' => 'Password'),
            'second_options' => array('label' => 'Repeat Password'),
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        /*$resolver->setDefaults(array(
            'data_class' => 'Papillon\UserBundle\Form\Model\ChangePassword',
        ));*/
    }

    public function getName()
    {
        return 'change_passwd';
    }

}
