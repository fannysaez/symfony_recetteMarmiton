<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/ingredient')]
final class IngredientController extends AbstractController
{
    // Liste des ingrédients
    #[Route('/', name: 'ingredient_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $ingredient = $entityManager->getRepository(Ingredient::class)->findAll();

        return $this->render('admin_ingredient/create.html.twig', [
            'recipes' => $ingredient,
        ]);
    }

    // Nouvelle route pour la liste des ingrédients avec un chemin unique
    #[Route('/list', name: 'ingredient_list')]
    public function list(IngredientRepository $ingredientRepository): Response
    {
        // Récupérer tous les ingrédients depuis la base de données
        $ingredients = $ingredientRepository->findAll();

        // Retourner la vue avec les ingrédients
        return $this->render('ingredient/list.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
}
