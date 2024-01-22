<?php

namespace App\Controller;

use App\Entity\Director;
use App\Entity\Movie;
use App\Model\Dto\MovieDTO;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function homepage(EntityManagerInterface $entityManager): Response
    {
        return $this->redirectToRoute('get_movie');
    }

    #[Route('/movie', name: 'get_movie', methods: ['GET'])]
    public function getMovies(EntityManagerInterface $entityManager): Response
    {
        $movieList = $entityManager->getRepository(Movie::class)->findAll();

        return $this->render('base.html.twig', [
            'movieList' => $movieList,
        ]);
    }

    #[Route('/movie', name: 'add_movie', methods: ['POST'])]
    public function addMovie(#[MapRequestPayload] MovieDTO $userDto, EntityManagerInterface $entityManager): Response
    {
        $directorRepository = $entityManager->getRepository(Director::class);
        $movieRepository = $entityManager->getRepository(Movie::class);

        $existingDirector = $directorRepository->findOneBy(['name' => $userDto->director_name, 'surname' => $userDto->director_surname]);
        $existingMovie = $movieRepository->findOneBy(['title' => $userDto->title, 'director' => $existingDirector]);
        if ($existingMovie) {
            $movieList = $entityManager->getRepository(Movie::class)->findAll();

            return $this->render('base.html.twig', [
            'error' => 'Movie with this title and director already exists',
            'movieList' => $movieList,
        ]);
        }
        if (!$existingDirector) {
            $existingDirector = new Director();
            $existingDirector->setName($userDto->director_name);
            $existingDirector->setSurname($userDto->director_surname);
            $entityManager->persist($existingDirector);
        }

        $movie = new Movie();
        $movie->setTitle($userDto->title);
        $movie->setDirector($existingDirector);

        $entityManager->persist($movie);
        $entityManager->flush();

        return $this->redirectToRoute('home_page');
    }
}
