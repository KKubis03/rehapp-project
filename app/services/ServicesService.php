<?php
namespace App\Services;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ServicesService {
    public function get(): Collection {
        return Service::where("IsActive", "=",true)->get();
    }
}