<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 01/03/2018
 * Time: 14:03
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Category;
use AppBundle\Entity\Episode;
use AppBundle\Entity\Movie;
use AppBundle\Entity\User;
use AppBundle\Form\CategoryType;
use AppBundle\Form\EpisodeType;
use AppBundle\Form\MovieType;
use AppBundle\Form\UserCreateType;
use AppBundle\Form\UserEditType;
use AppBundle\Manager\CategoryManager;
use AppBundle\Manager\EpisodeManager;
use AppBundle\Manager\MovieManager;
use AppBundle\Manager\SeasonManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_panel")
     */
    public function adminAction()
    {
        return $this->render('admin/admin.html.twig');
    }
}