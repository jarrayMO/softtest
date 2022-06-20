<?php

namespace App\Controller;

use App\Manager\CustomerManager;
use App\Manager\LinkManager;
use App\Manager\MaterialManager;
use App\Service\CalculPriceService;
use ContainerDQ5m3AA\getLinkManagerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/coustmer/rentable", name="app_index")
     */
    public function index(LinkManager $linkManger): Response
    {
        $customersMaretirls = $linkManger->findCustomerByCountMaterial();
        return $this->render('index/index.html.twig', [
            'customers' => $customersMaretirls,
            'allCustomer'=> false
        ]);
    }

    /**
     * @Route("/post", name="app_poste")
     */
    public function post(CustomerManager $customerManager, MaterialManager $materialManager)
    {
        $customers = $customerManager->findAllCustomer();
        $materials = $materialManager->findAllMaterial();
        return $this->render('save/save.html.twig', [
            'customers' => $customers,
            'materials' => $materials
        ]);

    }

    /**
     * @Route("/save", name="app_save")
     */
    public function save(Request $request, LinkManager $linkManager)
    {

        $materials = $request->request->get('material_id');
        $data['client_id'] = $request->request->get('client_id');
        foreach ( $materials as $material){
            $data['material_id'] =$material;
            $linkManager->save($data);
        }
        return $this->redirectToRoute('app_index');

    }



    /**
     *  @Route()
     * cette fonction juste pour montre l'utilisation de service
     */
    public function calculation(CalculPriceService $calculPriceServicePrice)
    {
        $calculPriceServicePrice->calculPrices();

    }
}
