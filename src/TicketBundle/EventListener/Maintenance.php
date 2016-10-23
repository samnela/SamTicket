<?php

namespace TicketBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Samuel NELA <hello@samnela.com>
 */
class Maintenance
{
    private $isOn;
    private $template;
    private $twig;

    public function __construct(bool $isOn, string $template, \Twig_Environment $twig)
    {
        $this->isOn = $isOn;
        $this->template = $template;
        $this->twig = $twig;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (false === $this->isOn) {
            return;
        }
        $response = (new Response())->setStatusCode(Response::HTTP_SERVICE_UNAVAILABLE);
        $response->setContent($this->twig->render($this->template));
        $event->setResponse($response);
    }
}
