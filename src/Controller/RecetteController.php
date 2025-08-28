<?php

namespace App\Controller;

use App\Entity\Like;
use App\Entity\Recipe;
use App\Entity\Comment;
use App\Form\RecipeType;
use App\Form\CommentType;
use App\Repository\LikeRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/recette')]
final class RecetteController extends AbstractController
{
    #[Route('/{id}/like', name: 'recette_like', methods: ['POST'])]
    public function like(int $id, EntityManagerInterface $entityManager, LikeRepository $likeRepository): JsonResponse
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(['error' => 'Non autorisé'], 401);
        }
        if (in_array('ROLE_ADMIN', $user->getRoles(), true)) {
            return new JsonResponse(['error' => 'Les administrateurs ne peuvent pas liker.'], 403);
        }
        $recipe = $entityManager->getRepository(Recipe::class)->find($id);
        if (!$recipe) {
            return new JsonResponse(['error' => 'Recette non trouvée'], 404);
        }
        /** @var \App\Entity\User|null $recipeUser */
        $recipeUser = $recipe->getUser();
        if ($recipeUser && method_exists($user, 'getId') && method_exists($recipeUser, 'getId') && $recipeUser->getId() === $user->getId()) {
            return new JsonResponse(['error' => 'Impossible de liker sa propre recette'], 403);
        }
        $existingLike = $likeRepository->findOneBy(['recipe' => $recipe, 'user' => $user]);
        if ($existingLike) {
            $entityManager->remove($existingLike);
            $entityManager->flush();
            $liked = false;
        } else {
            $like = new Like();
            $like->setRecipe($recipe);
            $like->setUser($user);
            $like->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($like);
            $entityManager->flush();
            $liked = true;
        }
        $likeCount = $likeRepository->count(['recipe' => $recipe]);
        return new JsonResponse([
            'liked' => $liked,
            'likeCount' => $likeCount
        ]);
    }

    #[Route('/', name: 'recette_index')]
    public function index(EntityManagerInterface $entityManager, CommentRepository $commentRepository): Response
    {
        // Récupération des recettes avec leurs tags (fetch join)
        $recipes = $entityManager->createQuery(
            'SELECT r FROM App\\Entity\\Recipe r'
        )->getResult();

        foreach ($recipes as $recipe) {
            $recipe->commentCount = $commentRepository->count(['recipe' => $recipe]);
        }

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
            $title = $recipe->getTitle();
            $slug = $slugger->slug($title)->lower();
            $recipe->setSlug($slug);

            $recipe->setCreatedAt(new \DateTimeImmutable());
            $recipe->setUpdateAt(new \DateTimeImmutable());
            /** @var \App\Entity\User $user */
            $user = $this->getUser();
            $recipe->setUser($user);

            $imageUrl = $form->get('image')->getData();
            if ($imageUrl) {
                $recipe->setImage($imageUrl);
            }

            // Gestion des tags
            $tagsString = $form->get('tags')->getData();
            if ($tagsString) {
                $tagNames = array_filter(array_map('trim', explode(',', $tagsString)));
                $tagRepo = $entityManager->getRepository(\App\Entity\Tag::class);
                foreach ($tagNames as $tagName) {
                    if ($tagName === '') continue;
                    $existingTag = $tagRepo->findOneBy(['name' => $tagName]);
                    if (!$existingTag) {
                        $existingTag = new \App\Entity\Tag();
                        $existingTag->setName($tagName);
                        $entityManager->persist($existingTag);
                    }
                    $recipe->addTag($existingTag);
                }
            }

            $entityManager->persist($recipe);
            $entityManager->flush();

            $this->addFlash('success', 'Votre recette a bien été créée !');

            return $this->redirectToRoute('recette_show', ['id' => $recipe->getId()]);
        }

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

        $comments = $recipe->getComments();

        $comment = new Comment();
        $comment->setRecipe($recipe);
        $comment->setCreatedAt(new \DateTimeImmutable());

        if ($this->getUser()) {
            /** @var \App\Entity\User $user */
            $user = $this->getUser();
            $comment->setUser($user);
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
    }
    #[Route('/{id}/favori', name: 'recette_favori', methods: ['POST'])]
    public function favori(int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        /** @var \App\Entity\User|null $user */
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(['error' => 'Non autorisé'], 401);
        }
        if (in_array('ROLE_ADMIN', $user->getRoles(), true)) {
            return new JsonResponse(['error' => 'Les administrateurs ne peuvent pas ajouter aux favoris.'], 403);
        }
        $recipe = $entityManager->getRepository(Recipe::class)->find($id);
        if (!$recipe) {
            return new JsonResponse(['error' => 'Recette non trouvée'], 404);
        }
        if ($user->getFavorites()->contains($recipe)) {
            $user->removeFavorite($recipe);
            $entityManager->flush();
            $isFavori = false;
        } else {
            $user->addFavorite($recipe);
            $entityManager->flush();
            $isFavori = true;
        }
        return new JsonResponse([
            'favori' => $isFavori
        ]);
    }

    #[Route('/{id}/edit', name: 'recette_edit', methods: ['GET', 'POST'])]
    public function edit(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $recipe = $entityManager->getRepository(Recipe::class)->find($id);
        if (!$recipe) {
            throw $this->createNotFoundException('Recette non trouvée');
        }
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException();
        }
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $recipe->setUpdateAt(new \DateTimeImmutable());
            $entityManager->flush();
            $this->addFlash('success', 'Recette modifiée avec succès.');
            return $this->redirectToRoute('recette_show', ['id' => $recipe->getId()]);
        }
        return $this->render('recette/edit.html.twig', [
            'form' => $form->createView(),
            'recipe' => $recipe,
        ]);
    }

    #[Route('/{id}/delete', name: 'recette_delete', methods: ['POST'])]
    public function delete(int $id, EntityManagerInterface $entityManager, Request $request): Response
    {
        $recipe = $entityManager->getRepository(Recipe::class)->find($id);
        if (!$recipe) {
            throw $this->createNotFoundException('Recette non trouvée');
        }
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException();
        }
        if ($this->isCsrfTokenValid('delete_recette_' . $recipe->getId(), $request->request->get('_token'))) {
            $entityManager->remove($recipe);
            $entityManager->flush();
            $this->addFlash('success', 'Recette supprimée avec succès.');
        }
        return $this->redirectToRoute('recette_index');
    }
}
