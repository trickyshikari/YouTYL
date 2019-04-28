<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_YouTube;

class SearchController extends Controller
{
    //
    function index()
    {
      return view('aboute', ['users' => User::paginate(10)]);
    }

    function query(Request $request)
    {

      $qwe = substr($_SERVER['DOCUMENT_ROOT'],0,-6);
      require_once $qwe.'/vendor/autoload.php';

      $query = $request->input('query');

      $rezults = DB::table('queries')->where('query', $query)->get();

      if (count($rezults) == 0) {

          $client = new Google_Client();
          $client->setApplicationName('youtubetyl');
          $client->setDeveloperKey('AIzaSyAcWrBQeAAvBdS7refWGgawMf2dxcC5zTo');

          // Define service object for making API requests.
          $service = new Google_Service_YouTube($client);

          $queryParams = [
              'maxResults' => 10,
              'q' => $query,
              'type' => 'video',
          ];

          $response = $service->search->listSearch('snippet', $queryParams);

          foreach ($response['items'] as $item) {
            DB::table('queries')->insert([
              'query' => $query,
              'title' => (string)$item['snippet']['title'],
              'img' => (string)$item['snippet']['thumbnails']['high']['url'],
              'date' => (string)$item['snippet']['publishedAt'],
              'videoId' => (string)$item['id']['videoId'],
              'description' => (string)$item['snippet']['description'],
             ]);
          }
          $rezults = DB::table('queries')->where('query', $query)->get();
      }
      return view('search', ['rezults' => $rezults]);


    }

    function viewSearch(Request $request){

      $video = request()->route()->parameter('id');
      $rezults = DB::table('queries')->where('videoId',$video)->first();

      return view('watch',['rezults' => $rezults]);
    }

}
