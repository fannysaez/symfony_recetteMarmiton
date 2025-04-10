<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/ingredient')]
final class IngredientController extends AbstractController
{
    #[Route('/', name: 'ingredient_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN'); // Sécurisation de la page avec un rôle admin

        $ingredients = $entityManager->getRepository(Ingredient::class)->findAll(); // Récupération de tous les ingrédients

        return $this->render('admin/adminIngredient.html.twig', [
            'ingredients' => $ingredients, // Transmission des ingrédients à la vue
        ]);
    }

    #[Route('/create', name: 'ingredient_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN'); // Sécurisation de la page avec un rôle admin

        $ingredient = new Ingredient(); // Création d'un nouvel ingrédient
        $form = $this->createForm(IngredientType::class, $ingredient); // Création du formulaire

        $form->handleRequest($request); // Traitement de la requête HTTP
        if ($form->isSubmitted() && $form->isValid()) { // Si le formulaire est soumis et valide
            $entityManager->persist($ingredient); // Sauvegarde de l'entité en base de données
            $entityManager->flush(); // Exécution de la requête de persistance

            // Ajout d'un message flash et redirection vers la liste des ingrédients après succès
            $this->addFlash('success', 'L\'ingrédient a bien été ajouté !');

            return $this->redirectToRoute('ingredient_index');
        }

        // Affichage du formulaire pour ajouter un ingrédient
        return $this->render('admin/adminIngredient.html.twig', [
            'form' => $form->createView(), // Passage du formulaire à la vue
        ]);
    }

    #[Route('/{id}', name: 'ingredient_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Ingredient $ingredient): Response
    {
        return $this->render('ingredient/show.html.twig', [
            'ingredient' => $ingredient, // Affichage des détails de l'ingrédient
        ]);
    }
}
