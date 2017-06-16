<?php

namespace AppBundle\Controller;

use AppBundle\Command\Product\CreateProductCommand;
use AppBundle\Domain\DoctrineProductQuery;
use AppBundle\Exception\ProductNotFoundException;
use AppBundle\Query\ProductQuery;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Query\ProductView;

class ProductsController extends FOSRestController
{

    /**
     * @param Request $request
     * @Rest\Post("/product/")
     * @return Response
     */
    public function postProductAction(Request $request)
    {

        $command = new CreateProductCommand($request->get('name'), $request->get('price'), $request->get('category'));

        $commandBus = $this->get('tactician.commandbus');

        try {

            $commandBus->handle($command);

            return new Response(json_encode("Product added", 201));

        } catch (ProductNotFoundException $exception) {

            return new Response(json_encode($exception->getMessage(), 401));
        }

    }

    /**
     * @param $productId
     * @return Response
     * @Rest\Get("/products/{productId}")
     */
    public function getProductAction($productId)
    {
        $productQuery = $this->get('product.query');
        $product = $productQuery->getById($productId);

        if (!$product) {
            $view = $this->view("brak produktu o podanym id", 404);

            return $this->handleView($view);
        }

        $productView = new ProductView($product->name(), $product->price(), $product->category());

        $view = $this->view($productView, 200);

        return $this->handleView($view);
    }
// to nie działa
    public function cgetAction()
    {
        $productQuery = $this->get('product.query');
        $products = $productQuery->getAll();

        $view = $this->view($products, 200);

        return $this->handleView($view);
    }
}
