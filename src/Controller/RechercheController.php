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
        $searchTerm = '';

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $searchTerm = $data['search'] ?? '';

            if ($searchTerm) {
                $characters = $characterRepository->createQueryBuilder('c')
                    ->where('c.name LIKE :term')
                    ->setParameter('term', '%' . $searchTerm . '%')
                    ->getQuery()
                    ->getResult();

                $characterIds = array_map(fn($c) => $c->getId(), $characters);

                if (!empty($characterIds)) {
                    $ratings = $ratingRepository->getAverageRatingsForCharacters($characterIds);
                }
            }
        }

        // ✅ Ce retour est toujours exécuté, peu importe l'état du formulaire
        return $this->render('recherche/recherche.html.twig', [
            'form' => $form->createView(),
            'characters' => $characters,
            'ratings' => $ratings,
        ]);
    }
}
