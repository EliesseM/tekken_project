<?php

namespace App\Controller;

use App\Entity\Character;
use App\Repository\RatingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\RatingType;
use App\Entity\Rating;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class CharacterController extends AbstractController
{
    #[Route('/character/{id}', name: 'app_character')]
    public function index(): Response
    {
        return $this->render('character/show.html.twig', [
            'controller_name' => 'CharacterController',
        ]);
    }
    #[Route('/character/{id}', name: 'character_show')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function show(
        Character $character,
        Request $request,
        EntityManagerInterface $em,
        RatingRepository $ratingRepo
    ): Response {
        $existingRating = $ratingRepo->findOneBy([
            'user' => $this->getUser(),
            'character' => $character,
        ]);

        if ($existingRating) {
            $this->addFlash('warning', 'Tu as déjà noté ce personnage.');
            return $this->redirectToRoute('character_show', ['id' => $character->getId()]);
        }

        $rating = new Rating();
        $rating->setCharacter($character);
        $rating->setUser($this->getUser());

        $form = $this->createForm(RatingType::class, $rating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($rating);
            $em->flush();
            $this->addFlash('success', 'Note enregistrée avec succès !');

            return $this->redirectToRoute('character_show', ['id' => $character->getId()]);
        }

        $averageRating = $ratingRepo->getAverageRatingForCharacter($character->getId());

        return $this->render('character/show.html.twig', [
            'character' => $character,
            'averageRating' => $averageRating,
            'ratingForm' => $form->createView(),
            'existingRating' => $existingRating,
        ]);
    }
}
