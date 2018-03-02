<?php

namespace AppBundle\Controller;

use Doctrine\DBAL\Types\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="search")
     */
    public function searchAction()
    {
        $form = $this->createFormBuilder()
            ->add('search', \Symfony\Component\Form\Extension\Core\Type\TextType::class)
            ->add('submit', SubmitType::class, ['label' => 'Register'])
            ->getForm();

        return $this->render('search.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
