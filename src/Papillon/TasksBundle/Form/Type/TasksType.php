<?php

namespace Papillon\TasksBundle\Form;
use Papillon\TasksBundle\Entity\Tasks;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Papillon\UserBundle\Entity\UserRepository;

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
            ->add('priority','choice', array('choices'   => $priority,'data' => 'new','required'  => true,'empty_value' => 'Choose something'))
            ->add('status','choice', array('choices'   => $status,'required'  => true,'empty_value' => 'Choose something...'))
            ->add('description', 'textarea')
            ->add('author', 'entity', array(
                'class' => 'PapillonUserBundle:User',
                'query_builder' => function(UserRepository $repository) { return $repository->getAllUser(); },
                'property' => 'getUsername',
                'empty_value' => 'Assigned to ...',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Papillon\TasksBundle\Entity\Tasks',
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
