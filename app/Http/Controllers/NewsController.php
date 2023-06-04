<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Http\Resources\NewsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return response()->json([
        //     'status' => "Success",
        //     'message' => "Index method",
        //     'data' => []
        // ], 200);

        // for getting all news based on category
        // return NewsResource::collection(
        //     News::where('category', 'olahraga')->get()
        // );

        // for getting all news
        return NewsResource::collection(
            News::all()
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
    public function store(StoreNewsRequest $request)
    {
        $validatedData = $request->validated();

        $imagePath = null;
        if ($request->file('image')->isValid()) {
            $image = $request->file('image');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('news', $imageName, 'public');
        }

        $news = News::create([
            'title' => $validatedData['title'],
            'category' => $validatedData['category'],
            'description' => $validatedData['description'],
            'image' => $imagePath
        ]);

        return new NewsResource($news);
    }



    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return new NewsResource($news);
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
    public function update(Request $request, News $news)
    {
        $news->update($request->all());

        return new NewsResource($news);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();

        return response()->json([
            'status' => "Success",
            'message' => "News deleted successfully",
            'data' => null
        ], 204);
    }
}
