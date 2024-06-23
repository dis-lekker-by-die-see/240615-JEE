<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'entries';

    // Specify the primary key associated with the table
    protected $primaryKey = 'entry_id';

    // Indicate if the primary key is auto-incrementing
    public $incrementing = true;

    // Specify the data type of the primary key
    protected $keyType = 'int';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'competition_id',
        'sport_id',
        'team_id',
        'schedule_id',
        'rider_id',
        'horse_id',
        'fee_id',
        'entry_change_fee',
        'entry_comment',
        'entry_timestamp',
        'entry_time_slot',
        'entry_participation_order',
    ];

    // Define the attributes that should be cast to native types
    protected function casts(): array
{
    return [
        'entry_change_fee' => 'boolean',
        'entry_timestamp' => 'datetime',
        'entry_time_slot' => 'datetime:H:i:s',
        'entry_participation_order' => 'integer',
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

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }

    public function rider()
    {
        return $this->belongsTo(Rider::class, 'rider_id');
    }

    public function horse()
    {
        return $this->belongsTo(Horse::class, 'horse_id');
    }

    public function fee()
    {
        return $this->belongsTo(Fee::class, 'fee_id');
    }
}
