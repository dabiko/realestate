<?php

namespace App\DataTables;

use App\Models\PropertyPlan;
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

class PropertyPlanDataTable extends DataTable
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

                $viewBtn ="<a data-bs-toggle='modal' data-bs-target='#exampleModal-".$query->id."' href=''>
                               <button class='btn btn-inverse-info'>
                               <i class='far fa-eye'></i>
                               </button>
                               </a>";

                $editBtn ="<a href='".route(Auth::user()->role.'.property-plan.edit', $this->encryptId($query->id))."'>
                               <button class='btn btn-inverse-primary'>
                               <i class='far fa-edit'></i>
                               </button>
                               </a>";

                $deleteBtn ="<a class='delete-item' href='".route(Auth::user()->role.'.property-plan.destroy', $this->encryptId($query->id))."'>
                              <button class='btn btn-inverse-danger'>
                              <i class='far fa-trash-alt'></i>
                              </button>
                              </a>";



                return $viewBtn.$editBtn.$deleteBtn;
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
            ->addColumn('default', function ($query){
                $default   = '<div class="form-check form-switch">
                                 <input
                                 class="form-check-input change-default"
                                 type="checkbox" id="activeChecked"
                                 data-id="'.$this->encryptId($query->id).'"
                                 checked>
                             </div>';

                $noDefault   = '<div class="form-check form-switch">
                                 <input
                                 class="form-check-input change-default"
                                 type="checkbox"
                                 data-id="'.$this->encryptId($query->id).'"
                                 id="inActiveChecked">
                             </div>';

                if ($query->is_default == 1){
                    return $default;
                }else{
                    return $noDefault;
                }

            })
            ->addColumn('num', content: function ($query)  {
                return "<a><button type='button' class='btn btn-inverse-info'>$query->id</button></a>";
            })
            ->addColumn('description', content: function ($query)  {
                return "<p class='alert alert-primary'>
                                  ".truncate($query->short_desc, 50)." <a href='' class='badge rounded-pill bg-primary' data-bs-toggle='modal' data-bs-target='#exampleModal-".$query->id."'>see more</a>
                        </p>";
            })
            ->addColumn('image', content: function ($query)  {
                return "<a data-bs-toggle='modal' data-bs-target='#exampleModal-".$query->id."'>
                       <img class='mb-2' style='border-radius: 2px; width:30%; height:30%;'  src='".asset($query->image)."' alt='image'></img>
                        <h6>$query->name</h6>
                       </a>
                         <div class='modal fade' id='exampleModal-".$query->id."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                              <div class='modal-dialog-centered modal-dialog modal-lg'>
                                <div class='modal-content'>
                                  <div class='modal-header'>
                                    <h5 class='modal-title' id='exampleModalLabel-".$query->id."'>$query->name </h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='btn-close'></button>
                                  </div>
                                  <div class='modal-body'>
                                    <img class='mb-3' style='border-radius: 2px; width:100%; height:100%;' src='".asset($query->image)."'  alt='plan image'/>

                                                  <div class='row form-group mb-3'>
                                                        <label for='recipient-name' class='form-label'>Long Description</label>
                                                        <textarea maxlength='100' rows='8' disabled id='tinymceExample' class='form-control' name='low_price' id='low_price'>
                                                        $query->short_desc
                                                      </textarea>
                                                 </div>
                                  </div>
                                  <div class='modal-footer'>
                                    <button type='button' class='btn btn-inverse-secondary' data-bs-dismiss='modal'>Close</button>
                                  </div>
                                </div>
                              </div>
                       </div>";
            })

            ->rawColumns(['image', 'action', 'status', 'default', 'num', 'description'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param PropertyPlan $model
     * @return QueryBuilder
     */
    public function query(PropertyPlan $model): QueryBuilder
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
                    ->setTableId('propertyplan-table')
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
            Column::make('image'),
            Column::make('description'),
            Column::make('default'),
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
        return 'PropertyPlan_' . date('YmdHis');
    }
}
