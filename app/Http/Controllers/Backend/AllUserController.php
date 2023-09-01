<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Traits\EncryptDecrypt;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rules;

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
        return view ('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        if ($request->role == 'Agent')
        {
            $validate = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'name' =>  $validate['name'],
                'email' => $validate['email'],
                'role' =>  $request->role,
                'status' => 'inactive',
                'password' => Hash::make($validate['password']),
            ]);

            event(new Registered($user));

            return Redirect::route('admin.users.index', ['role' => $request->role])
                ->with([
                    'status' => 'success',
                    'message' => 'Agent created successfully'
                ]);
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $decrypted_id = $this->decryptId($id);

        $user = User::findOrFail($decrypted_id);

        if ($user->status == 'active'){
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

        $user->status = $request->status === 'true' ? 'active' : 'inactive';
        $user->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? 'User Account Activated !!' : 'User Account Suspended !!',
        ]);
    }
}
