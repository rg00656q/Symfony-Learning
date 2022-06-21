<?php

namespace App\Controller;

use App\Entity\CarPool;
use App\Form\CarPoolType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/list', name: 'carpool-list')]
    public function list(ManagerRegistry $doctrine): Response
    {
        $carpools = $doctrine->getRepository(CarPool::class)->findAll();

        return $this->render('carpool/index.html.twig', [
            'carpools' => $carpools,
        ]);
    }

    #[Route('/trip/{carpool}', name: 'carpool-id')]
    public function show(CarPool $carpool): Response
    {
        return $this->render('carpool/show.html.twig', [
            'carpool' => $carpool,
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        // Creating a new CarPool
        $carpool = new CarPool();
        $form = $this->createForm(CarPoolType::class, $carpool);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // Entity Manager
            $em = $doctrine->getManager();
            $em->persist($carpool);
            $em->flush();
            return $this->redirect($this->generateUrl('carpool-list'));
        }


        return $this->render('carpool/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{carpool}', name: 'delete')]
    public function delete(CarPool $carpool, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $em->remove($carpool);
        $em->flush();

        $this->addFlash('success', 'Your car pool has been removed');

        return $this->redirect($this->generateUrl('carpool-list'));
    }
}