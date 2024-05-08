<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Response,JsonResponse};
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use App\Event\ProcessStartEvent;
use DateTimeImmutable;

class LongProcessController extends AbstractController
{
	public function __construct(private EventDispatcherInterface $eventDispatcher) {}

    #[Route('/long/process/', name: 'app_long_process_index')]
    public function index(): Response
    {
	    return $this->render("long_process/index.html.twig");
    }


    #[Route('/long/process/start', name: 'app_long_process_start')]
	public function start(): JsonResponse
	{
		$this->eventDispatcher->dispatch(new ProcessStartEvent(new DateTimeImmutable())); 

		return new JsonResponse([
			'success' => true,
			'data' => [],
		]);
	}
}
