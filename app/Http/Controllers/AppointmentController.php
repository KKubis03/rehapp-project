<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Services\AppointmentService;
use App\Services\PatientService;
use App\Services\PhysiotherapistService;
use App\Services\ServicesService;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AppointmentController extends Controller
{
    private AppointmentService $service;
    public function __construct() {
        $this->service = new AppointmentService();
    }
    public function index(Request $request) {
        $models = $this->service->get($request->input('search'));
        $search = $request->input('search', '');
        return view("appointments.index",['title' => 'Rehapp - Appointments','models' => $models, 'search' => $search]);
    }
    public function create() {
        $servicesService = new ServicesService();
        $services = $servicesService->get("");
        $patientsService = new PatientService();
        $patients = $patientsService->get("");
        $physiotherapistsService = new PhysiotherapistService();
        $physiotherapists = $physiotherapistsService->get("");
        return view("appointments.create",['title' => 'Rehapp - New Appointment',
            'services' => $services,'patients' => $patients, 'physiotherapists' => $physiotherapists,'availablehours' => []]);
    }
    public function edit(int $id) {
        $servicesService = new ServicesService();
        $services = $servicesService->get("");
        $patientsService = new PatientService();
        $patients = $patientsService->get("");
        $physiotherapistsService = new PhysiotherapistService();
        $physiotherapists = $physiotherapistsService->get("");
        $model = $this->service->getById($id);
        $selectedTime = date('G:i', strtotime($model->AppointmentTime));
        return view("appointments.edit",['title' => 'Rehapp - Edit Appointment',
            'services' => $services,'patients' => $patients, 'physiotherapists' => $physiotherapists,'availablehours' => [],
        'model' => $model,'selectedTime' => $selectedTime],);
    }
    public function updateToDB(Request $request, int $id) {
        $this->service->edit($request, $id);
        return redirect("/appointments");
    }
    public function addToDB(Request $request) {
        $this->service->create($request);
        return redirect('/appointments')->with('success', 'Appointment created successfully.');
    }
    public function getAvailableHours(Request $request)
    {
        $hours = $this->service->getAvailableHours(
            (int) $request->input('Physiotherapist'), 
            $request->input('AppointmentDate')
        );
        return response()->json($hours);
    }
    public function delete(int $id) {
        $this->service->delete($id);
        return redirect("/appointments");
    }
}