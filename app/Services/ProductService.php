<?php
/**
 * Created by PhpStorm.
 * User: Mestre
 * Date: 31/07/2019
 * Time: 18:26
 */

namespace App\Services;


use App\Product;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductService
{
    public function findAll(): Collection {
        return Product::all();
    }

    public function findOne(int $id): ?Product {
        $product = Product::find($id);

        if (!$product) {
            throw new NotFoundHttpException("Product not found!");
        }

        return $product;
    }

    public function save(Product $product): Product {
        $product->save();
        return $product;
    }

    public function update(Product $product, int $id): void {
        $object = $this->findOne($id);

        $object->name = $product->name;
        $object->industry = $product->industry;
        $object->price = $product->price;
        $object->quantity = $product->quantity;

        $this->save($object);
    }

    public function delete(int $id): void {
        $product = $this->findOne($id);
        $product->delete();
    }
}