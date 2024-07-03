<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';
    protected $primaryKey = 'country_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'country_name',
        'country_native_name',
        'country_code',
        'country_emoji',
        'country_flag_1x1',
        'country_flag_4x3',
    ];
}
