<?php

namespace App\Controller;

use App\Entity\Animaux;
use App\Form\AddAnimalFormType;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\Rule\Parameters;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/animaux', name: 'app_animaux')]
class AnimauxController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('animaux/index.html.twig', [
            'controller_name' => 'AnimauxController',
        ]);
    }

    #[Route(path: '/ajouter', name: 'add')]
    public function addanimal(Request $request, EntityManagerInterface $em): Response
    {
        $animal = new Animaux();
        $animalForm = $this->createForm(AddAnimalFormType::class, $animal);

        $animalForm->handleRequest($request);

        if ($animalForm->isSubmitted() && $animalForm->isValid()) {
            $em->persist($animal);
            $em->flush();
            return $this->redirectToRoute('app_main');
        }
        return $this->render('animaux/add.html.twig', [
            'animalForm' => $animalForm->createView(),
        ]);
    }
}