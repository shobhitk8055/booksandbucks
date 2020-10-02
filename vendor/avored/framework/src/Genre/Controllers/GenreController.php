<?php

namespace AvoRed\Framework\Genre\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;

class GenreController
{
   public function index():View{
       $genres = DB::table('genres')->paginate(10);
       return view('avored::genre.index',[
           'genres'=>$genres
       ]);
   }

   public function create():View{
       return view('avored::genre.create');
   }

   public function store(Request $request){
       DB::table('genres')->insert([
           'name'=>$request->name
       ]);
       return view('avored::genre.create');
   }
}
