<?php

namespace App\DataTables;

use App\Models\PropertyMap;
use App\Traits\EncryptDecrypt;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PropertyMapDataTable extends DataTable
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

                return "<a class='delete-item' href='".route(Auth::user()->role.'.property-map.destroy', $this->encryptId($query->id))."'>
                              <button class='btn btn-inverse-danger'>
                              <i class='far fa-trash-alt'></i>
                              </button>
                              </a>";

            })
            ->addColumn('latitude', content: function ($query)  {
                return "<a><button type='button' class='btn btn-inverse-success'><i class='fa-solid fa-location-dot fa-beat-fade'></i>&ensp;  $query->latitude</button></a>";
            })
            ->addColumn('longitude', content: function ($query)  {
                return "<a><button type='button' class='btn btn-inverse-success'><i class='fa-solid fa-location-dot fa-beat-fade'></i>&ensp;  $query->longitude</button></a>";
            })
            ->addColumn('num', content: function ($query)  {
                return "<a><button type='button' class='btn btn-inverse-info'>$query->id</button></a>";
            })

            ->rawColumns( ['action', 'latitude', 'longitude', 'num' ])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param PropertyMap $model
     * @return QueryBuilder
     */
    public function query(PropertyMap $model): QueryBuilder
    {
        return $model->where('property_id', $this->decryptId(request()->property))
            ->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return HtmlBuilder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('propertymap-table')
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
            Column::make('latitude'),
            Column::make('longitude'),
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
        return 'PropertyMap_' . date('YmdHis');
    }
}
