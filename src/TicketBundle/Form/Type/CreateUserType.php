<?php
namespace TicketBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class CreateUserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            ->add('email', TextType::class)
            ->add('isActive', ChoiceType::class, array(
                'choices' => array(
                    'Yes' => true,
                    'No' => false
                ),
                'choices_as_values' => true,
            ))
            ->add('save', SubmitType::class)
        ;
    }
}
