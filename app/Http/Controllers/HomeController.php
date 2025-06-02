<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\MyUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    private UserService $service;
    public function __construct() {
        $this->service = new UserService();
    }
    public function index() {
        if (!Auth::check()) {
            return redirect('/login');
        }
        return view("home.index",['title' => 'Rehapp - Home']);
    }
    public function profile() {
        $model = Auth::user();
        return view("home.profile",['title' => 'Rehapp - Profile', 'user' => $model]);
    }
    public function editLogin(Request $request, int $id) {
        $this->service->editLogin($request, $id);
        return redirect("/profile")->with('success', 'Login changed succesfully.');
    }
    public function editPassword(Request $request, int $id) {
        $this->service->editPassword($request, $id);
        return redirect("/profile")->with('success', 'Password changed succesfully.');
    }
    public function login() {
        return view("home.login",['title' => 'Rehapp - Sign in']);
    }
    public function authenticate(Request $request) {
        $request->validate([
            'Login' => ['required'],
            'Password' => ['required'],
        ]);
        $user = $this->service->findUser($request);
        if (!$user) {
            return redirect('/login')->withErrors(['Login' => 'User not found.']);
        }
        if ($user && Hash::check($request->input('Password'), $user->Password)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Signed in successfully.');
        }
        return redirect('/login')->withErrors([
            'Login' => 'Incorrect login or password',
        ])->onlyInput('Login');
    }
    public function register() {
        return view("home.register",['title' => 'Rehapp - Sign up']);
    }
    public function addToDB(Request $request) {
        $request->validate([
            'Login' => ['required', 'min:1'], //  'regex:/^[^\d][A-Za-z0-9_]{2,}$/'
            'Password' => ['required', 'min:1'], // 'regex:/^(?=.*[A-Z])(?=.*\d).+$/'
            'ConfirmPassword' => ['required', 'same:Password'],
        ], [
            'Login.regex' => 'Login can not start with a digit and should contain only letters and numbers',
            'Login.min' => 'Login must be at least 6 characters.',
            'Password.min' => 'Password must be at least 6 characters.',
            'Password.regex' => 'Password must contain at least one uppercase letter and one digit.',
            'ConfirmPassword.same' => 'Passwords are not the same.',
        ]);
        $existingUser = MyUser::where('Login', $request->input('Login'))->first();
        if ($existingUser) {
            return redirect('/register')->withErrors(['Login' => 'This login is already taken.']);
        }
        $this->service->create($request);
        return redirect('/login')->with('success', 'Account created successfully.');
    }
    public function delete(int $id) {
        $this->service->delete($id);
        return redirect("/logout");
    }
}
