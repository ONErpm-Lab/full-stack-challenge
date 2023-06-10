<?php

use App\Actions\ListTracks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (Request $request) {
    $code = $request->code ?? null;
    if (!empty($code)) {
        parse_str($code, $codeInfo);
        return response()->json(['access_token' => $codeInfo['access_token']]);
    }
    return redirect('/tracks');
});
Route::get('tracks', ListTracks::class);