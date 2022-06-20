<?php

namespace App\Controller;

use App\Manager\LinkManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends AbstractController
{
    /**
     * @Route("/get/material", name="app_ajax_get")
     */
    public function index(Request $request, LinkManager $linkManager): Response
    {
        $data = $request->query->all();
        $materials = $linkManager->getMaterialByClientId($data['clientId']);
        return $this->render('ajax/material_ajax.html.twig', [
            'materials' => $materials,
        ]);
    }
}