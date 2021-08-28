<?php

namespace App\Controller;

use App\Entity\Credential;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;

class CredentialController extends AbstractController
{
    /**
     * @Route("/dodaj_konto", name="dodaj_konto")
     */
    public function  add_item( Request $request ): \Symfony\Component\HttpFoundation\Response
    {
        $user_id = $this->getDoctrine()->getRepository(User::class)->findOneBy(["email"=>$this->getUser()->getUsername()])->getId();
        $entiy_c = $this->getDoctrine()->getManager();
        $credential = new Credential();
        $credential->setUrlAdress($request->request->get("url"));
        $credential->setEmail($request->request->get("email"));
        $credential->setPassword($request->request->get("password"));
        $credential->setDescription($request->request->get("description"));
        $credential->setID_user($user_id);
        $entiy_c->persist($credential);
        $entiy_c->flush();

        return $this->redirect("/homepage");
    }

    /**
     * @Route("/usun/{id}", name="usun")
     */
    public function remove_item( $id )
    {
        $user_id = $this->getDoctrine()->getRepository(User::class)->findOneBy(["email"=>$this->getUser()->getUsername()])->getId();
        $entityManager = $this->getDoctrine()->getManager();
        $credential = $entityManager->getRepository(Credential::class)->findOneBy(["id"=> $id, "id_user"=> $user_id]);
        if ($credential) {
            $entityManager->remove($credential);
            $entityManager->flush();
        }
        return $this->redirect("/homepage");
    }
}
