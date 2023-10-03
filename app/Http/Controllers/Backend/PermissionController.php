<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PermissionDataTable;
use App\Http\Controllers\Controller;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use App\Exports\PermissionExport;
use App\Imports\PermissionImport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class PermissionController extends Controller
{
    use EncryptDecrypt;
    /**
     * Display a listing of the resource.
     */
    public function index(PermissionDataTable $dataTable)
    {
        $permissions = Permission::all();

        return $dataTable->render('admin.permission.index',
            [
                'permissions' => $permissions
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'min:5','max:20'],
            'group_name' => ['required', 'string', 'min:5','max:20'],
        ]);

        Permission::create([
            'name' => $validate['name'],
            'group_name' => $validate['group_name'],
        ]);

        return Redirect::route('admin.permissions.index')->with(
            [
                'status' => 'success',
                'message' => 'Permission created successfully'
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

        $permission = Permission::findOrFail($decrypted_id);

        return view('admin.permission.edit',
            [
               'permission' => $permission
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
            'group_name' => ['required', 'string', 'min:5','max:20'],
        ]);

        $permission_id = $this->decryptId($id);

        Permission::findOrFail($permission_id)->update([
            'name' => $validate['name'],
            'group_name' => $validate['group_name'],
        ]);

        return Redirect::route('admin.permissions.index')->with(
            [
                'status' => 'success',
                'message' => 'Permission Updated successfully'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $decrypted_id = $this->decryptId($id);

        $permission = Permission::findOrFail($decrypted_id);

        $permission->delete();
        return response([
            'status' => 'success',
            'message' => 'Permission Deleted successfully !!',
        ]);
    }

    /**
     * import permissions from an excel file.
     */

    public function importPermissions(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'import' => ['required', 'file'],
        ]);

        Excel::import(new PermissionImport, $request->import);

        return Redirect::route('admin.permissions.index')
            ->with(
                [
                    'status' => 'success',
                    'message' => 'Permissions imported Successfully'
                ]
            );
    }


    /**
     * export permissions from an excel file.
     */

    public function exportPermissions(): BinaryFileResponse
    {
        return Excel::download(new PermissionExport, 'permissions.xlsx');
    }
}
