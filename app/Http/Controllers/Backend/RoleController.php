<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use EncryptDecrypt;
    /**
     * Display a listing of the resource.
     */
    public function index(RoleDataTable $dataTable)
    {
        $roles = Role::all();

        return $dataTable->render('admin.role.index',
            [
                'roles' => $roles
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();

        return view('admin.role_permission.create',
            [
                'roles' => $roles,
                'permissions' => $permissions,
                'permission_groups' => $permission_groups,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'min:5','max:20'],
        ]);

        Role::create([
            'name' => $validate['name'],
        ]);

        return Redirect::route('admin.roles.index')->with(
            [
                'status' => 'success',
                'message' => 'Role created successfully'
            ]
        );
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
    public function edit(string $id): View
    {
        $decrypted_id = $this->decryptId($id);

        $role = Role::findOrFail($decrypted_id);

        return view('admin.role.edit',
            [
                'role' => $role
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'min:5','max:20'],
        ]);

        $role_id = $this->decryptId($id);

        Role::findOrFail($role_id)->update([
            'name' => $validate['name'],
        ]);

        return Redirect::route('admin.roles.index')->with(
            [
                'status' => 'success',
                'message' => 'Role Updated successfully'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $decrypted_id = $this->decryptId($id);

        $role = Role::findOrFail($decrypted_id);

        $role->delete();
        return response([
            'status' => 'success',
            'message' => 'Role Deleted successfully !!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function rolesPermissions(): View
    {
        $roles = Role::all();

        return view('admin.role_permission.index',
            [
                'roles' => $roles,
            ]
        );

    }


    public function rolesPermissionsSave(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'role' => ['required', 'string'],
            'permission' => ['required'],
        ]);

        $decrypt_role_id = $this->decryptId($validate['role']);
        $permission_id = $request->permission;

        $data = array();

        foreach ($permission_id as $key => $item){
            $data['role_id'] =  $decrypt_role_id;
            $data['permission_id'] =  $item;

            DB::table('role_has_permissions')->insert($data);
        }

        return Redirect::route('admin.roles.permissions')
            ->with(
                [
                    'status' => 'success',
                    'message' => 'Roles in Permissions added'
                ]
            );


    }
}
