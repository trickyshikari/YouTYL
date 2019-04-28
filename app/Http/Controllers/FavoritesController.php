<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class FavoritesController extends Controller
{
    //
    function index(){
      return view('favorites');
    }

    function userFav(){

      $user = strtolower(Auth::user()->name);
      $rezults = DB::table($user)->get()->reverse();
      return view('favorites',['rezults' => $rezults]);

    }

    function isFav(Request $request){

      $user = strtolower(Auth::user()->name);
      $video = $request->input('video');
      $rezults = DB::table($user)->where('videoId',$video)->first();

      if(empty($rezults)){
        $rezults = DB::table('queries')->where('videoId',$video)->first();
          DB::table($user)->insert([
            'title' => $rezults->title,
            'img' => $rezults->img,
            'date' => $rezults->date,
            'videoId' => $rezults->videoId,
            'description' => $rezults->description,
          ]);
      } else {
        DB::table($user)->where('videoId',$video)->delete();
      }

      $rezults = DB::table($user)->get()->reverse();

      return view('favorites',['rezults' => $rezults]);
    }

    function viewFav(Request $request){

      $user = strtolower(Auth::user()->name);
      $video = request()->route()->parameter('id');
      $rezults = DB::table($user)->where('videoId',$video)->first();

      return view('watch',['rezults' => $rezults]);
    }



}
