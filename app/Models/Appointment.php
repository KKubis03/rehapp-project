<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Appointment extends Model {
    use HasFactory;
    const UPDATED_AT = "EditDateTime";
    const CREATED_AT = "CreationDateTime";

    protected $table = "appointments";
    protected $primaryKey = "Id";
    public function service() {
        return $this->belongsTo(Service::class, 'ServiceId', 'Id');
    }
    public function patient() {
        return $this->belongsTo(Patient::class, 'PatientId', 'Id');
    }
    public function physiotherapist() {
        return $this->belongsTo(Physiotherapist::class, 'PhysiotherapistId', 'Id');
    }
}