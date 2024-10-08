<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use App\Models\User;
use Auth;

class ReviewController extends Controller
{
    public function __construct() {
        // Staff Permission Check
        $this->middleware(['permission:view_product_reviews'])->only('index');
        $this->middleware(['permission:publish_product_review'])->only('updatePublished');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $reviews = Review::query();
        if($request->rating){
            $reviews->orderBy('rating', explode(",",$request->rating)[1]);
        }
        $reviews = $reviews->orderBy('created_at', 'desc')->paginate(15);
        return view('backend.product.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productIds = is_array($request->product_id) ? $request->product_id : [$request->product_id]; // Normalize to array
        $hasError = false; // Flag to track if any error occurs
        
        // Check for duplicates before adding any reviews
        foreach ($productIds as $productId) {
            if ($request->has('user_id')) {
                // Check if user has already reviewed this product
                $existingReview = Review::where('product_id', $productId)
                    ->where('user_id', $request->user_id)
                    ->first();
    
                if ($existingReview) {
                    // User has already reviewed this product, skip adding the review
                    $user = User::find($request->user_id);
                    $product = Product::find($productId);
    
                    flash(translate("$user->name already has a review for this product $product->name."))->error();
                    $hasError = true; // Set the error flag
                    break; // End loop
                }
            }
        }
        
        // If no error was found, proceed with adding reviews
        if (!$hasError) {
            foreach ($productIds as $productId) {
                $review = new Review;
                // $review->product_id = $request->product_id;
                $review->product_id = $productId;
                // $review->user_id = Auth::user()->id;
                // Check if user_id is provided in the request
                if ($request->has('user_id')) {
                    $review->user_id = $request->user_id;
                    $review->is_admin_review = $request->is_admin_review;
                } else {
                    $review->user_id = Auth::user()->id;
                }
                $review->rating = $request->rating;
                $review->comment = $request->comment;
                $review->viewed = '0';
                $review->save();
                // $product = Product::findOrFail($request->product_id);
                $product = Product::findOrFail($productId);
                if(Review::where('product_id', $product->id)->where('status', 1)->count() > 0){
                    $product->rating = Review::where('product_id', $product->id)->where('status', 1)->sum('rating')/Review::where('product_id', $product->id)->where('status', 1)->count();
                }
                else {
                    $product->rating = 0;
                }
                $product->save();
        
                if($product->added_by == 'seller'){
                    $seller = $product->user->shop;
                    $seller->rating = (($seller->rating*$seller->num_of_reviews)+$review->rating)/($seller->num_of_reviews + 1);
                    $seller->num_of_reviews += 1;
                    $seller->save();
                }
            }
    
            flash(translate('Review has been submitted successfully'))->success();
        }
         
        return back();
    }
    
    /*public function store(Request $request)
    {
        $review = new Review;
        $review->product_id = $request->product_id;
        $review->user_id = Auth::user()->id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->viewed = '0';
        $review->save();
        $product = Product::findOrFail($request->product_id);
        if(Review::where('product_id', $product->id)->where('status', 1)->count() > 0){
            $product->rating = Review::where('product_id', $product->id)->where('status', 1)->sum('rating')/Review::where('product_id', $product->id)->where('status', 1)->count();
        }
        else {
            $product->rating = 0;
        }
        $product->save();

        if($product->added_by == 'seller'){
            $seller = $product->user->shop;
            $seller->rating = (($seller->rating*$seller->num_of_reviews)+$review->rating)/($seller->num_of_reviews + 1);
            $seller->num_of_reviews += 1;
            $seller->save();
        }

        flash(translate('Review has been submitted successfully'))->success();
        return back();
    }*/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updatePublished(Request $request)
    {
        $review = Review::findOrFail($request->id);
        $review->status = $request->status;
        $review->save();

        $product = Product::findOrFail($review->product->id);
        if(Review::where('product_id', $product->id)->where('status', 1)->count() > 0){
            $product->rating = Review::where('product_id', $product->id)->where('status', 1)->sum('rating')/Review::where('product_id', $product->id)->where('status', 1)->count();
        }
        else {
            $product->rating = 0;
        }
        $product->save();

        if($product->added_by == 'seller'){
            $seller = $product->user->shop;
            if ($review->status) {
                $seller->rating = (($seller->rating*$seller->num_of_reviews)+$review->rating)/($seller->num_of_reviews + 1);
                $seller->num_of_reviews += 1;
            }
            else {
                $seller->rating = (($seller->rating*$seller->num_of_reviews)-$review->rating)/max(1, $seller->num_of_reviews - 1);
                $seller->num_of_reviews -= 1;
            }

            $seller->save();
        }

        return 1;
    }

    public function product_review_modal(Request $request){
        $product = Product::where('id',$request->product_id)->first();
        $review = Review::where('user_id',Auth::user()->id)->where('product_id',$product->id)->first();
        return view('frontend.user.product_review_modal', compact('product','review'));
    }
    
    public function product_review_admin_modal(Request $request){
        $products = Product::get();
        $users = User::get();
        $product_id = $request->input('product_id');
        $review = null;
        if ($product_id) {
            $review = Review::where('user_id', Auth::user()->id)
                            ->where('product_id', $product_id)
                            ->first();
        }
        return view('backend.product.product_review_admin_modal', compact('products', 'review','users'));
    }
}
