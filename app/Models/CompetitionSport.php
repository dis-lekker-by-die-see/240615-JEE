<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CompetitionSport extends Pivot
{
    use HasFactory;

    protected $table = 'competition_sports';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'competition_id',
        'sport_id',
    ];

    protected function casts(): array
{
    return [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
}
