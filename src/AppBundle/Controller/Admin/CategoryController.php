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

class CategoryController extends Controller
{
    /**
     * @Route("/admin/categories", name="category_list")
     */
    public function categoryListAction(CategoryManager $categoryManager)
    {
        $categories = $categoryManager->getCategories();

        return $this->render('admin/categories/list.html.twig', array(
            'categories' => $categories
        ));
    }

    /**
     * @Route("/admin/categories/create", name="category_create")
     */
    public function categoryCreateAction(Request $request, CategoryManager $categoryManager)
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $categoryManager->saveCategory($task);

            return $this->redirectToRoute('category_list');
        }

        return $this->render('admin/categories/add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/categories/edit/{id}", name="category_edit")
     */
    public function categoryEditAction(Request $request, CategoryManager $categoryManager, string $id)
    {
        $category = $categoryManager->getCategory($id);

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $categoryManager->saveCategory($task);

            return $this->redirectToRoute('category_list');
        }

        return $this->render('admin/categories/edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/categories/delete/{id}", name="category_delete")
     */
    public function categoryDeleteAction(Request $request, CategoryManager $categoryManager, string $id)
    {
        $episode = $categoryManager->getCategory($id);

        $categoryManager->deleteCategory($episode);

        return $this->redirectToRoute('category_list');

    }
}