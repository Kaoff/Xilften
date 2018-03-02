<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AccountController extends Controller
{
    /**
     * @Route("/account", name="account")
     */
    public function accountAction()
    {
        return $this->render('account/account.html.twig');
    }
}
