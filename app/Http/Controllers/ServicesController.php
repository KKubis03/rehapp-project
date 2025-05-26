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
    public function index() {
        $models = $this->service->get();
        //dd($models);
        return view("services.index",['title' => 'Rehapp - Services','models' => $models]);
    }
}
