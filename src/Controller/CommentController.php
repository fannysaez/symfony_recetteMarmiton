<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Recipe;

final class CommentController extends AbstractController
{
    #[Route('/comment', name: 'app_comment')]
    public function index(): Response
    {
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }

    // #[Route('/recette/{id}', name: 'recipe_show', methods: ['GET', 'POST'])]
    // public function show(Recipe $recipe, Request $request, EntityManagerInterface $em): Response
    // {
    //     $comment = new Comment();
    //     $form = $this->createForm(CommentType::class, $comment);
    //     $form->handleRequest($request);
    
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $comment->setCreatedAt(new \DateTimeImmutable());
    //         $comment->setUser($this->getUser());
    //         $comment->setRecipe($recipe);
    
    //         $em->persist($comment);
    //         $em->flush();
    
    //         $this->addFlash('success', 'Commentaire ajouté avec succès.');
    
    //         return $this->redirectToRoute('recipe_show', ['id' => $recipe->getId()]);
    //     }
    
    //     return $this->render('recipe/show.html.twig', [
    //         'recipe' => $recipe,
    //         'comments' => $recipe->getComments(),
    //         'comment' => $form->createView(),
    //     ]);
    }
