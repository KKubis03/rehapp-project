<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Physiotherapistservices extends Model {
    use HasFactory;
    const UPDATED_AT = "EditDateTime";
    const CREATED_AT = "CreationDateTime";

    protected $table = "physiotherapistservices";
    protected $primaryKey = "Id";
    public function physiotherapist() {
        return $this->belongsTo(Physiotherapist::class,"PhysiotherapistId");
    }
    public function service() {
        return $this->belongsTo(Service::class,"ServiceId");
    }
}