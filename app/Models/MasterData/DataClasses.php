<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

class DataClasses extends Model
{
    protected $table = 'data_classes';

    protected $fillable = [
        'name',
        'description',
    ];

    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    public $timestamps = true;
}
