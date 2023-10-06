<?php

namespace App\Traits;

/**
 * @method middleware(string $string)
 */
trait CategoriesAuthPermissions
{

    public function __construct(){
        $this->middleware('permission:categories.menu')->only("index");
        $this->middleware('permission:categories.all')->only("index");
        $this->middleware('permission:categories.add')->only("create");
        $this->middleware('permission:categories.edit')->only("edit");
        $this->middleware('permission:categories.delete')->only("destroy");
        $this->middleware('permission:categories.action')->only("destroy");
    }

}
