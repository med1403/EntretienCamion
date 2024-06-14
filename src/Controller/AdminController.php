<?php
// src/Controller/AdminController.php
namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{
    #[Route(path: '/', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'admin/login.html.twig',
            [
                'last_username' => $lastUsername,
                'error' => $error
            ]
        );
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('Rien.');
    }

    #[Route(path: '/accueil', name: 'app_home')]
    public function redirectToHome(): Response
    {
        return $this->render('accueil/index.html.twig');
    }
    #[Route('/admin/create', name: 'admin_create')]
    #[IsGranted('ROLE_ADMIN')]
    public function create(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, UserPasswordHasherInterface $passwordHasher): Response
    {
        $this->denyAccessUnlessGranted('general', $this->getUser());

        if ($request->isMethod('POST')) {
            $username = $request->request->get('username');
            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            $email = $request->request->get('email');
            $telephone = $request->request->get('telephone');
            $photo = $request->files->get('photo');
            $password = $request->request->get('password');
            $passwordConfirm = $request->request->get('password_confirm');
            $typeAdmin = $request->request->get('type_admin');

            // Gestion de la photo
            if ($photo) {
                // Renommer et déplacer le fichier téléchargé
                $newFilename = $slugger->slug($username) . '-' . uniqid() . '.' . $photo->guessExtension();

                try {
                    $photo->move(
                        $this->getParameter('photos_directory'), // Répertoire de destination (paramètre configuré dans services.yaml)
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors du téléchargement du fichier.');
                    return $this->redirectToRoute('admin_create');
                }
            }

            // Vérification des mots de passe
            if ($password !== $passwordConfirm) {
                $this->addFlash('error', 'Les mots de passe ne correspondent pas.');
                return $this->redirectToRoute('admin_create');
            }

            // Création de l'entité User
            $user = new User();
            $user->setUsername($username);
            $user->setTypeAdmin($typeAdmin);
            $user->setNom($nom);
            $user->setPrenom($prenom);
            $user->setEmail($email);
            $user->setTelephone($telephone);

            // Si une photo a été téléchargée, enregistrez le nom du fichier dans l'entité User
            if (isset($newFilename)) {
                $user->setPhoto($newFilename);
            }

            // Hashage du mot de passe
            $hashedPassword = $passwordHasher->hashPassword($user, $password);
            $user->setPassword($hashedPassword);

            // Attribution du rôle ROLE_ADMIN
            $user->setRoles(['ROLE_ADMIN']);

            // Persistance et sauvegarde de l'utilisateur
            $entityManager->persist($user);
            $entityManager->flush();

            // Message flash de succès et redirection
            $this->addFlash('success', 'Admin créé avec succès.');
            return $this->redirectToRoute('admin_create');
        }

        return $this->render('admin/create.html.twig');
    }

    #[Route('/admin/{id}/edit', name: 'admin_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, UserPasswordHasherInterface $passwordHasher, int $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé');
        }

        // Vérifiez l'accès à l'utilisateur connecté ou à un rôle spécifique
        if ($user != $this->getUser() && !$this->isGranted('ROLE_ADMIN')) {
            throw $this->createNotFoundException('Vous n\'avez pas accès à cette page');
        }

        if ($request->isMethod('POST')) {
            $username = $request->request->get('username');
            $password = $request->request->get('password');
            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            $email = $request->request->get('email');
            $telephone = $request->request->get('telephone');
            $photo = $request->files->get('photo');
            $passwordConfirm = $request->request->get('password_confirm');
            $currentPassword = $request->request->get('current_password');

            // Gestion de la photo
            if ($photo) {
                // Renommer et déplacer le fichier téléchargé
                $newFilename = $slugger->slug($user->getUsername()) . '-' . uniqid() . '.' . $photo->guessExtension();

                try {
                    $photo->move(
                        $this->getParameter('photos_directory'), // Répertoire de destination (paramètre configuré dans services.yaml)
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors du téléchargement du fichier.');
                    return $this->redirectToRoute('admin_edit', ['id' => $id]);
                }
            }
            // Vérifier et mettre à jour les champs
            if ($password !== $passwordConfirm) {
                $this->addFlash('error', 'Les mots de passe ne correspondent pas.');
                return $this->redirectToRoute('admin_edit', ['id' => $id]);
            }

            // Vérifier le mot de passe actuel
            if (!$passwordHasher->isPasswordValid($user, $currentPassword)) {
                $this->addFlash('error', 'Mot de passe actuel incorrect.');
                return $this->redirectToRoute('admin_edit', ['id' => $id]);
            }

            $user->setUsername($username);
            $user->setNom($nom);
            $user->setPrenom($prenom);
            $user->setEmail($email);
            $user->setTelephone($telephone);
            $user->setPhoto($photo);
            // Si une photo a été téléchargée, enregistrez le nom du fichier dans l'entité User
            if (isset($newFilename)) {
                $user->setPhoto($newFilename);
            }

            if (!empty($password)) {
                $hashedPassword = $passwordHasher->hashPassword($user, $password);
                $user->setPassword($hashedPassword);
            }

            $entityManager->flush();

            $this->addFlash('success', 'Informations utilisateur modifiées avec succès.');
            return $this->redirectToRoute('admin_edit', ['id' => $id]);
        }

        return $this->render('admin/edit.html.twig', [
            'user' => $user,
        ]);
    }
    #[Route('/admin/list', name: 'admin_list')]
    public function listUsers(EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('general', $this->getUser());

        $users = $entityManager->getRepository(User::class)->findAll();

        return $this->render('admin/list.html.twig', [
            'users' => $users,
        ]);
    }
    //Suppression d'un utilisateur
    #[Route('/admin/{id}/delete', name: 'admin_delete', methods: ['POST'])]
    public function deleteAdmin(User $admin, Request $request,EntityManagerInterface $entityManager, int $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if ($this->isCsrfTokenValid('delete' . $admin->getId(), $request->request->get('_token'))) {
            $entityManager->remove($admin);
            $entityManager->flush();

            $this->addFlash('success', 'Admin supprimé avec succès.');
        } else {
            $this->addFlash('error', 'Token CSRF invalide.');
        }

        return $this->redirectToRoute('admin_list');
    }
}
