<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Http\Resources\Review\ReviewResource;
use App\Model\Product;
use App\Model\Review;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Product $product)
    {
        //reviewresource şeklinde dönüştürülen dataları aşağıdaki şekilde gösteriyoruz.
       return ReviewResource::collection($product->reviews);
    }

    public function create()
    {
        //
    }

    public function store(ReviewRequest $request, Product $product)
    {
        $review = new Review($request->all());
        $product->reviews()->save($review);

        return response([
           'data' => new ReviewResource($review)
        ],Response::HTTP_CREATED);
    }

    public function show(Review $review)
    {
        //
    }

    public function edit(Review $review)
    {

    }

    public function update(Request $request,Product $product, Review $review)
    {
        $review ->update($request->all());
        return response([
            'data' => new ReviewResource($review)
        ],Response::HTTP_CREATED);
    }

    public function destroy( Product $product,Review $review)
    {
        $review->delete();
        return response(null,Response::HTTP_NO_CONTENT);

    }
}
