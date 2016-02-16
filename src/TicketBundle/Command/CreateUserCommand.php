<?php
namespace TicketBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TicketBundle\Entity\User;

class CreateUserCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName("user:create")
            ->setDescription('create a new user ')
            ->addArgument('username', InputArgument::REQUIRED, 'need a username')
            ->addArgument('password', InputArgument::REQUIRED, 'a user need a password')
            ->addArgument('email', InputArgument::REQUIRED, 'a user need a email ');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');
        $email = $input->getArgument('email');
        $em = $this->getContainer()->get("doctrine.orm.entity_manager");
        $encoder = $this->getContainer()->get('security.password_encoder');
        $user = new User();
        $encoded = $encoder->encodePassword($user, $password);
        $user->setPassword($encoded);
        $user->setUsername($username);
        $user->setEmail($email);
        $em->persist($user);
        $em->flush();
        $output->writeln("User " . $user->getUsername() . " is created");
    }
}
