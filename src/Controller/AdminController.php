<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

final class AdminController extends AbstractController{
    #[Route('/admin', name: 'admin_index')]
    public function index(AuthorizationCheckerInterface $authChecker): Response
    {
        if (!$authChecker->isGranted('ROLE_ADMIN')) {
            // Rediriger ou afficher un message si l'utilisateur n'a pas le rôle admin
            return $this->redirectToRoute('home_index');
        }

        return $this->render('admin/index.html.twig');
    }}
