<?php

namespace Tests\Func\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use TicketBundle\Command\CreateUserCommand;

/**
 * @author SamueL NELA <hello@samnela.com>
 */
class CreateUserCommandTest  extends KernelTestCase
{
    private $entityManager;

    public function setUp()
    {
        self::bootKernel();
        $this->entityManager = self::$kernel->getContainer()
                                                       ->get('doctrine.orm.entity_manager');
        $this->entityManager->beginTransaction();
    }

    public function testExecute()
    {
        $application = new Application(self::$kernel);
        $application->add(new CreateUserCommand());
        $command = $application->find('user:create');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),
            'username' => 'john',
            'password' => 'johndoe',
            'email' => 'john.doe@test.test',
        ));
        $output = $commandTester->getDisplay();
        $this->assertContains('"john" is created', $output);
    }

    protected function tearDown()
    {
        $this->entityManager->rollback();
        parent::ensureKernelShutdown();
    }
}
