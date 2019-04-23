<?php

namespace App\Controller;

use App\Document\User;
use App\Repository\UserRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\DocumentRepository;
use MongoDB\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{



    /**
     * @var User $user
     * @Route("/user/create", name="user_create")
     * @return Response
     */
    public function create(DocumentManager $dm):Response{
        $user = new User();
        $user->setFirstname('khaoula');
        $user->setLastname('abaidi');
        $user->setEmail('abaidik@gmail.com');
        $user->setPassword('1111');
        $dm->persist($user);
        $dm->flush();
        return new Response('Created user id '.$user->getId().'hii mongodb');

    }

    /**
     * @Route("/user/show", name="user_show")
     * @return Response
     */
    public function show(DocumentManager $dm):Response{

        /** @var Collection $users */

        /** @var DocumentRepository $repository */
        $repository = $dm->getRepository(User::class);
        $users = $repository->findAll();
        dump($users);
        return $this->render('user/show.html.twig',[
            'users' => $users
        ]);
    }

    /**
     * @Route("/user/show2",name="user_show2")
     */
    public function have(UserRepository $repository):Response{
        $users = $repository->findAll();
      //  dump($users);die;
        return $this->render('user/show.html.twig', [
            'users' => $users,
        ]);
    }
}
