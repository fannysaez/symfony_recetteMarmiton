<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/comment/admin')]
final class AdminCommentController extends AbstractController
{
    #[Route('/', name: 'admin_comment')]
    public function index(CommentRepository $commentRepository): Response
    {
        $comments = $commentRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('admin_comment/index.html.twig', [
            'comments' => $comments,
        ]);
    }
}
