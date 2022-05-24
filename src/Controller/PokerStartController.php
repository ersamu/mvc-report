<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use App\Entity\TotalScore;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\TotalScoreRepository;

class PokerStartController extends AbstractController
{
    /**
     * @Route("/proj", name="poker-start")
     */
    public function start(): Response
    {
        $data = [
            "title" => "Pokerspel"
        ];
        return $this->render("poker/start.html.twig", $data);
    }

    /**
     * @Route("/proj/rules", name="poker-rules")
     */
    public function rules(): Response
    {
        $data = [
            "title" => "Spelregler"
        ];
        return $this->render("poker/rules.html.twig", $data);
    }

    /**
     * @Route("/proj/about", name="poker-about")
     */
    public function about(): Response
    {
        $data = [
            "title" => "Om projektet"
        ];
        return $this->render("poker/about.html.twig", $data);
    }

    /**
     * @Route("/proj/cleancode", name="cleancode")
     */
    public function cleancode(): Response
    {
        $data = [
            "title" => "Snygg och god kod"
        ];
        return $this->render("poker/cleancode.html.twig", $data);
    }

    /**
     * @Route("/proj/scorelist", name="scorelist")
     */
    public function scorelist(TotalScoreRepository $totalScoreRepository): Response
    {
        $score = $totalScoreRepository->find(1);

        $data = [
            "title" => "Total poäng",
            "score" => $score
        ];
        return $this->render("poker/scorelist.html.twig", $data);
    }

    /**
     * @Route("/proj/reset", name="reset-database")
     */
    public function resetDatabase(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $score = $entityManager->getRepository(TotalScore::class)->find(1);
        $score->resetScore();
        $entityManager->flush();

        return $this->redirectToRoute("scorelist");
    }
}
