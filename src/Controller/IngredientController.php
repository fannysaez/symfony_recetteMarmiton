<?php

namespace App\Controller;

use App\Entity\Ingredient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/ingredient')]
final class IngredientController extends AbstractController{
    #[Route('', name: 'ingredient_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $ingredient = $entityManager->getRepository(Ingredient::class)->findAll();


        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredient,
        ]);
    }
}
