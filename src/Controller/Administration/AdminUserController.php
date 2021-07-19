<?php

namespace App\Controller\Administration;

use App\Controller\DefaultController;
use App\Entity\User;
use App\Form\AdminEditUserType;
use App\Form\AdminUserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin/dashboard/utilisateurs")
 */
class AdminUserController extends DefaultController
{
    /**
     * UserRepository.
     *
     * @var UserRepository
     */
    private $userRepo;

    /**
     * Entity Manager.
     *
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(UserRepository $userRepo, EntityManagerInterface $manager)
    {
        $this->userRepo = $userRepo;
        $this->manager = $manager;
    }

    /**
     * @Route(name="admin_users_list", methods={"GET"})
     */
    public function adminUsersList(): Response
    {
        $usersList = $this->userRepo->findAll();

        return $this->render('administration/user/user.list.html.twig', [
            'users_list' => $usersList,
        ]);
    }

    /**
     * @Route("/ajouter", name="admin_user_new", methods={"GET","POST"})
     */
    public function adminUserNew(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $form = $this->createForm(AdminUserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $this->manager->persist($user);
            $this->manager->flush();
            $this->addFlash('success', "L'utilisateur a été ajouté avec succès");

            return $this->redirectToRoute('admin_user_show', [
                'id' => $user->getId(),
            ]);
        }
        $this->addFlash('danger', "L'utilisateur n'a pas été ajouté");

        return $this->render('administration/user/user.create.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/afficher", name="admin_user_show", methods={"GET"})
     */
    public function adminUserShow(User $user): Response
    {
        return $this->render('administration/user/user.show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="admin_user_edit", methods={"GET","POST"})
     */
    public function adminUserEdit(Request $request, User $user): Response
    {
        $form = $this->createForm(AdminEditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();

            $this->addFlash('success', "L'utilisateur a été mis à jour avec succès");

            return $this->redirectToRoute('admin_users_list');
        }

        $this->addFlash('danger', "L'utilisateur n'a pas été mis à jour");

        return $this->render('administration/user/user.edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/supprimer", name="admin_user_delete")
     */
    public function adminUserDelete(User $user): Response
    {
        $this->manager->remove($user);
        $this->manager->flush();
        // à transformer en désactivation plus tard.
        $this->addFlash('success', "L'utilisateur a été supprimé avec succès");

        return $this->redirectToRoute('admin_users_list');
    }
}
