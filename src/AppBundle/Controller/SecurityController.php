<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 26/02/2018
 * Time: 11:31
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\UserEditType;
use AppBundle\Manager\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     *
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {/*Nothing to do here*/}

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request, UserManager $userManager)
    {
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('email', TextType::class)
            ->add('password', PasswordType::class)
            ->add('avatar', FileType::class, ['required' => false])
            ->add('fullname', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Register'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $form->getData();

            $userManager->registerUserData($user);
            return $this->redirectToRoute('home');
        }


        return $this->render('security/register.html.twig',
            ['form' => $form->createView()]
        );
    }
}