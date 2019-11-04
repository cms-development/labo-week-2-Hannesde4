<?php

namespace App\Controller;

use App\Entity\Camps;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Camps::class);

        $camps = $repository->findBy(array(),array('id'=>'DESC'),4,0);


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'camps' => $camps,
        ]);
    }
}
