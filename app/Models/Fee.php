<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'fees';

    // Specify the primary key associated with the table
    protected $primaryKey = 'fee_id';

    // Indicate if the primary key is auto-incrementing
    public $incrementing = true;

    // Specify the data type of the primary key
    protected $keyType = 'int';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'fee_code',
        'fee_description',
        'fee_price',
    ];

    // Define the attributes that should be cast to native types
    protected function casts(): array
{
    return [
        'fee_price' => 'decimal:0',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
}
