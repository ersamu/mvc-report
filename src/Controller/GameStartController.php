<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class GameStartController extends AbstractController
{
    /**
     * @Route("/game", name="game-home")
     */
    public function game(): Response
    {
        $data = [
            'title' => 'Landningssida',
        ];
        return $this->render('game-home.html.twig', $data);
    }

    /**
     * @Route("/game/doc", name="game-doc")
     */
    public function documentation(): Response
    {
        $data = [
            'title' => 'Dokumentation',
        ];
        return $this->render('game-doc.html.twig', $data);
    }
}
