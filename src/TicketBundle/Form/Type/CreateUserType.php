<?php
namespace TicketBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateUserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password')
            ->add('email')
            ->add('isActive')
            ->add('save', 'submit')
        ;
    }

    public function getName()
    {
        return 'user_createuser';
    }
}
