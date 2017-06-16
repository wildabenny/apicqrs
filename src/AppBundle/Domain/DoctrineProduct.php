<?php


namespace AppBundle\Domain;


use AppBundle\Entity\Product;
use AppBundle\Exception\ProductNotFoundException;
use Doctrine\ORM\EntityManager;

final class DoctrineProduct
{

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(Product $product)
    {
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }

    public function getByName($name)
    {
        $product = $this->entityManager->getRepository(Product::class)->findOneBy(['name' => $name]);

        if ($product === null) {
            throw new ProductNotFoundException('Product not found');
        }

        return $product;
    }
}