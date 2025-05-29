<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Patient extends Model {
    use HasFactory;
    const UPDATED_AT = "EditDateTime";
    const CREATED_AT = "CreationDateTime";

    protected $table = "patients";
    protected $primaryKey = "Id";
    // Relacja: jeden pacjent ma wiele wizyt
    // public function appointments() {
    //     return $this->hasMany(Appointment::class, 'PatientId');
    // }

    // Liczba wizyt
    // public function appointmentsCount() {
    //     return $this->appointments()->count();
    // }
}