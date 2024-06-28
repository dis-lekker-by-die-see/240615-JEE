<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'associations';

    // Specify the primary key associated with the table
    protected $primaryKey = 'association_id';

    // Indicate if the primary key is auto-incrementing
    public $incrementing = true;

    // Specify the data type of the primary key
    protected $keyType = 'int';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'association_name',
        'association_email',
        'association_password',
        'association_president',
        'association_secretary',
        'association_mobile',
        'association_phone',
        'association_fax',
        'association_prefecture',
        'association_address',
    ];

    // Define the attributes that should be hidden for arrays
    protected $hidden = [
        'association_password',
    ];

    // Define the attributes that should be cast to native types
    protected function casts(): array
{
    return [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
}
