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
    #[Route('/create', name: 'ingredient_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ingredient);
            $entityManager->flush();
            $this->addFlash('success', 'Ingrédient ajouté avec succès.');
            return $this->redirectToRoute('ingredient_admin');
        }
        return $this->render('admin_ingredient/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin', name: 'ingredient_admin')]
    public function adminList(IngredientRepository $ingredientRepository): Response
    {
        $ingredients = $ingredientRepository->findAll();
        return $this->render('admin_ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }

    #[Route('/{id}/edit', name: 'ingredient_edit')]
    public function edit(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $ingredient = $entityManager->getRepository(Ingredient::class)->find($id);
        if (!$ingredient) {
            throw $this->createNotFoundException('Ingrédient non trouvé');
        }
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Ingrédient modifié avec succès.');
            return $this->redirectToRoute('ingredient_admin');
        }
        return $this->render('admin_ingredient/create.html.twig', [
            'form' => $form->createView(),
            'ingredient' => $ingredient,
        ]);
    }

    #[Route('/{id}/delete', name: 'ingredient_delete', methods: ['POST'])]
    public function delete(int $id, EntityManagerInterface $entityManager, Request $request): Response
    {
        $ingredient = $entityManager->getRepository(Ingredient::class)->find($id);
        if (!$ingredient) {
            throw $this->createNotFoundException('Ingrédient non trouvé');
        }
        if ($this->isCsrfTokenValid('delete_ingredient_' . $ingredient->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ingredient);
            $entityManager->flush();
            $this->addFlash('success', 'Ingrédient supprimé avec succès.');
        }
        return $this->redirectToRoute('ingredient_admin');
    }
}
