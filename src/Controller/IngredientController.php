<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/ingredient')]
final class IngredientController extends AbstractController
{

    #[Route('/', name: 'ingredient_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $ingredient = $entityManager->getRepository(Ingredient::class)->findAll();

        return $this->render('admin_ingredient/create.html.twig', [
            'recipes' => $ingredient,
        ]);
    }

    // #[Route('/create', name: 'ingredient_create')]
    // public function create(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $this->denyAccessUnlessGranted('ROLE_ADMIN'); // Sécurisation de la page avec un rôle admin

    //     // Création d'un nouvel ingrédient
    //     $ingredient = new Ingredient();

    //     // Création du formulaire pour ajouter un ingrédient
    //     $form = $this->createForm(IngredientType::class, $ingredient);

    //     // Traitement de la soumission du formulaire
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         // Sauvegarde de l'ingrédient dans la base de données
    //         $entityManager->persist($ingredient);
    //         $entityManager->flush();

    //         // Message de succès et redirection vers la page de création
    //         $this->addFlash('success', 'L\'ingrédient a bien été ajouté !');

    //         return $this->redirectToRoute('ingredient_create'); // Redirection vers la page de création pour ajouter un autre ingrédient
    //     }

    //     // Affichage du formulaire d'ajout
    //     return $this->render('admin_ingredient/create.html.twig', [
    //         'form' => $form->createView(), // Formulaire à afficher
    //     ]);
    // }
}
