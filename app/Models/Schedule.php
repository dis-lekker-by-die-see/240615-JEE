<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'schedules';

    // Specify the primary key associated with the table
    protected $primaryKey = 'schedule_id';

    // Indicate if the primary key is auto-incrementing
    public $incrementing = true;

    // Specify the data type of the primary key
    protected $keyType = 'int';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'competition_id',
        'sport_id',
        'event_id',
        'fee_id',
        'schedule_number',
        'schedule_date',
        'schedule_time_per_rider',
    ];

    // Define the attributes that should be cast to native types
    protected function casts(): array
{
    return [
        'schedule_date' => 'date',
        'schedule_time_per_rider' => 'datetime:H:i:s',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

    // Define the relationships with other models
    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class, 'sport_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function fee()
    {
        return $this->belongsTo(Fee::class, 'fee_id');
    }
}
