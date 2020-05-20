<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\View;

class UserDataController extends Controller
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

    public function index(){
        $userid = Auth::user()->id;
        $items = Item::with('categories', 'users')->where('owner_id', $userid)->orderBy('nilai', 'DESC')->get();
        $itemsDosa = Item::all()->where('categories_id',1)->where('owner_id',Auth::user()->id)->count();
        $itemsPahala = Item::all()->where('categories_id',2)->where('owner_id',Auth::user()->id)->count();

        return View::make('front/user/userhome')->with(compact('items'))->with(compact('itemsDosa'))->with(compact('itemsPahala'));
    }


    public function store(Request $request) { 

        $validator = Validator::make(request()->all(), [
            'title'  => 'required|max:30',
            'categories_id' => 'required|max:1',
        ]);         

        $x = "reza";
        $isExist = Item::all()->where('title',$request->title)->where('owner_id',Auth::user()->id)->count();
        
        //dd(json_encode($isExist));
        
        if($isExist == 0){

                $userid = Auth::user()->id;
                $items = Item::with('categories', 'users')->where('categories_id', $request->categories_id)->where('owner_id', $userid)->get();
                
                if($items->count() < 10){

                    $data = new Item();
                    $data->title = $request->title;
                    $data->nilai = 0;
                    $data->categories_id = $request->categories_id;
                    $data->owner_id = Auth::user()->id;
                    $data->save();

                    if($data){

                        $data = array(
                            'status' => 'success',
                            'message' => 'Berhasil ditambahkan',
                            'data_lastid' => $data->id,
                        );
        
                        return $data;
                    }
                }
                
                else{
                    $data = array(
                        'status' => 'error',
                        'message' => 'limit max 10',
                    );
        
                    return $data;
                }

        }
        else{
            $data = array(
                'status' => 'error',
                'message' => 'item sudah ada',
            );

            return $data;
        }

        

  
    }

      public function update(Request $request, $item)

      {
        $updateData = $request->validate([
            'nilai' => 'required|max:255',
        ]);
 
        Item::whereId($item)->update($updateData);
  
          return response()->json(['success'=>'Form is successfully submitted!']);
        
      }
      

}
