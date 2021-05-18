<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AppController extends AbstractController
{
    /**
     * @Route("/homepage", name="app_homepage")
     */
    public function  index(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('app/index.html.twig', [
            'user' => $this->getUser()
        ]);
    }

    /**
     * @Route("/", name="homepage")
     */
    public function  home(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('app/home.html.twig', [
            'user' => $this->getUser()
        ]);
    }

    /**
     * @Route("/admin", name="admin_page")
     */
    public function  admin_p(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('app/admin.html.twig', [
            'user' => $this->getUser()
        ]);
    }
}