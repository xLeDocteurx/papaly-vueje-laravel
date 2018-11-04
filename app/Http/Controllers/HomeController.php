<?php

namespace App\Http\Controllers;

use App\User;
use App\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = Board::orderBy('id', 'DESC')->get();
        return view('welcome', compact('boards'));
    }
    
    public function board()
    {

        return view('board');
    }
    
    public function myboards()
    {
        $userId = Auth::user()->id;
        $boards = Board::where('user_id', $userId)->orderBy('id', 'DESC')->get();
        return view('myboards', compact('boards'));
    }

    public function user(Request $request)
    {
        $user_id = $request->data['user_id'];
        $user = User::find($user_id);

        return response()->json([
            'message' => 'Successfully created a new board',
            'user' => $user
        ], 201);
    }

}
