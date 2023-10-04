<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Traits\EncryptDecrypt;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class AllUserController extends Controller
{
    use EncryptDecrypt;
    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::all();

        return view ('admin.user.create',
            [
                'roles' => $roles
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //dd($request->all());

            $validate = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'role_id' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $role_id = $this->decryptId($validate['role_id']);

            $user = User::create([
                'name' =>  $validate['name'],
                'email' => $validate['email'],
                'role' =>  request()->role,
                'status' => 1,
                'password' => Hash::make($validate['password']),
            ]);

            event(new Registered($user));

            if($role_id){
                $user->assignRole($role_id);
            }

            return Redirect::route('admin.users.index', ['role' => request()->role])
                ->with([
                    'status' => 'success',
                    'message' => request()->role.' created successfully'
                ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $decrypted_id = $this->decryptId($id);

        $user = User::findOrFail($decrypted_id);
        $roles = Role::all();

        return view ('admin.user.edit',
            [
                'roles' => $roles,
                'user' => $user
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $user_id = $this->decryptId($id);

        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role_id' => ['required', 'string'],
            'role' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255',
                Rule::unique('users', 'id')->ignore($user_id)],
        ]);

        $role_id = $this->decryptId($validate['role_id']);


        $user = User::findOrFail($user_id);
        $user->name =  $validate['name'];
        $user->email =  $validate['email'];
        $user->role =  $validate['role'];
        $user->save();

        $user->roles()->detach();

        if($role_id){
            $user->assignRole($role_id);
        }

        return Redirect::route('admin.users.index', ['role' => $validate['role']])
            ->with([
                'status' => 'success',
                'message' => $validate['role'].' updated successfully'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $decrypted_id = $this->decryptId($id);

        $user = User::findOrFail($decrypted_id);

        if ($user->status == 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete '.$user->name,
                'message' => 'This User is still active. Deactivate before deleting',
            ]);
        }
            $user->delete();

        return response([
            'status' => 'success',
            'message' => 'User Deleted successfully !!',
        ]);
    }

    /**
     * Update the status resource in storage.
     */
    public function updateStatus(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);

        $user = User::findOrFail($decrypted_id);

        $user->status = $request->status === 'true' ? '1' : '0';
        $user->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? 'User Account Activated !!' : 'User Account Suspended !!',
        ]);
    }
}
