<?php


namespace AppBundle\Domain;


use AppBundle\Query\ProductQuery;
use AppBundle\Query\ProductView;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// to powinno być w katalogu Query

class DoctrineProductQuery implements ProductQuery
{
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function count(): int
    {
        $repo = $this->em->getRepository('AppBundle:Product');
        $products = $repo->findAll();

        return count($products);
    }

    public function getById(string $productId): ProductView
    {
        $repo = $this->em->getRepository('AppBundle:Product');
        $product = $repo->findOneBy(['id' => $productId]);

        if (!$product) {
            throw new NotFoundHttpException("Product not found");
        }

        return new ProductView($product->getName(), $product->getPrice(), $product->getCategory());
    }

    public function getAll(): array
    {
        $repo = $this->em->getRepository('AppBundle:Product');
        $products = $repo->findAll();

        return $products;
    }


}