<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_home')]
    //annottation interprétable
        /**
         * @Route("/home", name="main_home2")
         */
    public function home(): Response
    {

        return $this->render("main/home.html.twig");
    }

    #[Route('/test', name: 'main_test')]
    public function test(EntityManagerInterface $entityManager, SerieRepository $serieRepository): Response
    {

        $serie = new Serie();
        $serie
            ->setBackdrop("backdrop.png")
            ->setDateCreated(new \DateTime())
            ->setGenres("Thriller/Drama")
            ->setName("Utopia")
            ->setFirstAirDate(new \DateTime("-2 year"))
            ->setLastAirDate(new \DateTime("-2 month"))
            ->setPopularity(500)
            ->setPoster("poster.png")
            ->setStatus("Canceled")
            ->setTmdbId(123456)
            ->setVote(5);

        dump($serie);

//        //sauvegarde de mon instance grace à l'entityManager
//        $entityManager->persist($serie);
//        $entityManager->flush();
//
//        dump($serie);
//
//        //si j'ai un id j'update
//        $serie->setName("Code Quantum");
//        $entityManager->persist($serie);
//        $entityManager->flush();
//
//        dump($serie);
//
//        //je supprime
//        $entityManager->remove($serie);
//        $entityManager->flush();

        //en passant par le repository version 5.4
        $serieRepository->save($serie, true);

        dump($serie);

        $username = "<h2>Sylvain</h2>";
        $serie = [ "title" => "The Witcher", "year" => 2019];

        return $this->render("main/test.html.twig", [
            "nameOfUser" => $username,
            "mySerie" => $serie
        ]);
    }
}
