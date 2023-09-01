<?php

namespace App\DataTables;

use App\Models\User;
use App\Traits\EncryptDecrypt;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class
UserDataTable extends DataTable
{
    use EncryptDecrypt;
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query){

                $editBtn ="<a class='m-1 btn btn-inverse-primary' href='".route('admin.users.edit', $this->encryptId($query->id))."'>
                              <i class='far fa-edit'></i>
                            </a>";

                $deleteBtn ="<a class='m-1 btn btn-inverse-danger delete-item' href='".route('admin.users.destroy', $this->encryptId($query->id))."'>
                             <i class='far fa-trash-alt'></i>
                            </a>";

                return $editBtn.$deleteBtn;
            })
            ->addColumn('photo', function ($query){

                $admin = "<a href='javascript:void(0)' class='btn btn-inverse-primary'>$query->role</a>";
                $agent = "<a href='javascript:void(0)' class='btn btn-inverse-info'>$query->role</a>";
                $user = "<a href='javascript:void(0)' class='btn btn-inverse-success'>$query->role</a>";
                $error = "<a href='javascript:void(0)' class='btn btn-inverse-danger'>$query->role</a>";

                if ($query->role == 'admin'){

                    return "
                    <img class='mb-2' style='border-radius: 2px; width:50%; height:50%;' src='".asset($query->photo)."' alt='image'></img>
                    <p>$admin</p>
                    ";

                }elseif($query->role == 'agent'){

                    return "
                       <img class='mb-2' width='70px;' src='".asset($query->photo)."' alt='image'></img>
                          <p>$agent</p>
                       ";

                }elseif($query->role == 'user'){

                    return "
                    <img class='mb-2' width='70px;' src='".asset($query->photo)."' alt='image'></img>
                    <p>$user</p>
                    ";

                }else{
                    return $error;
                }

            })
            ->addColumn('username', function ($query){

                if ($query->status == 'active'){
                   return '<p>'.$query->username.'</p>
                            <p>
                                <bubtton  disabled class="btn btn-inverse-success">
                                <i class="fa-solid fa-person-circle-check fa-beat-fade"></i>
                                Active
                               </bubtton>
                            </p>';
                }else{
                    return '<p>'.$query->username.'</p>
                                <p>
                                <bubtton disabled class="btn btn-inverse-warning">
                                   <i class="fas fa-clock fa-spin"></i>
                                Inactive
                               </bubtton>
                               </p>';
                }

            })
            ->addColumn('status', function ($query){

                if ($query->status == 'active'){

                    $activated   = '

                                <div class="form-check form-switch">
                                 <input
                                 class="form-check-input change-status"
                                 type="checkbox" id="activeChecked"
                                 data-id="'.$this->encryptId($query->id).'"
                                 checked>
                             </div>';
                }else{

                    $activated   = '

                            <div class="form-check form-switch">
                                 <input
                                 class="form-check-input change-status"
                                 type="checkbox"
                                 data-id="'.$this->encryptId($query->id).'"
                                 id="inActiveChecked">
                             </div>';
                }

                return $activated;

            })
            ->addColumn('num', content: function ($query)  {
                return "<a><button type='button' class='btn btn-inverse-info'>$query->id</button></a>";
            })
            ->rawColumns(['username', 'photo', 'action', 'status', 'num'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        if (request()->role == 'All'){

            return $model->newQuery()->orderBy('id', 'ASC');

        }else{

            return $model->where('role', request()->role)
                ->newQuery()->orderBy('id', 'ASC');

        }
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('add'),
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('num'),
            Column::make('photo'),
            Column::make('name'),
            Column::make('username'),
            Column::make('email'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
