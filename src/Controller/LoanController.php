<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class LoanController extends Controller {

    /**
     * @Route("/add/product", name="add_product")
     * 
     */
    public function addProduct(ObjectManager $manager, Request $request) {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Vous devez être connecté pour ceeéder à cette page ');

        $product = new Product();
        
                
        $form = $this->createForm(ProductType::class, $product) 
            ->add('Envoyer',SubmitType::class);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            // Upload du fichier image
            var_dump($product);
            $image = $product->getImage();
            // renommage de l'image
            $fileName = md5(uniqid()).'.'.$image->guessExtension();
            // move_upload_file
            $image->move('upload/product',$fileName);
            $product->setImage($fileName);
            $product->setUser($this->getUser());
            
            
        // Enregistrement du produit
            $manager->persist($product);
            $manager->flush();
            return $this->redirectToRoute('my_products');
        }
        
        return $this->render('add_product.html.twig', [
                    'form' => $form->createView()
        ]);
    }
        /**
         * @Route("/product",name="my_products")
         */
        public function myProducts() {
            $this->denyAccessUnlessGranted('ROLE_USER',null,'Vous devez être connecté pour accéder à cette page');
        
         // products are loaded dynamically by doctrine int the view
        return $this->render('my_products.html.twig');   
        }
    
}
