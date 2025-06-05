<?php
namespace App\Services;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AppointmentService {
    public function get(?string $search): Collection {
        $models = Appointment::where("IsActive", "=",true);
        if($search) {
            $models = $models->where("AppointmentDate","like","%$search%");
        }
        return $models->get();
    }
    public function getById(int $id) {
        return Appointment::find($id);
    }
    public function delete(int $id) {
        $model = Appointment::find($id);
        $model->IsActive = false;
        $model->save();
    }
    public function getAvailableHours(int $physioId, $date)
    {
        $availableHours = [
            '7:00','8:00','9:00','10:00','11:00',
            '12:00','13:00','14:00','15:00','16:00'
        ];
        $nonAvailableHours = Appointment::where('physiotherapistId', $physioId)
            ->where('appointmentDate', $date)
            ->where('isActive', true)
            ->pluck('appointmentTime')
            ->toArray();

        $nonAvailableHours = array_map(function ($time) {
            return date('G:i', strtotime($time));
        }, $nonAvailableHours);

        $availableHours = array_filter($availableHours, function ($hour) use ($nonAvailableHours) {
            return !in_array($hour, $nonAvailableHours);
        });
        return array_values($availableHours);
    }
    
    public function create(Request $request) {
        $request->validate([
            'Patient' => ['required'],
            'Service' => ['required'],
            'Physiotherapist' => ['required'],
            'Date' => ['required'],
            'Time' => ['required'],
        ]);
        $model = new Appointment();
        $model->AppointmentDate = $request->input('Date');
        $model->AppointmentTime = $request->input('Time');
        $model->ServiceId = $request->input('Service');
        $model->PatientId = $request->input('Patient');
        $model->PhysiotherapistId = $request->input('Physiotherapist');
        $model->IsActive = true;
        $model->save();
    }
    public function edit(Request $request, int $id) {
        $request->validate([
            'Patient' => ['required'],
            'Service' => ['required'],
            'Physiotherapist' => ['required'],
            'Date' => ['required'],
            'Time' => ['required'],
        ]);
        $model = Appointment::find($id);
        $model->AppointmentDate = $request->input('Date');
        $model->AppointmentTime = $request->input('Time');
        $model->ServiceId = $request->input('Service');
        $model->PatientId = $request->input('Patient');
        $model->PhysiotherapistId = $request->input('Physiotherapist');
        $model->IsActive = true;
        $model->save();
    }
}