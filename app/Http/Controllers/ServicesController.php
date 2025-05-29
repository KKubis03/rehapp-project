<?php

namespace App\Http\Controllers;

use App\Services\ServicesService;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    private ServicesService $service;
    public function __construct() {
        $this->service = new ServicesService();
    }
    public function index(Request $request) {
        $models = $this->service->get($request->input('search'));
        $search = $request->input('search', '');
        return view("services.index",['title' => 'Rehapp - Services','models' => $models, 'search' => $search]);
    }
    public function create() {
        return view("services.create",['title' => 'Rehapp - New Service']);
    }
    public function addToDB(Request $request) {
        $this->service->create($request);
        return redirect('/services')->with('success', 'Service created successfully.');
    }
    public function edit(int $id) {
        $model = $this->service->getById($id);
        return view("services.edit",['title' => 'Rehapp - Edit Service','model' => $model]);
    }
    public function updateToDB(Request $request, int $id) {
        $this->service->edit($request, $id);
        return redirect("/services");
    }
    public function delete(int $id) {
        $this->service->delete($id);
        return redirect("/services");
    }
}
