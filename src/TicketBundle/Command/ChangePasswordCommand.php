<?php

namespace TicketBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Samuel NELA <hello@samnela.com>
 */
class ChangePasswordCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('user:change-password')
            ->setDescription('Change password user')
            ->addArgument('user', InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = $input->getArgument('user');
        $newPassword = $input->getArgument('password');
        $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');
        $encoder = $this->getContainer()->get('security.password_encoder');
        $userRepo = $em->getRepository('TicketBundle:User')->findOneByUsername($user);
        $encoded = $encoder->encodePassword($userRepo, $newPassword);
        if ($userRepo) {
            $userRepo->setPassword($encoded);
            $em->flush();
            $text = 'Change password for '.$userRepo->getUsername();
        } else {
            $text = 'This user don\'t exist ';
        }

        $output->writeln($text);
    }
}
