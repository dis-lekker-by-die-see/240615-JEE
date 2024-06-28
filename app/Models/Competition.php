<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'competitions';

    // Specify the primary key associated with the table
    protected $primaryKey = 'competition_id';

    // Indicate if the primary key is auto-incrementing
    public $incrementing = true;

    // Specify the data type of the primary key
    protected $keyType = 'int';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'association_id',
        'competition_name',
        'competition_start_date',
        'competition_end_date',
        'competition_venue',
        'competition_description',
    ];

    // Define the attributes that should be cast to native types
    protected function casts(): array
{
    return [
        'competition_start_date' => 'date',
        'competition_end_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

    // Define the relationship with the Association model
    public function association()
    {
        return $this->belongsTo(Association::class, 'association_id');
    }

    public function sports()
    {
        return $this->belongsToMany(Sport::class, 'competition_sports', 'competition_id', 'sport_id')
                    ->using(CompetitionSport::class)
                    ->withTimestamps();
    }
    
}
