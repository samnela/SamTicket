<?php

namespace TicketBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @author Samuel NELA <hello@samnela.com>
 */
class FixtureCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('ticket:fixtures:load')
                ->setDescription('Load fixtures dependance ');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $style = new SymfonyStyle($input, $output);
        $style->title('Start to load  entities dependance ');
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $fixtures = Yaml::parse(
            file_get_contents($this->getContainer()->getParameter('kernel.root_dir').'/Resources/fixtures/entity.yml')
        );
        foreach ($fixtures as $entities => $values) {
            $class = "TicketBundle\Entity\\".ucfirst($entities);
            $setter = 'set'.ucfirst($entities);
            foreach ($values as $value) {
                $entity = new $class();
                $entity->{$setter}($value);
                $entityManager->persist($entity);
            }
        }
        $entityManager->flush();

        $style->success('Ended to load fixtures');
    }
}
