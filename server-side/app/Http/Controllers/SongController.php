<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;

class SongController extends Controller
{
  /** 
   * @brief Renders a JSON document that contains the information for the songs
   * specified in the $isrcs array.
   */
  public function index() 
  {
    $isrcs = [ 'US7VG1846811', 'US7QQ1846811', 'BRC310600002', 'BR1SP1200071',
               'BR1SP1200070', 'BR1SP1500002', 'BXKZM1900338', 'BXKZM1900345',
               'QZNJX2081700', 'QZNJX2078148'];
    $songs = [];
    foreach($isrcs as $isrc) {
      $song = Song::findByISRC($isrc);
      if(!empty($song)) {
        $songs[] = $song;
      }
    }

    return response()->json($songs);
  }
}
