<?php
namespace TicketBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email')
            ->add('firstname')
            ->add('lastname')
            ->add('phonenumber')
            ->add('cellnumber')
            ->add('subject')
            ->add('description')
            ->add('priority','entity',array('class'=>'TicketBundle:Priority'))
            ->add('status','entity',array('class'=>'TicketBundle:Status'))
            ;
           
    }
     public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TicketBundle\Entity\Ticket',
        ));
    }

    public function getName()
    {
        return 'ticket';
    }
}
