<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Products;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;

class ProductsController extends Controller {

    public function index() {
        $repository = $this->getDoctrine()->getRepository(Products::class);
        $products = $repository->findAll();

        if (!$products) {
            throw $this->createNotFoundException(
                'No product found.'
            );
        }
    
        return $this->render('products/index.html.twig', [
            'controller_name' => 'ProductsController',
            'products' => $products
        ]);
    }

    public function details($id, SessionInterface $session) {
        $repository = $this->getDoctrine()->getRepository(Products::class);
        $product = $repository->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found.'
            );
        }

        return $this->render('products/details.html.twig', [
            'controller_name' => 'ProductsController',
            'product' => $product
        ]);
    }

    public static function basketTotalPrice($basket) {
        $total_price = 0;
        foreach($basket as $p) {
            $total_price += $p[1] * $p[0]->getPrice();
        }
        return $total_price;
    }

    public function basketIndex(SessionInterface $session) {
        $panier = $session->get('panier');
        $new_panier = array();

        if(isset($panier)) {
            foreach($panier as $key => $p) {
                $repository = $this->getDoctrine()->getRepository(Products::class);
                $product = $repository->find($key);
    
                $new_panier[] = array($product, $p);
            }
        }

        $total_price = ProductsController::basketTotalPrice($new_panier);

        return $this->render('products/basket.html.twig', [
            'controller_name' => 'ProductsController',
            'panier' => $new_panier,
            'total_price' => $total_price
        ]);
    }

    public function basketAdd(Request $request, SessionInterface $session) {
        $id = $request->request->get('id');
        $quantity = $request->request->get('quantity');
        
        $repository = $this->getDoctrine()->getRepository(Products::class);
        $product = $repository->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found.'
            );
        }

        $tab = $session->get('panier');
        if(isset($tab[$product->getId()])) {
            $tab[$product->getId()] += $quantity;
        } else {
            $tab[$product->getId()] = $quantity;
        }
        $session->remove('panier');
        $session->set('panier', $tab);

        return $this->redirectToRoute('products_details', array('id' => $id));
    }

    public function basketDeleteAll(SessionInterface $session) {
        $session->clear();

        return $this->redirectToRoute('products_basket');
    }

    public function basketDelete(SessionInterface $session, $id) {
        $panier = $session->get('panier');

        unset($panier[$id]);

        $session->set('panier', $panier);

        return $this->redirectToRoute('products_basket');
    }

    public function basketModify(SessionInterface $session, $id, $modification) {
        $panier = $session->get('panier');

        if($modification == 'minus') {
            $panier[$id] -= 1;
            if($panier[$id] <= 0) {
                unset($panier[$id]);
            }
        } else if($modification == 'plus') {
            $panier[$id] += 1;
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('products_basket');
    }

}