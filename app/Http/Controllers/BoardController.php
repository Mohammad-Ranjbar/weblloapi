<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($boradId)
    {
        $board = Board::query()->findOrFail($boradId);
        if (Auth::user()->id !== $board->user_id) {
            response()->json(['status' => 'error', 'message' => 'unauthorize'], 401);
        }

        return $board;
    }

    public function update(Request $request, $boardId)
    {
        $board = Board::query()->find($boardId);
        if (Auth::user()->id !== $board->user_id) {
            response()->json(['status' => 'error', 'message' => 'unauthorize'], 401);
        }
        $board->update($request->all());

        return response()->json(['message' => 'success', 'board' => $board], 200);
    }

    public function destroy($id)
    {
        $board = Board::find($id);
        if (Auth::user()->id !== $board->user_id) {
            response()->json(['status' => 'error', 'message' => 'unauthorize'], 401);
        }
        if (Board::destroy($id)) {
            return response()->json(['status' => 'success', 'message' => 'board is deleted !']);
        }

        return response()->json(['status' => 'error', 'message' => 'something was wrong !']);
    }

    public function index()
    {
        return Auth::user()->boards();
    }

    public function store(Request $request)
    {
        Board::create([
            'name'    => $request->name,
            'user_id' => Auth::id(),
        ]);

        return response()->json(['message' => 'success'], 200);
    }
}
