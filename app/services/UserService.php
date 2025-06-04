<?php
namespace App\Services;
use Illuminate\Support\Facades\Auth;
use App\Models\MyUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
class UserService {
    public function get(): Collection {
        return MyUser::where("IsActive", "=",true)->get();
    }
    public function getById(int $id) {
        return MyUser::find($id);
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
        $model = MyUser::where('Login', $request->input('Login'))->where('isActive','=',1)->first();
        return $model;
    }
    public function editLogin(Request $request, int $id) {
        $request->validate([
            'Login' => ['required', 'min:1'], //  'regex:/^[^\d][A-Za-z0-9_]{2,}$/'
        ], [
            'Login.regex' => 'Login can not start with a digit and should contain only letters and numbers',
            'Login.min' => 'Login must be at least 6 characters.',
        ]);
        $user = Auth::user();
        if ($user->Id !== $id) {
            abort(403);
        }
        $model = MyUser::find($id);
        $model->Login = $request->input("Login");
        $model->save();
    }
    public function editPassword(Request $request, int $id) {
        $request->validate([
            'OldPassword' => ['required', 'min:1'], // 'regex:/^(?=.*[A-Z])(?=.*\d).+$/'
            'NewPassword' => ['required', 'min:1'], // 'regex:/^(?=.*[A-Z])(?=.*\d).+$/'
            'ConfirmPassword' => ['required', 'same:NewPassword'],
        ], [
            'NewPassword.min' => 'Password must be at least 6 characters.',
            'NewPassword.regex' => 'Password must contain at least one uppercase letter and one digit.',
            'ConfirmPassword.same' => 'Passwords are not the same.',
        ]);
        $user = Auth::user();
        if ($user->Id !== $id) {
            abort(403);
        }
        if (!Hash::check($request->input('OldPassword'), $user->Password)) {
            return false;
            //return back()->withErrors(['OldPassword' => 'Old password is invalid.']);
        }
        $model = MyUser::find($id);
        $model->Password = Hash::make($request->input("NewPassword"));
        $model->save();
        return true;
    }
    public function delete(int $id) {
        $model = MyUser::find($id);
        $model->IsActive = false;
        $model->save();
    }
}