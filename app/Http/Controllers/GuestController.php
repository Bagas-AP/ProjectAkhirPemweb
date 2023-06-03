<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use Illuminate\Http\Request;
use App\Models\News;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return NewsResource::collection(
        //     News::all()
        // );

        return NewsResource::collection(
            News::latest()->get()
        );
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
    public function show(string $category, string $id)
    {
        $news = News::where('category', $category)->findOrFail($id);

        return new NewsResource($news);
    }

    public function showCategory(string $category)
    {
        $news = News::where('category', $category)->get();

        return NewsResource::collection($news);
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
