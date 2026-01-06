<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CertificationController extends AbstractController
{
    #[Route('/certification', name: 'certification')]
    public function list(): Response
    {
        return $this->render('certification/list.html.twig');
    }

    #[Route('/certification/{id}', name: 'certification_details')]
    public function details(int $id): Response
    {
        return $this->render('certification/details.html.twig', [
            'id' => $id,
        ]);
    }
}