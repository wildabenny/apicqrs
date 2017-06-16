<?php


namespace AppBundle\Query;


final class ProductView
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    /**
     * @var string
     */
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

    public function category() : string
    {
        return $this->category;
    }

    public function price() : float
    {
        return $this->price;
    }

}