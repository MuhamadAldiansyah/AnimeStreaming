<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Enums\UserType;
 
class AuthController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('user.access:admin')->only('adminHome');
        $this->middleware('user.access:user')->only('userHome');
    }
 
    public function register()
    {
        return view('auth/register');
    }
 

    public function registerSave(Request $request)
    {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed',
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'type' => "user"
    ];

    if ($request->hasFile('profile_photo')) {
        $file = $request->file('profile_photo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('profile', $filename, 'public'); // Simpan ke folder profile dalam storage/app/public

        $data['profile_photo'] = $path;
    }

    User::create($data);

    return redirect()->route('login');
    }


    public function login()
    {
        return view('login');
    }
 
    public function loginAction(Request $request)
{
    Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required'
    ])->validate();

    if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        throw ValidationException::withMessages([
            'email' => trans('auth.failed')
        ]);
    }

    $request->session()->regenerate();

    $user = Auth::user();
    if ($user->type === UserType::USER) {
        return redirect()->route('user');
    } else {
        return redirect()->route('admin');
    }
    
}

    
 
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
 
        $request->session()->invalidate();
 
        return redirect('/login');
    }
 
    public function profile()
    {
        return view('userprofile');
    }
}