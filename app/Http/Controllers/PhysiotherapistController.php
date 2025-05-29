<?php

namespace App\Http\Controllers;

use App\Services\PhysiotherapistService;
use App\Services\ServicesService;
use Illuminate\Http\Request;

class PhysiotherapistController extends Controller
{
    private PhysiotherapistService $service;
    public function __construct() {
        $this->service = new PhysiotherapistService();
    }
    public function index(Request $request) {
        $models = $this->service->get($request->input('search'));
        $search = $request->input('search', '');
        return view("physiotherapists.index",['title' => 'Rehapp - Physiotherapists','models' => $models, 'search' => $search]);
    }
    public function create() {
        $servicesService = new ServicesService();
        $services = $servicesService->get("");
        return view("physiotherapists.create",['title' => 'Rehapp - New Physiotherapist', 'services' => $services]);
    }
    public function details(int $id) {
        $model = $this->service->getById($id);
        return view("physiotherapists.details",['title' => 'Rehapp - Physiotherapist', 'model' => $model]);
    }
    public function addToDB(Request $request) {
        $this->service->create($request);
        return redirect('/physiotherapists')->with('success', 'Physiotherapist created successfully.');
    }
    public function edit(int $id) {
        $servicesService = new ServicesService();
        $services = $servicesService->get("");
        $model = $this->service->getById($id);
        return view("physiotherapists.edit",['title' => 'Rehapp - Edit Physiotherapist','model' => $model, 'services' => $services]);
    }
    public function updateToDB(Request $request, int $id) {
        $this->service->edit($request, $id);
        return redirect("/physiotherapists/details/$id");
    }
    public function delete(int $id) {
        $this->service->delete($id);
        return redirect("/physiotherapists");
    }
}
