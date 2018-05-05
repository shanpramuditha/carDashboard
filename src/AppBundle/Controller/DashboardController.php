<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends DefaultController
{

    /**
     * @Route("/", name="search")
     */
    public function searchAction(Request $request){
        $fuel = explode(",", $request->get('fuel'));
        $doors = $request->get('doors');
        $price = explode(",",$request->get('price'));
        $wheels = $request->get('wheels');

        $speed = explode(",",$request->get('speed'));
        $convertable = $request->get('convertable');
        if ($convertable != null){
            $convertable = 1;
        }
        $em = $this->getDoctrine()->getManager();

        $cars = $em->getRepository('AppBundle:Car')->search($fuel,$wheels,$price,$doors,$speed,$convertable);
        return $this->render("default/search.html.twig",array(
            'fuel'=>$fuel,
            'wheels'=>$wheels,
            'price'=>$price,
            'speed'=>$speed,
            'doors'=>$doors,
            'convertable'=>$convertable,
            'cars'=>$cars,
        ));
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboardAction(Request $request){
        return $this->redirectToRoute('product_list');
    }





}
