<?php

namespace App\Controller;

use App\Entity\Jobs;
use App\Form\JobsType;
use App\Form\SearchContentType;
use App\Repository\JobsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/jobs')]
class JobsController extends AbstractController
{
    #[Route('/', name: 'app_jobs_index', methods: ['GET', 'POST'])]
    public function index(Request $request, JobsRepository $jobsRepository): Response
    {
        $form = $this->createForm(SearchContentType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $jobs = $jobsRepository->findBySearch($search);
            return $this->render('jobs/index.html.twig', [
                'jobs' => $jobs,
                'form' => $form->createView(),
            ]);
        }
        return $this->render('jobs/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_jobs_show', methods: ['GET'])]
    public function show(Jobs $job): Response
    {
        return $this->render('jobs/show.html.twig', [
            'job' => $job,
        ]);
    }
}
