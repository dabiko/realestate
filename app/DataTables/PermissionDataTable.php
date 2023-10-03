<?php

namespace App\DataTables;

use App\Traits\EncryptDecrypt;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PermissionDataTable extends DataTable
{
    use EncryptDecrypt;
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query){

                $editBtn ="<a href='".route('admin.permissions.edit', $this->encryptId($query->id))."'>
                               <button class='btn btn-inverse-primary'>
                               <i class='far fa-edit'></i>
                               </button>
                               </a>";

                $deleteBtn ="<a class='delete-item' href='".route('admin.permissions.destroy', $this->encryptId($query->id))."'>
                              <button class='btn btn-inverse-danger'>
                              <i class='far fa-trash-alt'></i>
                              </button>
                              </a>";



                return $editBtn.$deleteBtn;
            })
            ->addColumn('num', content: function ($query)  {

                    $num =  $query->id ;
                    return "<a><button type='button' class='btn btn-inverse-info'>".$num."</button></a>";

            })
            ->rawColumns(['action', 'num'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param Permission $model
     * @return QueryBuilder
     */
    public function query(Permission $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return HtmlBuilder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('permission-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
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
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('num'),
            Column::make('name'),
            Column::make('group_name'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Permission_' . date('YmdHis');
    }
}
