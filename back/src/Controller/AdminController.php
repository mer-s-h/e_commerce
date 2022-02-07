<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/admin",)
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/create", name="admin_create" , methods={"POST"} )
     */
    public function create(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();
        $requete = $request->request;

        $profile = $doctrine
            ->getRepository(User::class)
            ->findOneBy([
                "email" => $requete->get("email")
            ]);

        if (!$profile) {

            $user = new User();
            $password = password_hash($requete->get('password'), PASSWORD_DEFAULT);
            $user->setEmail($requete->get('email'));
            $user->setLastname($requete->get('lastname'));
            $user->setFirstname($requete->get('firstname'));
            $user->setRoles("admin");
            $user->setPassword($password);

            $entityManager->persist($user);
            $entityManager->flush();


            return $this->json([
                "success" => "you have successfully registered"
            ]);
        } else {
            return $this->json([
                "error" => "this email already exist"
            ]);
        }
    }

    /**
     * @Route("/read", name="admin_read", methods={"POST"} )
     */
    public function read(ManagerRegistry $doctrine, Request $request): Response
    {
        $requete = $request->request;

        foreach ($requete as $key => $value) {

            if ($key == "role") {

                switch ($value) {
                    case "user":
                        $profile = $doctrine
                            ->getRepository(User::class)
                            ->findBy([
                                "roles" => $value
                            ]);
                        return $this->json([
                            "success" => $profile
                        ]);

                        break;
                    case "admin":
                        $profile = $doctrine
                            ->getRepository(User::class)
                            ->findBy([
                                "roles" => $value
                            ]);
                        return $this->json([
                            "success" => $profile
                        ]);
                        break;
                    default:
                        $profile = $doctrine
                            ->getRepository(User::class)
                            ->findAll();

                        return $this->json([
                            "success" => $profile
                        ]);

                        break;
                }
            }
        }
    }


    /**
     * @Route("/give", name="admin_give", methods={"POST"} )
     */
    public function giveAdmin(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $requete = $request->request;

        $profile = $doctrine
            ->getRepository(User::class)
            ->findOneBy([
                "id" => $requete->get("id")
            ]);

        $profile->setRoles("admin");

        $entityManager->flush();

        return $this->json([
            "success" => "this profile has been updated to administration"
        ]);
    }

    /**
     * @Route("/remove", name="admin_remove", methods={"POST"} )
     */
    public function removeAdmin(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $requete = $request->request;

        $profile = $doctrine
            ->getRepository(User::class)
            ->findOneBy([
                "id" => $requete->get("id")
            ]);

        $profile->setRoles("user");

        $entityManager->flush();

        return $this->json([
            "success" => "this profile has been updated to user"
        ]);
    }


    /**
     * @Route("/delete", name="admin_delete", methods={"POST"} )
     */
    public function delete(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $requete = $request->request;

        $profile = $doctrine
            ->getRepository(User::class)
            ->findOneBy([
                "id" => $requete->get("id")
            ]);

        if (password_verify($requete->get('password'), $profile->getPassword())) {

            $entityManager->remove($profile);
            $entityManager->flush();

            return $this->json([
                "success" => "your profile has been removed"
            ]);
        } else {
            return $this->json([
                // access denied
                "error" => 403
            ]);
        }
    }
}
