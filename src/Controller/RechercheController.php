<?php

namespace App\Controller;

use App\Form\CharacterSearchType;
use App\Repository\CharacterRepository;
use App\Repository\RatingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    #[Route('/recherche', name: 'app_recherche')]
    public function recherche(Request $request, CharacterRepository $characterRepository, RatingRepository $ratingRepository)
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

                // 🔥 Récupérer les moyennes de notation uniquement pour les personnages trouvés
                $characterIds = array_map(fn($c) => $c->getId(), $characters);

                if (!empty($characterIds)) {
                    $ratings = $ratingRepository->getAverageRatingsForCharacters($characterIds);
                } else {
                    $ratings = [];
                }
            }

            return $this->render('recherche/recherche.html.twig', [
                'form' => $form->createView(),
                'characters' => $characters,
                'ratings' => $ratings,
            ]);
        }
    }
}
