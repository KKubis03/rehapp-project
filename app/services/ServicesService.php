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
            'ShortDescription' => ['required', 'max:255'],
            'Description' => ['required'],
            'Duration' => ['required', 'date_format:H:i'],
        ], [
            'ShortDescription.max' => 'Short description is too long.',
            'Duration.required' => 'Duration is required.',
            'Duration.date_format' => 'Duration must be in the format HH:MM.',
        ]);
        $model->ServiceName = $request->input('ServiceName');
        $model->ShortDescription = $request->input('ShortDescription');
        $model->Description = $request->input('Description');
        $model->Duration = $request->input('Duration');
        $model->IsActive = true;
        $model->save();
    }
    public function getById(int $id) {
        return Service::find($id);
    }
    public function edit(Request $request, int $id) {
        $request->validate([
            'ServiceName' => ['required'],
            'ShortDescription' => ['required', 'max:255'],
            'Description' => ['required'],
            'Duration' => ['required', 'date_format:H:i'],
        ], [
            'ShortDescription.max' => 'Short description is too long.',
            'Duration.required' => 'Duration is required.',
            'Duration.date_format' => 'Duration must be in the format HH:MM.',
        ]);
        $model = Service::find($id);
        $model->ServiceName = $request->input("ServiceName");
        $model->ShortDescription = $request->input("ShortDescription");
        $model->Description = $request->input("Description");
        $model->Duration = $request->input('Duration');
        $model->IsActive = true;
        $model->save();
    }
    public function delete(int $id) {
        $model = Service::find($id);
        $model->IsActive = false;
        $model->save();
    }
    // public function getFormattedStringDurationById(int $id) {
    //     $model = Service::find($id);
    //     [$hours, $minutes] = explode(':', $model->Duration);
    //     $hours = (int) $hours;
    //     $minutes = (int) $minutes;
    //     if ($hours > 0 && $minutes > 0) {
    //         return "{$hours} h {$minutes} min";
    //     } elseif ($hours > 0) {
    //         return "{$hours} h";
    //     } else {
    //         return "{$minutes} min";
    //     }
    // }
}