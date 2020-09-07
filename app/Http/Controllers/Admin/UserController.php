<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('auth.users', [
            'users' => User::all(),
            'roles' => Role::all()
        ]);
    }

    public function create()
    {
        return view('auth.create', ['roles' => Role::all()]);
    }

    public function new(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'number' => ['required', 'string', 'max:10', 'unique:users,number'],
        ]);
        $role = Role::findByName('Client');
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'type' => $data['role'],
            'password' => Hash::make($data['password']),
            'number' => $data['number'],
        ]);
        $user->assignRole($role);
        return redirect(route('user.index'));
    }

    public function store(Request $request)
    {
        $user = User::findById($request->user);
        $role = Role::findById($request->roles);
        if (isset($request->role) && !empty($request->role)) {
            $user->assignRole($role);
        } else {
            $user->removeRole($role);
        }

        return back();
    }

    public function CreateUser(Request $request)
    {
        $data = [];
        $response = 'false';
        if (isset($request->name)  && isset($request->email) && isset($request->TXNAMOUNT)) {
            if (User::where('email', $request->email)->first()) {
                return response([
                    'message' => 'User already exist.',
                    'status' => '500',
                ], 301);
            }
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'type' => 'School',
                'amount' => intval($request->TXNAMOUNT),
                'password' => Hash::make('12345678'),
            ];
            $role = Role::findByName($this->getRoleName($data['amount']));
            $user = User::create($data);
            if (isset($user)) {
                $user->assignRole($role);
                $response = 'true';
            }
            return response([
                'message' => $response,
                'status' => '200',
            ], 200);
        } else {
            return response([
                'message' => 'Please add the required feilds.',
                'status' => '301',
            ], 301);
        }
    }

    public function getRoleName($role)
    {
        try {
            switch ($role) {
                case 'Client':
                    $name = $role;
                    break;
                case '1000':
                    $name = $role;
                    break;
                default:
                    throw new Exception("There is no role available with the give name", 1);
                    break;
            }
            return $name;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
