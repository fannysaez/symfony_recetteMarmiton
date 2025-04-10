<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/ingredient')]
final class AdminIngredientController extends AbstractController
{
    #[Route('', name: 'admin_ingredient')]
    public function index(IngredientRepository $ingredientRepository): Response
    {
        $ingredients = $ingredientRepository->findAll();

        return $this->render('admin_ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }

    #[Route('/create', name: 'ingredient_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($ingredient);
            $em->flush();

            return $this->redirectToRoute('admin_ingredient');
        }

        return $this->render('admin_ingredient/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
