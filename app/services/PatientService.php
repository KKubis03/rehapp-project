<?php
namespace App\Services;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PatientService {
    public function get(?string $search): Collection {
        $models = Patient::where("IsActive", "=",true);
        if($search) {
            $models = $models->where("LastName","like","%$search%");
        }
        return $models->get();
    }
    public function getById(int $id) {
        return Patient::find($id);
    }
    public function create(Request $request) {
        $request->validate([
            'FirstName' => ['required', 'string', 'max:100', 'regex:/^[\pL\s\-]+$/u'],
            'LastName' => ['required', 'string', 'max:100', 'regex:/^[\pL\s\-]+$/u'],
            'Email' => ['required', 'string', 'email', 'max:200'],
            'PhoneNumber' => ['required', 'string', 'regex:/^[0-9+\-\s\(\)]+$/', 'min:7', 'max:30'],
            'BirthDate' => ['required', 'date', 'before_or_equal:today'],
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

            'BirthDate.required' => 'Birth date is required.',
            'BirthDate.date' => 'Birth date must be a valid date.',
            'BirthDate.before_or_equal' => 'Birth date cannot be in the future.',
        ]);
        $model = new Patient();
        $model->FirstName = $request->input('FirstName');
        $model->LastName = $request->input('LastName');
        $model->Email = $request->input('Email');
        $model->PhoneNumber = $request->input('PhoneNumber');
        $model->BirthDate = $request->input('BirthDate');
        $model->IsActive = true;
        $model->save();
    }
    public function edit(Request $request, int $id) {
        $request->validate([
            'FirstName' => ['required', 'string', 'max:100', 'regex:/^[\pL\s\-]+$/u'],
            'LastName' => ['required', 'string', 'max:100', 'regex:/^[\pL\s\-]+$/u'],
            'Email' => ['required', 'string', 'email', 'max:200'],
            'PhoneNumber' => ['required', 'string', 'regex:/^[0-9+\-\s\(\)]+$/', 'min:7', 'max:30'],
            'BirthDate' => ['required', 'date', 'before_or_equal:today'],
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

            'BirthDate.required' => 'Birth date is required.',
            'BirthDate.date' => 'Birth date must be a valid date.',
            'BirthDate.before_or_equal' => 'Birth date cannot be in the future.',
        ]);
        $model = Patient::find($id);
        $model->FirstName = $request->input('FirstName');
        $model->LastName = $request->input('LastName');
        $model->Email = $request->input('Email');
        $model->PhoneNumber = $request->input('PhoneNumber');
        $model->BirthDate = $request->input('BirthDate');
        $model->IsActive = true;
        $model->save();
    }
    public function delete(int $id) {
        $model = Patient::find($id);
        $model->IsActive = false;
        $model->save();
    }
}