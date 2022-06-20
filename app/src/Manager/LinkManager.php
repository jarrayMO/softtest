<?php
namespace App\Manager;

use App\Entity\Link;
use App\Repository\LinkRepository;
use Doctrine\ORM\EntityManagerInterface;

class LinkManager {
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var LinkRepository
     */
    private $linkRepository;

    /**
     * @var CustomerManager
     */
    private $customerManager;

    /**
     * @var MaterialManager
     */
    private $materialManager;

    /**
     * @param EntityManagerInterface $em
     * @param LinkRepository $linkRepository
     * @param CustomerManager $customerManager
     * @param MaterialManager $materialManager
     */
    public function __construct(EntityManagerInterface $em,
                                LinkRepository $linkRepository,
                                CustomerManager $customerManager,
                                MaterialManager $materialManager
    )
    {
        $this->em = $em;
        $this->linkRepository = $linkRepository;
        $this->customerManager = $customerManager;
        $this->materialManager = $materialManager;
    }


    public function save(array $arguments)
    {
        $link = new Link();
        $customer = $this->customerManager->findCustomerById($arguments['client_id']);
        $materiel = $this->materialManager->findMaterialById($arguments['material_id']);
        $link->setCustomer($customer);
        $link->setMaterial($materiel);
        $this->em->persist($link);
        $this->em->flush();
        return $link;
    }

    public function getMaterialByClientId(string $customerId)
    {
        $links = $this->linkRepository->findBy(['customer' => $customerId]);
        $materials = [];
        foreach ($links as $link) {
            $materials[] = $link->getMaterial();
        }
        return $materials;
    }

    public function findCustomerByCountMaterial()
    {
        return $this->linkRepository->findByCountMaterial() ;
    }

    public function findTotalPriceCustomer()
    {
        return $this->linkRepository->findByTotalPriceCustomer();
    }
    public function findMaxCustomerPrice(){
       return $this->linkRepository->findMaxTotalPriceCustomer();
    }
}
