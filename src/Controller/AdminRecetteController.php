<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/recette/admin')]
final class AdminRecetteController extends AbstractController
{
    #[Route('/', name: 'admin_recette')]
    public function index(RecipeRepository $recipeRepository): Response
    {
        $recipes = $recipeRepository->findAll();
        return $this->render('admin_recette/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }
}
