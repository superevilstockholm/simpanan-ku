<?php

namespace App\Models\Tabungan;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class DataTabungan extends Model
{
    protected $table = 'data_tabungan';

    protected $fillable = [
        'nominal',
        'user_id',
    ];

    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
