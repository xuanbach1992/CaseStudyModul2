<?php


namespace App\Repository\eloquent;


use App\Product;
use App\Repository\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAll()
    {
        return Product::paginate(10);
    }

    public function update($obj)
    {
        $obj->save();
    }

    public function destroy($obj)
    {
        $obj->delete();
    }

    public function find($id)
    {
        return $this->product->findOrFail($id);
    }
}
