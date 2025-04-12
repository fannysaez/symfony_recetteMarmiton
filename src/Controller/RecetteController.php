<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Entity\Comment;
use App\Form\RecipeType;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/recette')]
final class RecetteController extends AbstractController
{
    #[Route('/', name: 'recette_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupérer toutes les recettes
        $recipes = $entityManager->getRepository(Recipe::class)->findAll();

        // Retourner la vue avec les recettes récupérées
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

            // Ajouter la date de mise à jour (car 'updateAt' ne doit pas être null)
            $recipe->setUpdateAt(new \DateTimeImmutable());

            // Associer l'utilisateur connecté à la recette
            $recipe->setUser($this->getUser());

            // Mettre à jour l'URL de l'image (vérifier si l'URL a changé)
            $imageUrl = $form->get('image')->getData();
            if ($imageUrl) {
                $recipe->setImage($imageUrl); // Mettre à jour l'image
            }

            // Sauvegarder la recette en base de données
            $entityManager->persist($recipe);
            $entityManager->flush();

            // Ajouter un message flash de succès
            $this->addFlash('success', 'Votre recette a bien été créée !');

            // Rediriger vers la page de détail de la recette après la création
            return $this->redirectToRoute('recette_show', ['id' => $recipe->getId()]);
        }

        // Renvoyer le formulaire dans la vue
        return $this->render('recette/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'recette_show', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function show(int $id, EntityManagerInterface $entityManager, Request $request): Response
    {
        $recipe = $entityManager->getRepository(Recipe::class)->find($id);
    
        if (!$recipe) {
            throw $this->createNotFoundException('Recette non trouvée');
        }
    
        // Récupération des commentaires associés à la recette
        $comments = $recipe->getComments();
    
        // Création du formulaire de commentaire
        $comment = new Comment();
        $comment->setRecipe($recipe);
        $comment->setCreatedAt(new \DateTimeImmutable());
    
        if ($this->getUser()) {
            $comment->setUser($this->getUser());
        }
    
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($comment);
            $entityManager->flush();
    
            $this->addFlash('success', 'Votre commentaire a bien été ajouté.');
    
            return $this->redirectToRoute('recette_show', ['id' => $id]);
        }
    
        return $this->render('recette/show.html.twig', [
            'recipe' => $recipe,
            'comments' => $comments,
            'commentForm' => $form->createView(),
        ]);
    }}
