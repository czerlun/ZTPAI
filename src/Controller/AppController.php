<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Credential;


class AppController extends AbstractController
{
    /**
     * @Route("/homepage", name="app_homepage")
     */
    public function  index(): \Symfony\Component\HttpFoundation\Response
    {
        $user_id = $this->getDoctrine()->getRepository(User::class)->findOneBy(["email"=>$this->getUser()->getUsername()])->getId();
        $credentials = $this->getDoctrine()->getRepository(Credential::class)->findBy(["id_user" => $user_id]);
        return $this->render('app/index.html.twig', [
            'user' => $this->getUser(), 'credentials' => $credentials
        ]);
    }

    /**
     * @Route("/add", name="add_pass")
     */
    public function  add_pass(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('app/add_pass.html.twig', [
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
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('app/admin.html.twig', [
            'user' => $this->getUser(),
            'users' => $users
        ]);
    }
    /**
     * @Route("/del_user/{id}", name="del_user")
     */
    public function del_user(int $id = null)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $credential = $entityManager->getRepository(User::class)->findOneBy(["id"=> $id]);
        if ($credential) {
            $entityManager->remove($credential);
            $entityManager->flush();
        }
        return $this->redirect("/admin");
    }
}