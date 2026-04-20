<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = Track::orderBy('title')->get();
        return view('tracks.index', compact('tracks'));
    }
}