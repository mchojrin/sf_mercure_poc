<?php

namespace App\Controller;

use App\Message\StartProcessMessage;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse, Response};
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/long/process')]
class LongProcessController extends AbstractController
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus) {
        $this->messageBus = $messageBus;
    }

    #[Route('/', name: 'app_long_process_index')]
    public function index(): Response
    {
	    return $this->render("long_process/index.html.twig");
    }


    #[Route('/start', name: 'app_long_process_start')]
	public function start(): JsonResponse
	{
		$this->messageBus->dispatch(new StartProcessMessage());

		return new JsonResponse([
			'success' => true,
			'data' => [
                'description' => 'Processed queued',
                'timestamp' => (new DateTimeImmutable())->format('Y-m-d H:i:s'),
            ],
		]);
	}

}
