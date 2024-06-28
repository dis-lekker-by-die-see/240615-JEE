<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'events';

    // Specify the primary key associated with the table
    protected $primaryKey = 'event_id';

    // Indicate if the primary key is auto-incrementing
    public $incrementing = true;

    // Specify the data type of the primary key
    protected $keyType = 'int';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'sport_id',
        'fee_id',
        'event_code',
        'event_name',
        'event_description',
        'event_description_note', // Add the new column here
    ];

    // Define the attributes that should be cast to native types
    protected function casts(): array
{
    return [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

    // Define the relationship with the Sport model
    public function sport()
    {
        return $this->belongsTo(Sport::class, 'sport_id');
    }

    // Define the relationship with the Fee model
    public function fee()
    {
        return $this->belongsTo(Fee::class, 'fee_id');
    }
}
