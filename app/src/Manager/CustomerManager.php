<?php
namespace App\Manager;

use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;

class CustomerManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * @param EntityManagerInterface $em
     * @param CustomerRepository $customerRepository
     */
    public function __construct(EntityManagerInterface $em, CustomerRepository $customerRepository)
    {
        $this->em = $em;
        $this->customerRepository = $customerRepository;
    }

    public function findAllCustomer()
    {
        return $this->customerRepository->findAll();
    }

    public function findCustomerById(string $id)
    {
        return $this->customerRepository->findOneBy(['id' => $id]);
    }

}