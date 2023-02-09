<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Track extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tracks';

    protected $fillable = ['isrc', 'thumb_url', 'release_date', 'title', 'length', 'spotify_url', 'br_avaiable', 'preview_url', 'spotify_id'];

    public function set($data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }
}
