<?php

namespace App\DataTables;

use App\Models\Category;
use App\Traits\EncryptDecrypt;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
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

                   if(Auth::user()->can('categories.action')){

                       return"<a href='".route('admin.category.edit', $this->encryptId($query->id))."'>
                               <button class='btn btn-inverse-primary'>
                               <i class='far fa-edit'></i>
                               </button>
                               </a>
                               <a class='delete-item' href='".route('admin.category.destroy', $this->encryptId($query->id))."'>
                              <button class='btn btn-inverse-danger'>
                              <i class='far fa-trash-alt'></i>
                              </button>
                              </a>

                               ";
                   }

               })

               ->addColumn('status', function ($query){

                   if(Auth::user()->can('categories.status')) {
                       if ($query->status == 1){
                           return '<div class="form-check form-switch">
                                 <input
                                 class="form-check-input change-status"
                                 type="checkbox" id="activeChecked"
                                 data-id="' . $this->encryptId($query->id) . '"
                                 checked>
                             </div>';
                       }else{
                        return '<div class="form-check form-switch">
                                 <input
                                 class="form-check-input change-status"
                                 type="checkbox"
                                 data-id="' . $this->encryptId($query->id) . '"
                                 id="inActiveChecked">
                             </div>';
                       }

                   }

               })

                ->addColumn('num', content: function ($query)  {
                    return "<a><button type='button' class='btn btn-inverse-info'>$query->id</button></a>";
                })
                ->addColumn('', content: function ($query)  {
                    return "";
                })
               ->rawColumns(['action', 'status', 'num', ''])
               ->setRowId('id');

    }

    /**
     * Get query source of dataTable.
     *
     * @param Category $model
     * @return QueryBuilder
     */
    public function query(Category $model): QueryBuilder
    {
            return $model->newQuery()
                ->orderBy('id', 'ASC');

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return HtmlBuilder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('category-table')
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
                Column::make('icon'),
                Column::make('name'),
                Auth::user()->can('categories.status') ? Column::make('status') : '',
                Auth::user()->can('categories.action')
                    ? Column::computed('action')
                        ->exportable(false)
                        ->printable(false)
                        ->width(60)
                        ->addClass('text-center')
                    : '',

            ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }
}
