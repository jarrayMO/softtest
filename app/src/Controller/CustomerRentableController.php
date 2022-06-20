<?php

namespace App\Controller;

use App\Manager\LinkManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerRentableController extends AbstractController
{
    /**
     * @Route("/", name="app_coustmer_rentable")
     */
    public function index(LinkManager $linkManger): Response
    {
        $customersMaterials = $linkManger->findTotalPriceCustomer();
        $customersMaxTotal = $linkManger->findMaxCustomerPrice();
        return $this->render('customer_rentable/index.html.twig', [
            'customers' => $customersMaterials,
            'customersMaxTotal'=>$customersMaxTotal,
            'allCustomer'=> true
        ]);
    }
}
