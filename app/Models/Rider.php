<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'riders';

    // Specify the primary key associated with the table
    protected $primaryKey = 'rider_id';

    // Indicate if the primary key is auto-incrementing
    public $incrementing = true;

    // Specify the data type of the primary key
    protected $keyType = 'int';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'user_id',
        'club_id',
        'country_id',
        'rider_first_names',
        'rider_first_names_furigana',
        'rider_last_name',
        'rider_last_name_furigana',
        'rider_registration_number',
        'rider_international_registration_number',
        'rider_sex',
        'rider_date_of_birth',
    ];

    // Define the attributes that should be cast to native types
    protected function casts(): array
{
    return [
        'rider_date_of_birth' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'country_id');
    }
}
