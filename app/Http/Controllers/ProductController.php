<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Model\Product;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function __construct()
    {
        //apiden gelen kullanıcı index ve show dışındakileri de yapabilir (except=dışında)
        //Gİriş yapılmadığı sürece görüntüleme yapılamıyor.
        $this->middleware('auth:api')->except('index','show');
    }


    public function index()
    {
        //Tüm product datasını json şeklinde çekerek gösterir
        //return Product::all();

        // Tüm product datasını dönüştürülmüş productcollectiondan çekiyoruz.
        //return ProductResource::collection(Product::all());

        return  ProductCollection::collection(Product::paginate(20));

    }

    public function create()
    {
        //
    }

    public function store(ProductRequest $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->detail = $request->description;
        $product->stock = $request->stock;
        $product->discount = $request->discount;
        $product->price = $request->price;

        $product->save();

        return response([
            'data' => new ProductResource($product)
        ],Response::HTTP_CREATED);

    }

    public function show(Product $product)
    {
        //ProductResource ile dönüştürülen datalar gösterildi.
        return new ProductResource($product);
    }


    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        $product['detail'] = $request->description;
        unset($request['description']);
        $product->update($request->all());
        return response([
            'data' => new ProductResource($product)
        ],Response::HTTP_CREATED);

    }

    public function destroy(Product $product)
    {
         $product->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}
