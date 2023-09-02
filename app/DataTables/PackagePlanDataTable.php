<?php

namespace App\DataTables;

use App\Models\PackagePlan;
use App\Traits\EncryptDecrypt;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PackagePlanDataTable extends DataTable
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

              return "
              <a data-bs-toggle='modal' data-bs-target='#exampleModal-".$query->id."'  class='view-property'>
                              <button class='btn btn-inverse-info'>
                              <i class='far fa-eye'></i>
                              </button>
                              </a>

                                    <div class='modal fade' id='exampleModal-".$query->id."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                              <div class='modal-dialog-centered modal-dialog modal-lg'>
                                <div class='modal-content'>
                                  <div class='modal-header'>
                                    <h5 class='modal-title' id='exampleModalLabel-".$query->id."'>".$query->user->name." &ensp;  </h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='btn-close'></button>
                                  </div>
                                  <div class='modal-body'>
                                    <img class='mb-3' style='border-radius: 2px; width:50%; height:50%;' src='".asset($query->user->photo)."'  alt='property image'/>
                                    <hr>
                                    <div>
                                        <span style='text-align: left'>
                                            <p><b>Username :  </b>".$query->user->username."</p>
                                             <p><b>Phone :  </b>".$query->user->phone."</p>
                                              <p><b>Email :  </b>".$query->user->email."</p>
                                               <p><b> Package :  </b>".$query->name." Package</p>
                                                <p><b>Email :  </b>".$query->user->email."</p>
                                        </span>


                                  </div>
                                  </div>
                                  <div class='modal-footer'>
                                    <button type='button' class='btn btn-inverse-secondary' data-bs-dismiss='modal'>Close</button>
                                  </div>
                                </div>
                              </div>
                       </div>

              <a href='".route(Auth::user()->role.'.package.invoice-print', $this->encryptId($query->id))."'>
                               <button class='btn btn-inverse-primary'>
                               <i class='fa-solid fa-print fa-fade'></i>
                               </button>
                               </a>
                               <a href='".route(Auth::user()->role.'.package.invoice-print', $this->encryptId($query->id))."'>
                               <button class='btn btn-inverse-success'>
                               <i class='fa-solid fa-download fa-fade'></i>
                               </button>
                               </a>
                               ";
            })
            ->addColumn('num', content: function ($query)  {

               return "<a><button type='button' class='btn btn-inverse-info'>$query->id</button></a>";

            })
            ->addColumn('invoice', content: function ($query)  {
                return "<a><button type='button' class='btn btn-inverse-info'>$query->invoice</button></a>";
            })
            ->addColumn('created_at', content: function ($query)  {

                return "<p>".date_format( $query->created_at,'l d, M Y' )."</p><p>".Carbon::parse($query->created_at)->diffForHumans()."</p>" ;
            })
            ->addColumn('updated_at', content: function ($query)  {

                return "<p>".date_format( $query->updated_at,'l d, M Y' )."</p><p>".Carbon::parse($query->updated_at)->diffForHumans()."</p>" ;

            })
            ->addColumn('user', content: function ($query)  {

                return $query->user->name;
            })
            ->rawColumns(['action', 'invoice', 'created_at', 'updated_at', 'num'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param PackagePlan $model
     * @return QueryBuilder
     */
    public function query(PackagePlan $model): QueryBuilder
    {
        if (Auth::user()->role === 'admin'){

            return $model->newQuery()
                ->orderBy('id', 'ASC');

        }else{

            return $model->where('user_id', Auth::id())
                ->newQuery()
                ->orderBy('id', 'ASC');

        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return HtmlBuilder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('packageplan-table')
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
        if (Auth::user()->role === 'admin'){

            return [

                Column::make('num'),
                Column::make('invoice'),
                Column::make('user'),
                Column::make('name'),
                Column::make('credit'),
                Column::make('amount'),
                Column::make('created_at'),
                Column::make('updated_at'),
                Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
            ];

        }else{

            return [

                Column::make('num'),
                Column::make('invoice'),
                Column::make('name'),
                Column::make('credit'),
                Column::make('amount'),
                Column::make('created_at'),
                Column::make('updated_at'),
                Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
            ];
        }

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'PackagePlan_' . date('YmdHis');
    }
}
