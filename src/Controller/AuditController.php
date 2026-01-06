<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuditController extends AbstractController
{
    #[Route('/audit', name: 'audit')]
    public function list(): Response
    {
        return $this->render('audit/list.html.twig');
    }

    #[Route('/audit/{id}', name: 'audit_details')]
    public function details(int $id): Response
    {
        return $this->render('audit/details.html.twig', [
            'id' => $id,
        ]);
    }
}