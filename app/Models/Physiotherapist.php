<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Physiotherapist extends Model {
    use HasFactory;
    const UPDATED_AT = "EditDateTime";
    const CREATED_AT = "CreationDateTime";

    protected $table = "physiotherapists";
    protected $primaryKey = "Id";
    public function physiotherapistservices() {
        return $this->hasMany(Physiotherapistservices::class,"PhysiotherapistId");
    }
    public function services()
    {
        return $this->belongsToMany(
        Service::class,
        'physiotherapistservices',
        'PhysiotherapistId',
        'ServiceId'
        )
        ->withPivot('IsActive')
        ->withTimestamps()
        ->wherePivot('IsActive', true);
    }
}