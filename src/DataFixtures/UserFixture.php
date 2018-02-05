<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserFixtures
 *
 * @author Aleksa.Culibrk
 */

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends Fixture{
    
    public function load(ObjectManager $manager) {
        // On créé une liste factice de 20 utilisateurs       
        for($i=1; $i<=20; $i++){
            $user = new User();
            $user->setUsername('user'.$i);
            $user->setEmail('user'.$i.'@mail.com');
            $user->setFirstname('User'.$i);
            $user->setLastname('Fake');
            $user->setPassword(password_hash('user'.$i,PASSWORD_BCRYPT));
            $user->setBirthdate(\DateTime::createFromFormat('Y/m/d h:i:s', (2000 - $i).'/01/01 00:00:00'));
            // on demande au manager d'enregistrer l'utilisateur en base de données
            $manager->persist($user);
            $manager->flush();
            
        }
    }

}
