<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpotifySong;

class SongController extends Controller
{
  /** 
   * TODO document
   */
  public function index() 
  {
    $isrc = 'US7VG1846811';
    $songDetails = SpotifySong::getSongDetails($isrc);
    return response()->json($songDetails);
  }
}
