<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormAddRequest;
use App\Product;
use App\Service\ProductServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
        $this->middleware('auth');
    }

    public function showlist()
    {
        $products = $this->productService->show();

        return view("product.list", compact("products"));
    }

    public function create()
    {
        if (Gate::allows("admin")) {
            return view("product.create");
        }
        abort(403, "ban ko co quyen han nay");
    }

    public
    function createSuccess(FormAddRequest $request)
    {
        if (Gate::allows("admin")) {
            $this->productService->success($request);
            return redirect()->route("product.list");
        }
        abort(403, "ban ko co quyen han nay");

    }

    public
    function edit($id)
    {
        if (Gate::allows("admin")) {
            $product = $this->productService->findById($id);
            return view("product.edit", compact("product"));
        }
        abort(403, "ban ko co quyen han nay");
    }

    public
    function update(Request $request, $id)
    {
        if (Gate::allows("admin")) {
            $this->productService->updateSuccess($request, $id);
            return redirect()->route("product.list");
        }
        abort(403, "ban ko co quyen han nay");
    }

    public
    function destroy($id)
    {
        if (Gate::allows("admin")) {
            $this->productService->delete($id);
            return redirect()->route("product.list");
        }
        abort(403, "ban ko co quyen han nay");
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $products = Product::where('name', "LIKE", "%$search%")->paginate(15);
        return view("product.list", compact("products"));
    }
}
