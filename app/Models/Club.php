<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'clubs';

    // Specify the primary key associated with the table
    protected $primaryKey = 'club_id';

    // Indicate if the primary key is auto-incrementing
    public $incrementing = true;

    // Specify the data type of the primary key
    protected $keyType = 'int';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'user_id',
        'association_id',
        'club_name',
        'club_email',
        'club_password',
        'club_registration_officer',
        'club_mobile',
        'club_phone',
        'club_fax',
        'club_address',
    ];

    // Define the attributes that should be hidden for arrays
    protected $hidden = [
        'club_password',
    ];

    // Define the attributes that should be cast to native types
    protected function casts(): array
{
    return [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define the relationship with the Association model
    public function association()
    {
        return $this->belongsTo(Association::class, 'association_id');
    }

    public function teams()
    {
        return $this->hasMany(Team::class, 'club_id');
    }

    // Define the relationship with the Horse model
    public function horses()
    {
        return $this->hasMany(Horse::class, 'club_id');
    }

    // Define the relationship with the Rider model
    public function riders()
    {
        return $this->hasMany(Rider::class, 'club_id');
    }

}
