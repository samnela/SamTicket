<?php

namespace Tests\Unit\AppBundle\EventListener;

use TicketBundle\EventListener\Maintenance;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Samuel NELA <hello@samnela.com>
 */
class MaintenanceTest extends \PHPUnit_Framework_TestCase
{
    private $service;
    private $template = 'maintenance/index.html.twig';

    private $twig;

    public function setUp()
    {
        $this->twig = new \Twig_Environment(new \Twig_Loader_Filesystem('app/Resources/views/'));
        $this->service = new Maintenance(
            true,
            $this->template,
            $this->twig
        );
    }

    public function testOnKernelRequest()
    {
        $response = (new Response())->setStatusCode(Response::HTTP_SERVICE_UNAVAILABLE);
        $response->setContent($this->twig->render($this->template));
        $event = new GetResponseEvent(
            new HttpKernel(
                new EventDispatcher(),
                new ControllerResolver(),
                new RequestStack(),
                new ControllerResolver()
            ),
            new Request(),
            HttpKernelInterface::MASTER_REQUEST
        );
        $this->service->onKernelRequest($event);
        $this->assertEquals($response, $event->getResponse());
    }
}
