<?php

namespace App\Http\Controllers;

use App\Services\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    private PatientService $service;
    public function __construct() {
        $this->service = new PatientService();
    }
    public function index(Request $request) {
        $models = $this->service->get($request->input('search'));
        $search = $request->input('search', '');
        return view("patients.index",['title' => 'Rehapp - Patients','models' => $models, 'search' => $search]);
    }
    public function create() {
        return view("patients.create",['title' => 'Rehapp - New Patient']);
    }
    public function addToDB(Request $request) {
        $this->service->create($request);
        return redirect('/patients')->with('success', 'Physiotherapist created successfully.');
    }
    public function edit(int $id) {
        $model = $this->service->getById($id);
        return view("patients.edit",['title' => 'Rehapp - Edit Patient','model' => $model]);
    }
    public function updateToDB(Request $request, int $id) {
        $this->service->edit($request, $id);
        return redirect("/patients");
    }
    public function delete(int $id) {
        $this->service->delete($id);
        return redirect("/patients");
    }
}