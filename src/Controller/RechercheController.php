<?php

namespace App\Controller;

use App\Form\CharacterSearchType;
use App\Repository\CharacterRepository;
use App\Repository\RatingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    #[Route('/recherche', name: 'app_recherche')]
    public function recherche(Request $request, CharacterRepository $characterRepository, RatingRepository $ratingRepository): Response
    {
        $form = $this->createForm(CharacterSearchType::class);
        $form->handleRequest($request);

        $characters = [];
        $ratings = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $searchTerm = $form->get('search')->getData();

            $characters = $characterRepository->findByNameLike($searchTerm);

            if (!empty($characters)) {
                $characterIds = array_map(fn($c) => $c->getId(), $characters);
                $ratings = $ratingRepository->getAverageRatingsForCharacters($characterIds);
            }
        }

        return $this->render('recherche/recherche.html.twig', [
            'form' => $form->createView(),
            'characters' => $characters,
            'ratings' => $ratings,
        ]);
    }
}
