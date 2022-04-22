<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Card\Deck;

class JsonController
{
    /**
     * @Route("/card/api/deck", name="json-home")
     */
    public function deckAsJson(): JsonResponse
    {
        $deck = new Deck();
        $getAllCards = $deck->getAllCards();
        $cardArray = [];

        foreach ($getAllCards as $card) {
            $cardArray[] = $card->getCard();
        }

        $response = new JsonResponse($cardArray);
        $response->setEncodingOptions($response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return $response;
    }
}
