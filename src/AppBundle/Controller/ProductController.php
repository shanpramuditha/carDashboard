<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Car;
use AppBundle\Entity\Product;
use AppBundle\Form\CarType;
use AppBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/car")
 */
class ProductController extends DefaultController
{
    /**
     * @Route("/add", name="product_add")
     */
    public function addAction(Request $request){
        $car = new Car();
        $form = $this->createForm(CarType::class,$car);
        $form->handleRequest($request);

//        and $form->isValid()
        if($form->isSubmitted()){
            $car->setPrice((float)str_replace("$","",$car->getPrice()));
            $car->setPrice((float)str_replace(" ","",$car->getPrice()));
            $car->setPrice((float)str_replace(",","",$car->getPrice()));


            $car->setEngine((float)str_replace("cc","",$car->getEngine()));
            $car->setEngine((float)str_replace("CC","",$car->getEngine()));
            $car->setEngine((float)str_replace(",","",$car->getEngine()));

            $car->setActive(true);

//            die($car->getPriceStr());
//            $price = $car->getPrice();
//            $priceStr =strval($price);
//            $priceStr1 = str_replace("$", "",$priceStr);
//            $priceStr = str_replace(",", "",$priceStr);
//            $car->setPrice(floatval($priceStr1));

            $this->insert($car);
            return $this->redirectToRoute('product_list');
        }

        return $this->render(':default:product_add.html.twig',array(
           'form'=>$form->createView()
        ));
    }

    /**
     * @Route("/list", name="product_list")
     */
    public function listAction(Request $request){
        $cars = $this->getRepository('Car')->findBy(array('active'=>true));

        return $this->render('default/product_list.html.twig',array(
           'cars'=>$cars
        ));

    }

    /**
     * @Route("/edit/{id}", name="product_edit")
     */
    public function editAction(Request $request,$id){
        $car = $this->getRepository('Car')->find($id);
        $form = $this->createForm(CarType::class,$car);
        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()){
            $car->setPrice((float)str_replace("$","",$car->getPrice()));
            $car->setPrice((float)str_replace(" ","",$car->getPrice()));
            $car->setPrice((float)str_replace(",","",$car->getPrice()));


            $car->setEngine((float)str_replace("cc","",$car->getEngine()));
            $car->setEngine((float)str_replace("CC","",$car->getEngine()));
            $car->setEngine((float)str_replace(",","",$car->getEngine()));
            $this->insert($car);
            return $this->redirectToRoute('product_list');

        }
        return $this->render(':default:product_edit.html.twig',array(
            'form'=>$form->createView()
        ));
    }

    /**
     * @Route("/remove/{id}", name="product_remove")
     */
    public function removeAction(Request $request,$id){
        $car = $this->getRepository('Car')->find($id);
        if($car != null){
            $car->setActive(false);
            $this->insert($car);
        }

        return $this->redirectToRoute('product_list');
    }
}
