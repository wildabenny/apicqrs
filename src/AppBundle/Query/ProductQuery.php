<?php


namespace AppBundle\Query;


interface ProductQuery
{
    public function count() : int;

    public function getById(string $productId) : ProductView;

    public function getAll() : array;
}