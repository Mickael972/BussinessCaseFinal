<?php

namespace App\Controller;

use App\Entity\Nftcollection;
use App\Form\NftcollectionType;
use App\Repository\NftcollectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/nftcollection')]
class NftcollectionController extends AbstractController
{
    #[Route('/', name: 'app_nftcollection_index', methods: ['GET'])]
    public function index(NftcollectionRepository $nftcollectionRepository): Response
    {
        return $this->render('nftcollection/index.html.twig', [
            'nftcollections' => $nftcollectionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_nftcollection_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $nftcollection = new Nftcollection();
        $form = $this->createForm(NftcollectionType::class, $nftcollection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($nftcollection);
            $entityManager->flush();

            return $this->redirectToRoute('app_nftcollection_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nftcollection/new.html.twig', [
            'nftcollection' => $nftcollection,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nftcollection_show', methods: ['GET'])]
    public function show(Nftcollection $nftcollection): Response
    {
        return $this->render('nftcollection/show.html.twig', [
            'nftcollection' => $nftcollection,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_nftcollection_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Nftcollection $nftcollection, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NftcollectionType::class, $nftcollection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_nftcollection_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nftcollection/edit.html.twig', [
            'nftcollection' => $nftcollection,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nftcollection_delete', methods: ['POST'])]
    public function delete(Request $request, Nftcollection $nftcollection, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nftcollection->getId(), $request->request->get('_token'))) {
            $entityManager->remove($nftcollection);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_nftcollection_index', [], Response::HTTP_SEE_OTHER);
    }
}
