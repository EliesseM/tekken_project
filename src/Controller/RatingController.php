<?php

namespace App\Controller;

use App\Repository\RatingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Security;

final class RatingController extends AbstractController
{
    #[Route('/rating', name: 'app_rating')]
    public function index(RatingRepository $ratingRepository, Security $security): Response
    {
        $user = $security->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException();
        }

        $ratings = $ratingRepository->findBy(['user' => $user]);

        return $this->render('rating/rating.html.twig', [
            'ratings' => $ratings,
        ]);
    }
}
