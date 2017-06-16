<?php


namespace AppBundle\Command\Product;


use AppBundle\Domain\DoctrineProduct;
use AppBundle\Entity\Product;
use AppBundle\Exception\ProductNotFoundException;

final class CreateProductHandler
{
    
    private $products;

    public function __construct(DoctrineProduct $products)
    {
        $this->products = $products;
    }

    public function handle(CreateProductCommand $command)
    {
        $product = new Product($command->name(), $command->price(), $command->category());

        if (!$product) {
            throw new ProductNotFoundException();
        }

        $this->products->add($product);
    }

}