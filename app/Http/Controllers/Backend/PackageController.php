<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PackagePlanDataTable;
use App\Http\Controllers\Controller;
use App\Models\PackagePlan;
use App\Traits\EncryptDecrypt;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PackageController extends Controller
{
    use EncryptDecrypt;
    /**
     * Display a listing of the resource.
     */
    public function index(PackagePlanDataTable $dataTable)
    {
        $package = PackagePlan::all();
        return $dataTable->render('admin.package.index',
            [
                'package' => $package
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }

    public function invoice(string $id): Response
    {
        $decrypted_id = $this->decryptId($id);

        $package_plan = PackagePlan::where('id', $decrypted_id)->first();

        $pdf = Pdf::loadView('admin.package.print.index',
            [
                'package_plan' => $package_plan
            ]
        )
            ->setPaper('a4')
            ->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
                'defaultFont' => 'sans-serif'
            ]);

        return $pdf->download($package_plan->name.'_'.$package_plan->invoice.'_'.'invoice.pdf');
    }
}
