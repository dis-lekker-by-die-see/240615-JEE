<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'teams';

    // Specify the primary key associated with the table
    protected $primaryKey = 'team_id';

    // Indicate if the primary key is auto-incrementing
    public $incrementing = true;

    // Specify the data type of the primary key
    protected $keyType = 'int';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'club_id',
        'team_name',
    ];

    // Define the attributes that should be cast to native types
    protected function casts(): array
{
    return [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

    // Define the relationship with the Club model
    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }
}
