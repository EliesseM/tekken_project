<?php

namespace App\Controller;

use App\Entity\Character;
use App\Repository\RatingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\RatingType;
use App\Entity\Rating;
use App\Repository\CharacterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class CharacterController extends AbstractController
{

    #[Route('/character/{id}', name: 'character_show')]
    public function show(
        Character $character,
        Request $request,
        EntityManagerInterface $em,
        RatingRepository $ratingRepo
    ): Response {
        $user = $this->getUser();
        $existingRating = null;
        $form = null;

        if ($user) {
            $existingRating = $ratingRepo->findOneBy([
                'user' => $user,
                'character' => $character,
            ]);

            if (!$existingRating) {
                $rating = new Rating();
                $rating->setCharacter($character);
                $rating->setUser($user);

                $form = $this->createForm(RatingType::class, $rating);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $em->persist($rating);
                    $em->flush();

                    $this->addFlash('success', 'Note enregistrée avec succès !');
                    return $this->redirectToRoute('character_show', ['id' => $character->getId()]);
                }
            } else {
                $this->addFlash('warning', 'Tu as déjà noté ce personnage.');
            }
        }

        $averageRating = $ratingRepo->getAverageRatingForCharacter($character->getId());

        return $this->render('character/show.html.twig', [
            'character' => $character,
            'averageRating' => $averageRating,
            'ratingForm' => $form ? $form->createView() : null,
            'existingRating' => $existingRating,
            'user' => $user,
        ]);
    }

    #[Route('/recherche', name: 'app_recherche')]
    public function search(Request $request, CharacterRepository $characterRepo): Response
    {
        $query = $request->query->get('q', '');

        $characters = $query
            ? $characterRepo->createQueryBuilder('c')
            ->where('c.name LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->getQuery()
            ->getResult()
            : [];

        return $this->render('character/recherche.html.twig', [
            'characters' => $characters,
            'query' => $query,
        ]);
    }
    #[Route('/characters', name: 'character_list')]
    public function list(CharacterRepository $characterRepo): Response
    {
        $characters = $characterRepo->findAll();

        return $this->render('character/index.html.twig', [
            'characters' => $characters,
        ]);
    }
}
