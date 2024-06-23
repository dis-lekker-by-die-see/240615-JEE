<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $table = 'sports';
    protected $primaryKey = 'sport_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'sport_name',
    ];

    protected function casts(): array
{
    return [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

    public function competitions()
    {
        return $this->belongsToMany(Competition::class, 'competition_sports', 'sport_id', 'competition_id')
                    ->using(CompetitionSport::class)
                    ->withTimestamps();
    }

}
