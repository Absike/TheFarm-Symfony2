<?php

namespace Papillon\TasksBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('type')
            ->add('dateOpening' , 'datetime', array('widget' => 'single_text'))
            ->add('dateClosing' , 'datetime', array('widget' => 'single_text'))
            ->add('customers', 'entity', array(
                'class' => 'PapillonTasksBundle:Customers',
                'property' => 'name',
                'empty_value' => 'Choice a customer ...',
                'required'  => true
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Papillon\TasksBundle\Entity\Projects'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'projects';
    }
}
