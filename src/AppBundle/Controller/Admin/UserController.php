<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 01/03/2018
 * Time: 14:03
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\User;
use AppBundle\Form\UserCreateType;
use AppBundle\Form\UserEditType;
use AppBundle\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/admin/users", name="user_list")
     */
    public function userListAction(UserManager $userManager)
    {
        $users = $userManager->getUsers();

        return $this->render('admin/users/list.html.twig', array(
            'users' => $users
        ));
    }

    /**
     * @Route("/admin/users/create", name="user_create")
     */
    public function userCreateAction(Request $request, UserManager $userManager)
    {
        $user = new User();
        $user->setAvatar(null);

        $form = $this->createForm(UserCreateType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $userManager->registerUserData($task);

            return $this->redirectToRoute('user_list');
        }

        return $this->render('admin/users/add.html.twig', array(
            'user' => $user,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/users/edit/{id}", name="user_edit")
     */
    public function userEditAction(Request $request, UserManager $userManager, string $id)
    {
        $user = $userManager->getUser($id);
        $user->setAvatar(null);

        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $userManager->saveUser($task);

            return $this->redirectToRoute('user_list');
        }

        return $this->render('admin/users/edit.html.twig', array(
            'user' => $user,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/users/delete/{id}", name="user_delete")
     */
    public function userDeleteAction(Request $request, UserManager $userManager, string $id)
    {
        $user = $userManager->getUser($id);
        $userManager->deleteUser($user);

        return $this->redirectToRoute('user_list');
    }
}