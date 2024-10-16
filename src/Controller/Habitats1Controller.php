<?php

namespace App\Controller;

use App\Entity\Habitats;
use App\Form\HabitatsType;
use App\Repository\HabitatsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/habitats1')]
final class Habitats1Controller extends AbstractController
{
    #[Route(name: 'app_habitats1_index', methods: ['GET'])]
    public function index(HabitatsRepository $habitatsRepository): Response
    {
        return $this->render('habitats1/index.html.twig', [
            'habitats' => $habitatsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_habitats1_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $habitat = new Habitats();
        $form = $this->createForm(HabitatsType::class, $habitat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($habitat);
            $entityManager->flush();

            return $this->redirectToRoute('app_habitats1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('habitats1/new.html.twig', [
            'habitat' => $habitat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_habitats1_show', methods: ['GET'])]
    public function show(Habitats $habitat): Response
    {
        return $this->render('habitats1/show.html.twig', [
            'habitat' => $habitat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_habitats1_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Habitats $habitat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HabitatsType::class, $habitat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_habitats1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('habitats1/edit.html.twig', [
            'habitat' => $habitat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_habitats1_delete', methods: ['POST'])]
    public function delete(Request $request, Habitats $habitat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$habitat->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($habitat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_habitats1_index', [], Response::HTTP_SEE_OTHER);
    }
}
