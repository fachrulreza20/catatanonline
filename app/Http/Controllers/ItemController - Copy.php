<?php
         
namespace App\Http\Controllers;
          
use App\Item;
use App\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables as DataTablesDataTables;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

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
    public function index(Request $request)
    {
      
        
   
        if ($request->ajax()) {
            $data = Item::with('users');
            return Datatables::eloquent($data)
                    ->addIndexColumn()
                    
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editItem">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteItem">Delete</a>';
    
                            return $btn;
                    })
                    ->addColumn('CategoriesName', 
                    function (Item $item) {
                        return $item->categories->map(function($category)  {
                            return str_limit($category->title, 30, '...');
                        })->implode('<br>');
                    })
                    ->rawColumns(['action'])
                    
                    ->make(true);
        }
      
        return view('admin.itemManagement');


    }
     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        Item::updateOrCreate(['id' => $request->item_id],
                ['title' => $request->title, 'nilai' => $request->nilai,
                'categories_id' => $request->categories_id,  'owner_id' => $request->owner_id]  
        );        
   
        return response()->json(['success'=>'Item saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        return response()->json($item);
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::find($id)->delete();
     
        return response()->json(['success'=>'Item deleted successfully.']);
    }
}