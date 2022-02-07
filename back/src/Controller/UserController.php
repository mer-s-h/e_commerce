<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_create" , methods={"POST"} )
     */
    public function registration(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();
        $newUser = $request->request;

        $profile = $doctrine
            ->getRepository(User::class)
            ->findOneBy([
                "email" => $newUser->get("email")
            ]);

        if (!$profile) {

            $user = new User();
            $password = password_hash($newUser->get('password'), PASSWORD_DEFAULT);
            $user->setEmail($newUser->get('email'));
            $user->setLastname($newUser->get('lastname'));
            $user->setFirstname($newUser->get('firstname'));
            $user->setRoles("user");
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
     * @Route("/login", name="login", methods={"POST"} )
     */
    public function login(ManagerRegistry $doctrine, Request $request): Response
    {
        $newUser = $request->request;

        $user = $doctrine
            ->getRepository(User::class)
            ->findOneBy([
                "email" => $newUser->get("email")
            ]);

        // if ($user == null) {
        //     throw new HttpException(400, 'email or password incorrect');
        // }

        if ($user && password_verify($newUser->get('password'), $user->getPassword())) {
            return $this->json([
                "success" => $user->getId()
            ]);
        } else {
            return $this->json([
                "error" => "email or password incorrect"
            ]);
        }
    }

    /**
     * @Route("/forgot", name="password", methods={"POST"} )
     */

    public function forgot(ManagerRegistry $doctrine, Request $request, MailerInterface $mailer): Response
    {
        $newUser = $request->request;

        $entityManager = $doctrine->getManager();

        $random = substr(md5(rand()), 0, 7);

        $user = $doctrine
            ->getRepository(User::class)
            ->findOneBy([
                "email" => $newUser->get("email")
            ]);

        if (!empty($user)) {

            $email = (new Email())
            ->from('planteco_security@gmail.com')
            ->to($user->getEmail())
            ->subject('Your password reset request')
            ->text("it seem like you forgot your password \n your new password is: \n  " . $random . "\n remember to change it");

            // create a token to send an email with link to a url to change password
            //search JWT (json web token)
            // token should have an expiration date, the id of user


            $mailer->send($email);

            $user->setPassword(password_hash($random, PASSWORD_DEFAULT));
            $entityManager->flush();

        } 
        return $this->json([
            "success" => "an email with your new password has been send"
        ]);
    }

    /**
     * @Route("/read", name="user_read", methods={"POST"} )
     */
    public function read(ManagerRegistry $doctrine, Request $request): Response
    {
        $newUser = $request->request;

        $profile = $doctrine
            ->getRepository(User::class)
            ->findOneBy([
                "id" => $newUser->get("id")
            ]);

        if (!$profile) {
            return $this->json([
                "success" => "user not found"
            ]);
        } else {
            return $this->json([
                "success" => $profile
            ]);
        }
    }
    /**
     * @Route("/update", name="user_update", methods={"POST"} )
     */
    public function update(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $requete = $request->request;

        $profile = $doctrine
            ->getRepository(User::class)
            ->findOneBy([
                "id" => $requete->get("id")
            ]);

        foreach ($requete as $key => $value) {

            switch ($key) {
                case 'email':
                    $profile->setEmail($value);
                    break;
                case 'lastname':
                    $profile->setLastname($value);
                    break;
                case 'firstname':
                    $profile->setFirstname($value);
                    break;
                case 'newPassword':
                    if (password_verify($requete->get('password'), $profile->getPassword())) {
                        $value = password_hash($value, PASSWORD_DEFAULT);
                        $profile->setPassword($value);
                    } else {
                        return $this->json([
                            "error" => "wrong password"
                        ]);
                    }
                    break;
            }
        }

        $entityManager->flush();

        return $this->json([
            "success" => "your profile has been updated"
        ]);
    }
    /**
     * @Route("/delete", name="user_delete", methods={"POST"} )
     */
    public function delete(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();

        $newUser = $request->request;

        $profile = $doctrine
            ->getRepository(User::class)
            ->findOneBy([
                "id" => $newUser->get("id")
            ]);

        if (password_verify($newUser->get('password'), $profile->getPassword())) {

            $entityManager->remove($profile);
            $entityManager->flush();

            return $this->json([
                "success" => "your profile has been removed"
            ]);
        } else {
            return $this->json([
                "error" => "403 access denied"
            ]);
        }
    }
}