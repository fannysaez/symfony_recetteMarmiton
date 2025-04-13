<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController{
    #[Route('/user', name: 'user')]
    public function user(RecipeRepository $recipeRepository): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException('Vous devez être connecté.');
        }

        $recipe = $recipeRepository->findBy(['user' => $user]);

        return $this->render('user/user.html.twig', [
            'recipes' => $recipe,
            'user' => $user,
        ]);
    }
}
