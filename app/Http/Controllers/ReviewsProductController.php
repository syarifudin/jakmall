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
        $products = json_decode(file_get_contents(storage_path() . "/data/reviews.json"), true);
        $rating=0;
        foreach ($products as $key => $value) {
            $total=$key+1;
            $rating+=$value['rating'];
        }
        echo $rating/$total ;
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
