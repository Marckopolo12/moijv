<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomeController
 *
 * @author Aleksa.Culibrk
 */
class HomeController extends Controller {
    /**
     * @Route("/")
     * @Route("/home")
     */
    
    public function home()
    {
        return $this ->render('home.html.twig');
    }

}