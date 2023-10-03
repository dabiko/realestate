<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Spatie\Permission\Models\Permission;

class PermissionExport implements FromCollection
{
    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        return Permission::all(['name','group_name']);
    }
}
