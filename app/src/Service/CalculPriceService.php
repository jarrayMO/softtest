<?php

namespace App\Service;


use App\Manager\CustomerManager;
use App\Manager\LinkManager;
use App\Manager\MaterialManager;

class CalculPriceService
{
    /**
     * @var CustomerManager
     */
    private $customerManager;

    /**
     * @var LinkManager
     */
    private $linkManager;

    /**
     * @var MaterialManager
     */
    private $materialManager;

    /**
     * @param CustomerManager $customerManager
     * @param LinkManager $linkManager
     * @param MaterialManager $materialManager
     */
    public function __construct(CustomerManager $customerManager, LinkManager $linkManager, MaterialManager $materialManager)
    {
        $this->customerManager = $customerManager;
        $this->linkManager = $linkManager;
        $this->materialManager = $materialManager;
    }

    public function calculPrices()
    {
        $result = [];
        $totalPrice = 0;
        $customers = $this->customerManager->findAllCustomer();
        foreach ($customers as $k => $customer) {
            $result[$k]['customer'] = $customer->getName();
            $materials = $this->linkManager->getMaterialByClientId($customer->getId());
            foreach ($materials as $material){
                $totalPrice = $totalPrice + $material->getPrice();
            }
            $result[$k]['price'] = $totalPrice;
        }
        return $result;
    }



}