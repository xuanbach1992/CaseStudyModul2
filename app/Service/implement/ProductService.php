<?php


namespace App\Service\implement;


use App\Product;
use App\Repository\ProductRepositoryInterface;
use App\Service\ProductServiceInterface;
use Illuminate\Support\Facades\File;

class ProductService implements ProductServiceInterface
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    function show()
    {
        return $this->productRepository->getAll();
    }


    function success($request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $image = $request->file('image')->store("upload", "public");
        $product->image = $image;

        $this->productRepository->update($product);
    }

    function findById($id)
    {
        return $this->productRepository->find($id);
    }

    function updateSuccess($request, $id)
    {
        $product = $this->productRepository->find($id);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        if ($request->image){
//            if (file_exists(storage_path("/app/public/$product->image"))) {
                File::delete(storage_path("/app/public/$product->image"));
                $image = $request->file('image')->store("upload", "public");
                $product->image = $image;
            }
        $this->productRepository->update($product);
    }

    public function delete($id)
    {
        $product = $this->productRepository->find($id);
        File::delete(storage_path("/app/public/$product->image"));
        $this->productRepository->destroy($product);

    }

}
