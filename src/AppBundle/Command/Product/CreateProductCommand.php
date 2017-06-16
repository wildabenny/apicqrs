<?php


namespace AppBundle\Command\Product;


class CreateProductCommand
{
    private $name;
    private $price;
    private $category;


    public function __construct(string $name, float $price, string $category)
    {
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function price() : float
    {
        return $this->price;
    }

    public function category() : string
    {
        return $this->category;
    }
}