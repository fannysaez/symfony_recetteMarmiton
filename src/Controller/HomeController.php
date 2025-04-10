<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use App\Repository\IngredientRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController{
    #[Route('/', name: 'home_index')]
    public function index(Request $request, IngredientRepository $ingredientRepo, RecipeRepository $recipeRepo)
    {
        // Récupérer tous les ingrédients
        $ingredients = $ingredientRepo->findAll();
        $recipes = $recipeRepo->findAll();

        // Récupérer l'ingrédient sélectionné via le paramètre de la requête
        $ingredientId = $request->query->get('ingredient');
        $recipes = [];

        // Si un ingrédient est sélectionné, on filtre les recettes associées
        // if ($ingredientId) {
        //     $recipes = $recipeRepo->findByIngredient($ingredientId);
        // }

        // Passer les données au template
        return $this->render('home/index.html.twig', [
            'ingredients' => $ingredients,
            'recipes' => $recipes,
            'selectedIngredient' => $ingredientId,
        ]);
    }
}