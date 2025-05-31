<?php
namespace App\Services;
use App\Models\InternalEvent;
use App\Models\InternalEventsAttachment;
use App\Models\MyUser;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
class UserService {
    public function get(): Collection {
        return MyUser::where("IsActive", "=",true)->get();
    }
    public function isLoginOk(Request $request) : bool {
        $request->validate([
            'Login' => ['required'],
            'Password' => ['required'],
        ]);
        $model = MyUser::where('Login', $request->input('Login'))->first();
        if (!$model) {
            return false;
        }
        if (Hash::check($request->input('Password'), $model->Password)) {
            return true;
        }
        return false;
    }
    public function create(Request $request) {
        $model = new MyUser();
        $model->Login = $request->input("Login");
        $model->Password = Hash::make($request->input("Password"));
        $model->IsAdmin = false;
        $model->IsActive = true;
        $model->save();
    }
    public function findUser(Request $request) {
        $model = MyUser::where('Login', $request->input('Login'))->first();
        return $model;
    }
}