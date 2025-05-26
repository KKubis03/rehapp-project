<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Service extends Model {
    use HasFactory;
    const UPDATED_AT = "EditDateTime";
    const CREATED_AT = "CreationDateTime";

    protected $table = "services";
    protected $primaryKey = "Id";
}