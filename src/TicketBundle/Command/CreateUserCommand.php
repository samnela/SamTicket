<?php

namespace TicketBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use TicketBundle\Entity\User;
use TicketBundle\Entity\UserRoles;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 *@author Samuel NELA <hello@samnela.com> 
 */
class CreateUserCommand extends ContainerAwareCommand
{
    const ROLE_USER = [
                                    'admin' => UserRoles::ROLE_ADMIN,
                                    'manager' => UserRoles::ROLE_MANAGER,
                                    'agent' => UserRoles::ROLE_AGENT,
                                     'superadmin' => 'ROLE_SUPER_ADMIN',
          ];
    protected function configure()
    {
        $this->setName('user:create')
            ->setDescription('create a new user ')
            ->addArgument('username', InputArgument::REQUIRED, 'need a username')
            ->addArgument('password', InputArgument::REQUIRED, 'a user need a password')
            ->addArgument('email', InputArgument::REQUIRED, 'a user need a email ')
            ->addOption('type', 't', InputOption::VALUE_OPTIONAL)

           ->setHelp('Create  new  user - arguments : user password email --type=admin');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $style = new SymfonyStyle($input, $output);
        $style->title('Create new  User');

        $username = $input->getArgument('username');
        $password = $input->getArgument('password');
        $email = $input->getArgument('email');
        $type = $input->getOption('type');

        $role = is_null($type) ? self::ROLE_USER['admin'] : self::ROLE_USER[$type];
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $encoder = $this->getContainer()->get('security.password_encoder');
        $user = new User();
        $encoded = $encoder->encodePassword($user, $password);
        $user->setPassword($encoded)
        ->setUsername($username)
        ->setEmail($email)
            ->setActive(true)
            ->setRoles(array($role));

        $entityManager->persist($user);
        $entityManager->flush();
        $style->success('USER : "'.$user->getUsername().'" is created');
    }
}
