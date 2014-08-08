<?php

namespace Papillon\UserBundle\Form;
use Papillon\UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TasksType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $priority = array('new' => 'New','in_progress' => 'In Progress','resolved' => 'Résolu','awaiting_return' => 'En attente de retours');
        $status = array('low' => 'Low','normal' => 'Normal','high' => 'High','urgent' => 'Urgent','immediate'=>'immediate');

        $builder
            ->add('priority','choice', array('choices'   => $priority,'required'  => false))
            ->add('status','choice', array('choices'   => $status,'required'  => false,'data' => 'new'))
            ->add('description', 'textarea')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Papillon\UserBundle\Entity\Tasks',
            'csrf_protection' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'task';
    }
}
