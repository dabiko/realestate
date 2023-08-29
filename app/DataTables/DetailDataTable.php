<?php

namespace App\DataTables;

use App\Models\Detail;
use App\Traits\EncryptDecrypt;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DetailDataTable extends DataTable
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

                    $editBtn ="<a href='".route('admin.detail.edit', $this->encryptId($query->id))."'>
                               <button class='btn btn-inverse-primary'>
                               <i class='far fa-edit'></i>
                               </button>
                               </a>";

                    $deleteBtn ="<a class='delete-item' href='".route('admin.detail.destroy', $this->encryptId($query->id))."'>
                              <button class='btn btn-inverse-danger'>
                              <i class='far fa-trash-alt'></i>
                              </button>
                              </a>";



                    return $editBtn.$deleteBtn;
                })
                ->addColumn('status', function ($query){
                    $active   = '<div class="form-check form-switch">
                                 <input
                                 class="form-check-input change-status"
                                 type="checkbox" id="activeChecked"
                                 data-id="'.$this->encryptId($query->id).'"
                                 checked>
                             </div>';

                    $InActive   = '<div class="form-check form-switch">
                                 <input
                                 class="form-check-input change-status"
                                 type="checkbox"
                                 data-id="'.$this->encryptId($query->id).'"
                                 id="inActiveChecked">
                             </div>';

                    if ($query->status == 1){
                        return $active;
                    }else{
                        return $InActive;
                    }

                })
                ->addColumn('num', content: function ($query)  {
                    return "<a><button type='button' class='btn btn-inverse-info'>$query->id</button></a>";
                })
                ->addColumn('created_at', content: function ($query)  {

                    return  Carbon::parse($query->created_at)->diffForHumans();
                })
                ->addColumn('updated_at', content: function ($query)  {

                    return Carbon::parse($query->updated_at)->diffForHumans();
                })
                ->rawColumns(['action', 'created_at', 'updated_at', 'status', 'num'])
                ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param Detail $model
     * @return QueryBuilder
     */
    public function query(Detail $model): QueryBuilder
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
                    ->setTableId('detail-table')
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
            Column::make('status'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
        return 'Detail_' . date('YmdHis');
    }
}
