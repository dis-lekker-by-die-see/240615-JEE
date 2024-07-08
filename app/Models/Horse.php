<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horse extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'horses';

    // Specify the primary key associated with the table
    protected $primaryKey = 'horse_id';

    // Indicate if the primary key is auto-incrementing
    public $incrementing = true;

    // Specify the data type of the primary key
    protected $keyType = 'int';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'club_id',
        'country_id',
        'horse_name',
        'horse_name_furigana',
        'horse_registration_number',
        'horse_international_registration_number',
        'horse_sex',
        'horse_age',
        'horse_color',
        'horse_breed',
        'horse_origin',
        'horse_owner',
    ];

    // Define the attributes that should be cast to native types
    protected function casts(): array
    {
        return [
            'horse_age' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }
    
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'country_id');
    }

}
