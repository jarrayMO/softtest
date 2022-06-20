<?php
namespace App\Manager;

use App\Repository\MaterialRepository;
use Doctrine\ORM\EntityManagerInterface;

class MaterialManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var MaterialRepository
     */
    private $materialRepository;

    /**
     * @param EntityManagerInterface $em
     * @param MaterialRepository $materialRepository
     */
    public function __construct(EntityManagerInterface $em, MaterialRepository $materialRepository)
    {
        $this->em = $em;
        $this->materialRepository = $materialRepository;
    }

    public function findAllMaterial()
    {
        return $this->materialRepository->findAll();
    }

    public function findMaterialById(string $id)
    {
      return $this->materialRepository->findOneBy(['id' => $id]);
    }


}
