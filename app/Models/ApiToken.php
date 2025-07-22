<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $domain
 * @property string $token
 * @property ?Carbon $last_used_at
 * @property ?Carbon $expires_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method static Builder whereToken(string $token)
 */
class ApiToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain',
        'token',
        'last_used_at',
        'expires_at'
    ];

    protected function casts(): array
    {
        return [
            'last_used_at' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }

    protected function token(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => hash('sha256', $value),
        );
    }

    #[Scope]
    protected function whereToken(Builder $query, string $token): void
    {
        $query->where('token', hash('sha256', $token));
    }

    public static function randomToken(): string
    {
        return Str::random(64);
    }
}
