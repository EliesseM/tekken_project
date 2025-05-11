<?php

namespace App\Controller;

use App\Form\CharacterSearchType;
use App\Repository\CharacterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    #[Route('/recherche', name: 'app_recherche')]
    public function recherche(Request $request, CharacterRepository $characterRepository)
    {
        $form = $this->createForm(CharacterSearchType::class);
        $form->handleRequest($request);

        $characters = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $searchTerm = $data['search'] ?? '';

            if ($searchTerm) {
                $characters = $characterRepository->createQueryBuilder('c')
                    ->where('c.name LIKE :term')
                    ->setParameter('term', '%' . $searchTerm . '%')
                    ->getQuery()
                    ->getResult();
            }
        }

        return $this->render('recherche/recherche.html.twig', [
            'form' => $form->createView(),
            'characters' => $characters,
        ]);
    }
}
