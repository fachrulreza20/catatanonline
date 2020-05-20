<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\View;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        

        //select title, count(title) from items group by title

        $collectionDsa = Item::groupBy('title')
        ->selectRaw('title, count(title) as counttitle, sum(nilai) as sumNilai')
        ->where('categories_id', 1)
        ->orderBy('counttitle', 'DESC')
        ->take(10)
        ->get();
        
        $collectionPhl = Item::groupBy('title')
        ->selectRaw('title, count(title) as counttitle, sum(nilai) as sumNilai')
        ->where('categories_id', 2)
        ->orderBy('counttitle', 'DESC')
        ->take(10)
        ->get();


        //select owner_id, sum(nilai) from items group by owner_id



        $topUserDsa = Item::groupBy('owner_id')
        ->selectRaw('owner_id, sum(nilai) as totalnilai')
        ->where('categories_id', 1)
        ->orderBy('totalnilai', 'DESC')
        ->take(10)
        ->get();

        

        $topUserPhl = Item::groupBy('owner_id')
        ->selectRaw('owner_id, sum(nilai) as totalnilai')
        ->where('categories_id', 2)
        ->orderBy('totalnilai', 'DESC')
        ->take(10)
        ->get();






        return view('front/fronthome', compact('collectionDsa','collectionPhl','topUserDsa','topUserPhl'));

        //return view('front/fronthome');



    }


    public function adminHome()
    {
        return view('adminHome');
    }

    
}
