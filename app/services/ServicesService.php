<?php
namespace App\Services;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ServicesService {
    public function get(?string $search): Collection {
        $models = Service::where("IsActive", "=",true);
        if($search) {
            $models = $models->where("serviceName","like","%$search%");
        }
        return $models->get();
    }
    public function create(Request $request) {
        $model = new Service();
        $request->validate([
            'ServiceName' => ['required'],
            'ShortDescription' => ['required','max:255'],
            'Description' => ['required'],
        ], [
            'ShortDescription.max' => 'Short description is too long.',
        ]);
        $model->ServiceName = $request->input('ServiceName');
        $model->ShortDescription = $request->input('ShortDescription');
        $model->Description = $request->input('Description');
        $model->IsActive = true;
        $model->save();
    }
    public function getById(int $id) {
        return Service::find($id);
    }
    public function edit(Request $request, int $id) {
        $request->validate([
            'ServiceName' => ['required'],
            'ShortDescription' => ['required','max:255'],
            'Description' => ['required'],
        ], [
            'ShortDescription.max' => 'Short description is too long.',
        ]);
        $model = Service::find($id);
        $model->ServiceName = $request->input("ServiceName");
        $model->ShortDescription = $request->input("ShortDescription");
        $model->Description = $request->input("Description");
        $model->IsActive = true;
        $model->save();
    }
    public function delete(int $id) {
        $model = Service::find($id);
        $model->IsActive = false;
        $model->save();
    }
}