<?php

namespace App\Http\Controllers;

use App\Category;
use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $board_id = $request->data;
        $categories = Category::where('board_id', $board_id)->get();
        // $links = [];
        // foreach ($categories as $category) {
        //     array_push($links, )
        // }
        return response()->json([
            'message' => 'Successfully returned the board categories from board : ' . $board_id,
            'categories' => $categories
        ], 201);
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
        $board_id = $request->data['board_id'];
        $category = new Category();
        $category->title = $request->data['title'];
        $category->board_id = $board_id;
        $category->save();
        
        $categories = Category::where('board_id', $board_id)->get();
        // $categories = Category::all();

        return response()->json([
            'message' => 'Successfully created a new category$category',
            'new_category' => $category,
            'categories' => $categories
        ], 201);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $links = Link::where('category_id', $id)->delete();
        Category::destroy($id);

        return response()->json([
            'message' => ('Successfully deleted Category :' . $id)
        ], 201);
    }
}
