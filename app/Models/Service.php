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
    public function physiotherapistservices() {
        return $this->hasMany(Physiotherapistservices::class,"ServiceId");
    }
    public function appointments() {
        return $this->hasMany(Appointment::class, 'ServiceId', 'Id');
    }
}