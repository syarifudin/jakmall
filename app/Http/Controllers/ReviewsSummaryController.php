<?php

namespace App\Http\Controllers;

use Cache;
use Illuminate\Http\Request;

class ReviewsSummaryController extends Controller
{
    public function index()
    {
        $reviews = json_decode(file_get_contents(storage_path() . "/data/reviews.json"), true);
        $total_reviews = count($reviews);
        $average_rating = array_sum(array_column($reviews, 'rating')) / $total_reviews;
        $data_reviews=null;
        $cacheKey = 'product_reviews_summary';
        if (Cache::has($cacheKey)) {
            $productReviewsSummary = [];

            $count_ratings = array(
            '5' => 0,
            '4' => 0,
            '3' => 0,
            '2' => 0,
            '1' => 0,
        );
            foreach ($reviews as $review) {
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
            $productReviewsSummary['review:summary'] =$data_reviews;

            Cache::put($cacheKey, $productReviewsSummary,  now()->addminutes(1));
        } else {
            // Retrieve the cached results
            $productReviewsSummary = Cache::get($cacheKey);
        }
        return ($productReviewsSummary);
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
        //
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
