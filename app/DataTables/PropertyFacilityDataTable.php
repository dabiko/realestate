<?php

namespace App\DataTables;

use App\Models\PropertyFacility;
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

class PropertyFacilityDataTable extends DataTable
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



                $itemBtn ="<a href='".route(Auth::user()->role.'.facility-item.index', ['propertyId' => $this->encryptId($query->property_id) , 'facilityId' => $this->encryptId($query->id)])."'>
                               <button class='btn btn-inverse-primary'>
                               <i class='fa-solid fa-circle-plus fa-fade'></i>
                               Facility Items
                               </button>
                               </a>";

                $deleteBtn ="<a class='delete-item' href='".route(Auth::user()->role.'.property-facility.destroy', $this->encryptId($query->id))."'>
                              <button class='btn btn-inverse-danger'>
                              <i class='far fa-trash-alt'></i>
                              </button>
                              </a>";

                return $itemBtn.$deleteBtn;
            })
            ->addColumn('icon', function ($query){

                return "<button type='button' class='btn btn-inverse-success'>".$query->facility->icon."</button>";

            })
            ->addColumn('facility', function ($query){
                return $query->facility->name;
            })
            ->addColumn('status', function ($query){
                if ($query->status === 1){

                    return    '
                                <div class="form-check form-switch">
                                 <input
                                 class="form-check-input change-status"
                                 type="checkbox" id="activeChecked"
                                 data-id="'.$this->encryptId($query->id).'"
                                 checked>
                             </div>';
                }else{

                    return   '
                            <div class="form-check form-switch">
                                 <input
                                 class="form-check-input change-status"
                                 type="checkbox"
                                 data-id="'.$this->encryptId($query->id).'"
                                 id="inActiveChecked">
                             </div>';
                }
            })
            ->addColumn('num', content: function ($query)  {
                return "<a><button type='button' class='btn btn-inverse-info'>$query->id</button></a>";
            })


            ->rawColumns(['icon', 'action', 'status', 'num'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param PropertyFacility $model
     * @return QueryBuilder
     */
    public function query(PropertyFacility $model): QueryBuilder
    {
        return $model->where('property_id', $this->decryptId(request()->property))
            ->newQuery()->orderBy('id', 'ASC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return HtmlBuilder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('propertyfacility-table')
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
            Column::make('facility'),
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
        return 'PropertyFacility_' . date('YmdHis');
    }
}
