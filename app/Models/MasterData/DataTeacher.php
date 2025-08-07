<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\User;
use App\Models\MasterData\DataClasses;

class DataTeacher extends Model
{
    use HasFactory;
    protected $table = 'data_teacher';

    protected $fillable = [
        'nik',
        'fullname',
        'gender',
        'dob',
        'class_id',
        'user_id',
    ];

    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    public $timestamps = true;

    public function class()
    {
        return $this->belongsTo(DataClasses::class, 'class_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
