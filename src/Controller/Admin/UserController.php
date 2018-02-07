<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * @Route("/admin/user", name="list_user")
     */
    public function getList(UserRepository/*non la classe  */ $userRepo/* instanciation de l'objet */)
            // cela equivaut à $userRepo = new \App\Respository\UserRepository();
    {
       // notre repository est "injecté" en paramètre de l'action (la méthode de notre controller. $userRepo contient donc une instance 
        //(un objet) prêt à l'emploi de la class UserRepository
        // Cet objet nous sert à récupérer notre liste d'utilisateurs.
        $users =$userRepo->findAll();
        return $this->render('admin/list_user.html.twig',[
                'users' => $users
                ]); // le render permet simplement d'afficher une vue
            
           
    }

    /**
     * @Route("/admin/user/{id}", name="user_details")
     */
    public function detail(User $user) {
        
        // public function detail(UserRepository $userRepo, $id){}
        //$user = $userRepo->find($id);
        return $this->render('admin/details_user.html.twig',[
            'user' => $user
        ]);
    }
    
    
    }
