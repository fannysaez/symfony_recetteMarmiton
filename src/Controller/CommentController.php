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
#[Route('/comment/{id}', name: 'comment_show', methods: ['GET'])]
public function show(Comment $comment): Response
{
return $this->render('comment/show.html.twig', [
'comment' => $comment,
]);
}

#[Route('/comment/{id}/edit', name: 'comment_edit', methods: ['GET', 'POST'])]
public function edit(Comment $comment, Request $request, EntityManagerInterface $entityManager): Response
{
$form = $this->createForm(CommentType::class, $comment);
$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
$entityManager->flush();
$this->addFlash('success', 'Commentaire modifié avec succès.');
return $this->redirectToRoute('admin_comment');
}

return $this->render('comment/edit.html.twig', [
'comment' => $comment,
'form' => $form->createView(),
]);
}

#[Route('/comment', name: 'app_comment')]
public function index(Request $request, EntityManagerInterface $entityManager): Response
{
$comment = new Comment();
$form = $this->createForm(CommentType::class, $comment);
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
$entityManager->persist($comment);
$entityManager->flush();
$this->addFlash('success', 'Commentaire ajouté avec succès.');
return $this->redirectToRoute('app_comment');
}
$comments = $entityManager->getRepository(Comment::class)->findBy([], ['createdAt' => 'DESC']);
return $this->render('comment/index.html.twig', [
'form' => $form->createView(),
'comments' => $comments,
]);
}

#[Route('/comment/{id}/delete', name: 'comment_delete', methods: ['POST'])]
public function delete(int $id, EntityManagerInterface $entityManager, Request $request): Response
{
$comment = $entityManager->getRepository(Comment::class)->find($id);
if (!$comment) {
throw $this->createNotFoundException('Commentaire non trouvé');
}
if (!$this->isGranted('ROLE_ADMIN')) {
throw $this->createAccessDeniedException();
}
if ($this->isCsrfTokenValid('delete_comment_' . $comment->getId(), $request->request->get('_token'))) {
$entityManager->remove($comment);
$entityManager->flush();
$this->addFlash('success', 'Commentaire supprimé avec succès.');
}
// Redirection vers la recette associée
$recipe = $comment->getRecipe();
return $this->redirectToRoute('recette_show', ['id' => $recipe ? $recipe->getId() : null]);
}
}