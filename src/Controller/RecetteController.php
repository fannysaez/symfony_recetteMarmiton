<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/recette')]
final class RecetteController extends AbstractController
{
    #[Route('/', name: 'recette_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $recipes = $entityManager->getRepository(Recipe::class)->findAll();

        return $this->render('recette/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }

    #[Route('/create', name: 'recette_create')]
    public function create(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Générer le slug à partir du titre
            $title = $recipe->getTitle();
            $slug = $slugger->slug($title)->lower();
            $recipe->setSlug($slug);

            // Ajouter la date de création
            $recipe->setCreatedAt(new \DateTimeImmutable());
            $recipe->setUser($this->getUser());  // Associer l'utilisateur connecté à la recette

            // Sauvegarder la recette
            $entityManager->persist($recipe);
            $entityManager->flush();

            $this->addFlash('success', 'Votre recette a bien été créée !');

            return $this->redirectToRoute('recette_show', ['id' => $recipe->getId()]);
        }

        return $this->render('recette/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'recette_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Recipe $recipe): Response
    {
        return $this->render('recette/show.html.twig', [
            'recipe' => $recipe,
        ]);
    }}
