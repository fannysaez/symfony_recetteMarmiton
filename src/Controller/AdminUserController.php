<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;

#[Route('/admin/user')]
final class AdminUserController extends AbstractController
{
    #[Route('/', name: 'admin_user')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('admin_user/index.html.twig', [
            'users' => $users,
        ]);
    }
    #[Route('/{id}', name: 'admin_user_show', methods: ['GET'])]
    public function show(int $id, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);
        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé');
        }
        return $this->render('admin_user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_user_edit', methods: ['GET', 'POST'])]
    public function edit(int $id, UserRepository $userRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $userRepository->find($id);
        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé');
        }
        // À adapter selon votre formulaire UserType
        $form = $this->createForm(\App\Form\UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (empty($user->getRoles())) {
                $this->addFlash('danger', 'Vous devez sélectionner au moins un rôle.');
            } else {
                $entityManager->flush();
                $this->addFlash('success', 'Utilisateur modifié avec succès.');
                return $this->redirectToRoute('admin_user');
            }
        }
        return $this->render('admin_user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/delete', name: 'admin_user_delete', methods: ['POST'])]
    public function delete(int $id, UserRepository $userRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $userRepository->find($id);
        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé');
        }
        if ($this->isCsrfTokenValid('delete_user_' . $user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
            $this->addFlash('success', 'Utilisateur supprimé avec succès.');
        }
        return $this->redirectToRoute('admin_user');
    }
}
