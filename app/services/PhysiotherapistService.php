<?php
namespace App\Services;

use App\Models\Physiotherapist;
use App\Models\Physiotherapistservices;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PhysiotherapistService {
    public function get(?string $search): Collection {
        //$models = Physiotherapist::where("IsActive", "=",true);
        $models = Physiotherapist::with('services')
        ->where("IsActive", "=", true);
        if($search) {
            $models = $models->where("lastName","like","%$search%");
        }
        return $models->get();
    }
    public function getById(int $id) {
        return Physiotherapist::find($id);
    }
    public function create(Request $request) {
        $request->validate([
            'FirstName' => ['required', 'string', 'max:100', 'regex:/^[\pL\s\-]+$/u'],
            'LastName' => ['required', 'string', 'max:100', 'regex:/^[\pL\s\-]+$/u'],
            'Email' => ['required', 'string', 'email', 'max:200'],
            'PhoneNumber' => ['required', 'string', 'regex:/^[0-9+\-\s\(\)]+$/', 'min:7', 'max:30'],
            'Title' => ['required', 'string', 'max:100'],
        ], [
            'FirstName.required' => 'First name is required.',
            'FirstName.string' => 'First name must be a valid string.',
            'FirstName.max' => 'First name may not be greater than 100 characters.',
            'FirstName.regex' => 'First name may only contain letters, spaces, and hyphens.',
            
            'LastName.required' => 'Last name is required.',
            'LastName.string' => 'Last name must be a valid string.',
            'LastName.max' => 'Last name may not be greater than 100 characters.',
            'LastName.regex' => 'Last name may only contain letters, spaces, and hyphens.',
            
            'Email.required' => 'Email address is required.',
            'Email.string' => 'Email must be a valid string.',
            'Email.email' => 'Please enter a valid email address.',
            'Email.max' => 'Email may not be greater than 200 characters.',
            
            'PhoneNumber.required' => 'Phone number is required.',
            'PhoneNumber.regex' => 'Phone number may only contain digits, spaces, hyphens, parentheses, and plus signs.',
            'PhoneNumber.min' => 'Phone number must be at least 7 characters.',
            'PhoneNumber.max' => 'Phone number may not be greater than 30 characters.',
            
            'Title.required' => 'Title is required.',
            'Title.string' => 'Title must be a valid string.',
            'Title.max' => 'Title may not be greater than 100 characters.',
        ]);
        $model = new Physiotherapist();
        $model->FirstName = $request->input('FirstName');
        $model->LastName = $request->input('LastName');
        $model->Email = $request->input('Email');
        $model->PhoneNumber = $request->input('PhoneNumber');
        $model->TitleName = $request->input('Title');
        $model->IsActive = true;
        $model->save();
        $selectedServices = $request->input('services');
        if($selectedServices != null) {
            foreach($selectedServices as $item) {
                $physioService = new Physiotherapistservices();
                $physioService->PhysiotherapistId = $model->Id;
                $physioService->ServiceId = $item;
                $physioService->IsActive = true;
                $physioService->save();
            }
        }
    }
    public function edit(Request $request, int $id) {
        $request->validate([
            'FirstName' => ['required', 'string', 'max:100', 'regex:/^[\pL\s\-]+$/u'],
            'LastName' => ['required', 'string', 'max:100', 'regex:/^[\pL\s\-]+$/u'],
            'Email' => ['required', 'string', 'email', 'max:200'],
            'PhoneNumber' => ['required', 'string', 'regex:/^[0-9+\-\s\(\)]+$/', 'min:7', 'max:30'],
            'Title' => ['required', 'string', 'max:100'],
        ], [
            'FirstName.required' => 'First name is required.',
            'FirstName.string' => 'First name must be a valid string.',
            'FirstName.max' => 'First name may not be greater than 100 characters.',
            'FirstName.regex' => 'First name may only contain letters, spaces, and hyphens.',
            
            'LastName.required' => 'Last name is required.',
            'LastName.string' => 'Last name must be a valid string.',
            'LastName.max' => 'Last name may not be greater than 100 characters.',
            'LastName.regex' => 'Last name may only contain letters, spaces, and hyphens.',
            
            'Email.required' => 'Email address is required.',
            'Email.string' => 'Email must be a valid string.',
            'Email.email' => 'Please enter a valid email address.',
            'Email.max' => 'Email may not be greater than 200 characters.',
            
            'PhoneNumber.required' => 'Phone number is required.',
            'PhoneNumber.regex' => 'Phone number may only contain digits, spaces, hyphens, parentheses, and plus signs.',
            'PhoneNumber.min' => 'Phone number must be at least 7 characters.',
            'PhoneNumber.max' => 'Phone number may not be greater than 30 characters.',
            
            'Title.required' => 'Title is required.',
            'Title.string' => 'Title must be a valid string.',
            'Title.max' => 'Title may not be greater than 100 characters.',
        ]);
        $model = Physiotherapist::find($id);
        $model->FirstName = $request->input('FirstName');
        $model->LastName = $request->input('LastName');
        $model->Email = $request->input('Email');
        $model->PhoneNumber = $request->input('PhoneNumber');
        $model->TitleName = $request->input('Title');
        $model->IsActive = true;
        $model->save();
        $selectedServices = $request->input('services');
        Physiotherapistservices::where('PhysiotherapistId', $model->Id)
            ->update(['IsActive' => false]);
        if($selectedServices != null) {
            foreach ($selectedServices as $item) {
                $existing = Physiotherapistservices::where('PhysiotherapistId', $model->Id)
                    ->where('ServiceId', $item)
                    ->first();
                if ($existing) {
                    $existing->IsActive = true;
                    $existing->save();
                } else {
                    $physioService = new Physiotherapistservices();
                    $physioService->PhysiotherapistId = $model->Id;
                    $physioService->ServiceId = $item;
                    $physioService->IsActive = true;
                    $physioService->save();
                }
            }
        }
    }
    public function delete(int $id) {
        $model = Physiotherapist::find($id);
        $model->IsActive = false;
        Physiotherapistservices::where('PhysiotherapistId', $model->Id)
            ->update(['IsActive' => false]);
        $model->save();
    }
}