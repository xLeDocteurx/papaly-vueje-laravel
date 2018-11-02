<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = Board::where('user_id', Auth::user()->id)->get();

        // if (sizeof($boards) < 1) {

        //     $board = new Board();
        //     $board->name = 'My first board !';
        //     $board->public = 0;
        //     $board->user_id = Auth::user()->id;
        //     $board->category_id = 1; // à enlever
        //     $board->save();

        //     $boards = Board::where('user_id', Auth::user()->id)->get();

        // }

        return $boards;
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
        $board = new Board();
        $board->name = $request->data['name'];
        $board->public = 0;
        $board->user_id = Auth::user()->id;
        $board->save();

        return response()->json([
            'message' => 'Successfully created a new board',
            'new_board' => $board
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $name = $request->data['name'];
        $id = $request->data['id'];
        $board = Board::find($id);
        $board->name = $name;
        $board->save();
        return response()->json([
            'message' => 'Successfully updated board n°' . $id . '. New name : ' . $name
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Board::destroy($id);
        return response()->json([
            'message' => ('Successfully deleted board :' . $id)
        ], 201);
    }
}
