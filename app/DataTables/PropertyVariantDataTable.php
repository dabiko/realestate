<?php

namespace App\DataTables;

use App\Models\PropertyVariant;
use App\Traits\EncryptDecrypt;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PropertyVariantDataTable extends DataTable
{ use EncryptDecrypt;
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
                $optionBtn ="<a href='".route('admin.variant-item.index', ['propertyId' => $this->encryptId($query->property_id), 'variantId' => $this->encryptId($query->id)])."'>
                               <button class='btn btn-inverse-info''>
                               <i class='far fa-eye'></i> Variant Items
                               </button>
                               </a>";
                $editBtn ="<a href='".route('admin.property-variant.edit', $this->encryptId($query->id))."'>
                               <button class='btn btn-inverse-primary''>
                               <i class='far fa-edit'></i>
                               </button>
                               </a>";
                $deleteBtn ="<a class='delete-item' href='".route('admin.property-variant.destroy', $this->encryptId($query->id))."'>
                              <button class='btn btn-inverse-danger''>
                              <i class='far fa-trash-alt'></i>
                              </button>
                              </a>";

                return $optionBtn.$editBtn.$deleteBtn;
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
            ->addColumn('num', function ($query){

                return "<a>
                        <button type='button' class='mb-2 btn btn-inverse-info'>$query->id</button>
                       </a>";
            })
            ->rawColumns(['action', 'status', 'num'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param PropertyVariant $model
     * @return QueryBuilder
     */
    public function query(PropertyVariant $model): QueryBuilder
    {
        return $model->where('property_id', $this->decryptId(request()->property))
            ->newQuery()
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
                    ->setTableId('propertyvariant-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
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
        return 'PropertyVariant_' . date('YmdHis');
    }
}
