<?php

namespace App\Controller;

use App\Entity\Camps;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CampController extends AbstractController
{
    /**
     * @Route("/sportkampen", name="camp")
     */
    public function index()
    {
        return $this->render('camp/index.html.twig', [
            'controller_name' => 'CampController',
        ]);
    }

    /**
     * @Route("/sportkampen/{id}", name="showCamp")
     */
    public function showCamp($id)
    {
        $repository = $this->getDoctrine()->getRepository(Camps::class);

        $camp = $repository->find($id);

        return $this->render('camp/index.html.twig', [
            'controller_name' => 'CampController',
            'camp' => $camp,
        ]);
    }

    public function createCamp(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $camp = new Camp();
        $camp->setName('Keyboard');
        $camp->setPrice(1999);
        $camp->setDescription('Ergonomic and stylish!');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($camp);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new camp with id '.$camp->getId());
    }
}
