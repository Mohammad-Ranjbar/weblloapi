<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function show($boradId)
    {
        $board = Board::query()->findOrFail($boradId);

        return $board;
    }

    public function update(Request $request, $boardId)
    {
        $board = Board::query()->find($boardId);
        $board->update($request->all());

        return response()->json(['message' => 'success', 'board' => $board], 200);
    }

    public function destroy($id)
    {
        if (Board::destroy($id)) {
            return response()->json(['status' => 'success', 'message' => 'board is deleted !']);
        }

        return response()->json(['status' => 'error', 'message' => 'something was wrong !']);
    }

    public function index()
    {
        return Board::all();
    }

    public function store(Request $request)
    {
        Board::create([
            'name'    => $request->name,
            'user_id' => 1,
        ]);

        return response()->json(['message' => 'success'], 200);
    }
}
