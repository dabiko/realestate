<?php

namespace App\DataTables;

use App\Models\PropertyBookTour;
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

class PropertyBookTourDataTable extends DataTable
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

                $eyeBtn ="<a data-bs-toggle='modal' data-bs-target='#exampleModal-".$query->id."'>
                               <button class='btn btn-inverse-info'>
                               <i class='far fa-eye'></i>
                               </button>
                               </a>

                        <div class='modal fade' id='exampleModal-".$query->id."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                              <div class='modal-dialog-centered modal-dialog modal-lg'>
                                <div class='modal-content'>
                                  <div class='modal-header'>
                                    <h5 class='modal-title' id='exampleModalLabel-".$query->id."'>".$query->property->name."  </h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='btn-close'></button>
                                  </div>
                                  <div class='modal-body'>
                                    <div class='example'>
                                           <div class='row form-group mb-3'>
                                                        <label for='recipient-name' class='form-label'>Message</label>
                                                        <textarea maxlength='100' rows='8' disabled id='tinymceExample' class='form-control' name='low_price' id='low_price'>
                                                        $query->message
                                                      </textarea>
                                                 </div>
                                        </div>
                                  </div>
                                  <div class='modal-footer'>
                                    <button type='button' class='btn btn-inverse-secondary' data-bs-dismiss='modal'>Close</button>
                                  </div>
                                </div>
                              </div>
                       </div>";

                $deleteBtn ="<a class='delete-item' href='".route(Auth::user()->role.'.property-scheduled-tour.destroy', $this->encryptId($query->id))."'>
                              <button class='btn btn-inverse-danger'>
                              <i class='far fa-trash-alt'></i>
                              </button>
                              </a>";

                return $eyeBtn.$deleteBtn;
            })
            ->addColumn('status', function ($query){
                $active   = '<bubtton  class="btn btn-inverse-success update-schedule"
                                      data-id="'.$this->encryptId($query->id).'"
                               >
                                <i class="fa-solid fa-person-circle-check fa-beat-fade"></i>
                                Confirmed
                               </bubtton>';

                $InActive   = '<bubtton  class="btn btn-inverse-warning update-schedule"
                               data-id="'.$this->encryptId($query->id).'"
                               >
                              <i class="fas fa-clock fa-spin"></i>
                                Pending
                               </bubtton>';

                if ($query->status == 1){
                    return $active;
                }else{
                    return $InActive;
                }

            })
            ->addColumn('num', content: function ($query)  {
                return "<a><button type='button' class='btn btn-inverse-info'>$query->id</button></a>";
            })

            ->addColumn('date', content: function ($query)  {
                return "<a><button type='button' class='btn btn-inverse-info'>$query->date at $query->time</button></a>";
            })
            ->addColumn('user', function ($query){
                return "
                <h6 class='mb-2'>".$query->user->name."</h6>
                <img class='mb-2' style='border-radius: 2px; width:20%; height:20%;'  src='".asset($query->user->photo)."' alt='image'></img>
                <h6>".$query->user->role."</h6>
                ";
            })

            ->addColumn('num', content: function ($query)  {
                return "<a><button type='button' class='btn btn-inverse-info'>$query->id</button></a>";
            })
            ->addColumn('property', function ($query){
                return "
                <h6 class='mb-2'>".$query->property->name."</h6>
                <img class='mb-2' style='border-radius: 2px; width:20%; height:20%;'  src='".asset($query->property->thumbnail)."' alt='image'></img>
                <h6>".$query->user->role."</h6>
                ";
            })
            ->rawColumns(['action', 'property', 'num', 'user', 'date', 'status'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param PropertyBookTour $model
     * @return QueryBuilder
     */
    public function query(PropertyBookTour $model): QueryBuilder
    {
        return $model->with(['user','property'])
            ->where('agent_id', Auth::id())->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return HtmlBuilder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('propertybooktour-table')
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
            Column::make('user'),
            Column::make('property'),
            Column::make('date'),
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
        return 'PropertyBookTour_' . date('YmdHis');
    }
}
