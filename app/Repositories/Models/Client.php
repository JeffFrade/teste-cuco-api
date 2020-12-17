<?php

namespace App\Repositories\Models;

use Database\Factories\ClientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'document',
        'birth_date',
        'phone'
    ];

    /**
     * @return ClientFactory
     */
    protected static function newFactory()
    {
        return ClientFactory::new();
    }
}
