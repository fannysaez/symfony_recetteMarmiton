<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/user')]
#[IsGranted('ROLE_USER')]
final class UserController extends AbstractController
{

    #[Route('/', name: 'user')]
    public function user(RecipeRepository $recipeRepository): Response
    {
        /** @var \App\Entity\User $user */
        // $user = $this->getUser();

        // if (!$user) {
        //     throw $this->createAccessDeniedException('Vous devez être connecté.');
        // }

        // $recipes = $recipeRepository->findBy(['user' => $user]);

        return $this->render('user/user.html.twig', [
            // 'recipes' => $user->getRecipes(),
            // 'user' => $user,
        ]);
    }

    #[Route('/favoris', name: 'user_favorites')]
    public function favorites(): Response
    {
        // /** @var \App\Entity\User $user */
        // $user = $this->getUser();
        // if (!$user) {
        //     throw $this->createAccessDeniedException('Vous devez être connecté.');
        // }

        return $this->render('user/favorites.html.twig', []);
    }
}
