<?php

namespace App\Http\Controllers;

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
        $sum = 0;
        $rt_5 = 0;
        $rt_4 = 0;
        $rt_3 = 0;
        $rt_2 = 0;
        $rt_1 = 0;
        $totalCount=0;
        foreach ($products as $key => $product) {
            if ($product['id']==$id) {
                foreach ($reviews as $key => $review) {
                    if ($review['product_id']==$id) {
                        $totalCount = $totalCount+1;
                        $sum += $review['rating'];
                        if ($review['rating']==5) {
                            $rt_5 =$rt_5+1;
                        } elseif ($review['rating']==4) {
                            $rt_4 =$rt_4 +1;
                        } elseif ($review['rating']==3) {
                            $rt_3 =$rt_3 +1;
                        } elseif ($review['rating']==2) {
                            $rt_2 =$rt_2 +1;
                        } else {
                            $rt_1 =$rt_1 +1;
                        }
                    }
                }
            }
        }
        $averageRating = $sum / $totalCount;
        $data_reviews= array(
            "total_reviews" =>  $totalCount,
            "average_ratings"=> number_format((float)$averageRating, 1, '.', ''),
            "5_star" => $rt_5 ,
            "4_star" => $rt_4 ,
            "3_star" => $rt_3 ,
            "2_star" => $rt_2 ,
            "1_star" => $rt_1 ,
        );
        return ($data_reviews);
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
