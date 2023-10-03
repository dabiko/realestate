<?php

namespace App\Imports;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Concerns\ToModel;

class PermissionImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Model|Permission|null
     */
    public function model(array $row): Model|Permission|null
    {
        return new Permission([
            'name'     => $row[0],
            'group_name'    => $row[1],
        ]);
    }
}
