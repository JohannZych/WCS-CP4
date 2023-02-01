<?php

namespace App\Controller;

use App\Entity\Candidacy;
use App\Entity\User;
use App\Form\CandidacyType;
use App\Repository\CandidacyRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/candidacy')]
class CandidacyController extends AbstractController
{
    #[Route('/', name: 'app_candidacy_index', methods: ['GET'])]
    public function index(CandidacyRepository $candidacyRepository): Response
    {
        return $this->render('candidacy/index.html.twig', [
            'candidacies' => $candidacyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_candidacy_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CandidacyRepository $candidacyRepository, User $user): Response
    {
        $candidacy = new Candidacy();
        $form = $this->createForm(CandidacyType::class, $candidacy);
        $form->handleRequest($request);
        $userId = $user->getId();
        if ($form->isSubmitted() && $form->isValid()) {
            $candidacyRepository->save($candidacy, true);

            return $this->redirectToRoute('app_candidacy_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('candidacy/new.html.twig', [
            'candidacy' => $candidacy,
            'form' => $form,
            'userId' => $userId,
        ]);
    }

    #[Route('/{id}', name: 'app_candidacy_show', methods: ['GET'])]
    public function show(Candidacy $candidacy): Response
    {
        return $this->render('candidacy/show.html.twig', [
            'candidacy' => $candidacy,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_candidacy_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Candidacy $candidacy, CandidacyRepository $candidacyRepository, User $user): Response
    {
        $form = $this->createForm(CandidacyType::class, $candidacy);
        $form->handleRequest($request);
        $user= $this->getUser()->getId();
        if ($form->isSubmitted() && $form->isValid()) {
            $candidacyRepository->save($candidacy, true);
            return $this->redirectToRoute('app_user_show', ['id' => $user], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('candidacy/edit.html.twig', [
            'candidacy' => $candidacy,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_candidacy_delete', methods: ['POST'])]
    public function delete(Request $request, Candidacy $candidacy, CandidacyRepository $candidacyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidacy->getId(), $request->request->get('_token'))) {
            $candidacyRepository->remove($candidacy, true);
        }

        return $this->redirectToRoute('app_candidacy_index', [], Response::HTTP_SEE_OTHER);
    }
}
