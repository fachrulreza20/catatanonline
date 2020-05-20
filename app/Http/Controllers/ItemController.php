<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::with('categories', 'users')->get();
        $categories = Category::all();

        return view('admin.items', ['items' => $items], ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'title'       => 'required|max:255',
          'nilai' => 'required',
          'categories_id' => 'required',
          'owner_id' => 'required',
        ]);

        $item = Item::updateOrCreate(['id' => $request->id], [
                  'title' => $request->title,
                  'nilai' => $request->nilai,
                  'categories_id' => $request->categories_id,
                  'owner_id' => $request->owner_id
                ]);

        return response()->json(['code'=>200, 'message'=>'Item Created successfully','data' => $item], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);

        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Item::find($id)->delete();

      return response()->json(['success'=>'Item Deleted successfully']);
    }
}