<?php

namespace App\Http\Controllers;

use Cache;
use Illuminate\Http\Request;

class ReviewsProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = json_decode(file_get_contents(storage_path() . "/data/products.json"), true);
        $reviews = json_decode(file_get_contents(storage_path() . "/data/reviews.json"), true);
        $cacheKeyPrefix = 'product_reviews_summary_';
        $reviews_for_product = array_filter($reviews, function ($review) use ($id) {
            return $review['product_id'] == $id;
        });
        $total_reviews = count($reviews_for_product);
        $average_rating = array_sum(array_column($reviews_for_product, 'rating')) / $total_reviews;
        $cacheKey = $cacheKeyPrefix . $id;
        if (!Cache::has($cacheKey)) {
            $productReviewsSummaryid=[];
            $count_ratings = array(
                '5' => 0,
                '4' => 0,
                '3' => 0,
                '2' => 0,
                '1' => 0,
            );
            foreach ($reviews_for_product as $review) {
                $count_ratings[$review['rating']]++;
            }
            $data_reviews= array(
            "total_reviews" => $total_reviews,
            "average_ratings"=> number_format((float)$average_rating, 1, '.', ''),
            "5_star" => $count_ratings['5'] ,
            "4_star" => $count_ratings['4'],
            "3_star" => $count_ratings['3'] ,
            "2_star" => $count_ratings['2'] ,
            "1_star" => $count_ratings['1'] ,
        );
        $productReviewsSummaryid['product '.$id]=$data_reviews;
            Cache::put($cacheKey, $productReviewsSummaryid, now()->addHours(24));
        } else {
            // Retrieve the cached results
            $productReviewsSummaryid = Cache::get($cacheKey);
        }
        return ($productReviewsSummaryid);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
