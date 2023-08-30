<?php

namespace App\DataTables;

use App\Models\PropertyStats;
use App\Traits\EncryptDecrypt;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PropertyStatsDataTable extends DataTable
{    use EncryptDecrypt;
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('image', function ($query){
                return "
                <a data-bs-toggle='modal' data-bs-target='#exampleModal-".$query->id."'>
                   <img  class='mb-2' style='border-radius: 2px; width:50%; height:50%;' src='".asset($query->image)."' alt='image'></img>
                 <h6>".$query->property->name."</h6>
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
                                            <div id='carouselExampleCaptions' class='carousel slide' data-bs-ride='carousel'>

                                                <ol class='carousel-indicators'>
                                                    <li data-bs-target='#carouselExampleCaptions' data-bs-slide-to='0' class='active'></li>
                                                </ol>
                                                <div class='carousel-inner'>
                                                    <div class='carousel-item active'>
                                                        <img class='mb-3' style='border-radius: 2px; width:100%; height:100%;' src='".asset($query->image)."' class='d-block w-100' alt='...'>
                                                        <div class='carousel-caption d-none d-md-block'>
                                                            <h5>".$query->property->name."</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class='carousel-control-prev' data-bs-target='#carouselExampleCaptions' role='button' data-bs-slide='prev'>
                                                    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                                    <span class='visually-hidden'>Previous</span>
                                                </a>
                                                <a class='carousel-control-next' data-bs-target='#carouselExampleCaptions' role='button' data-bs-slide='next'>
                                                    <span class='carousel-control-next-icon' aria-hidden='true'></span>
                                                    <span class='visually-hidden'>Next</span>
                                                </a>
                                            </div>
                                        </div>
                                  </div>
                                  <div class='modal-footer'>
                                    <button type='button' class='btn btn-inverse-secondary' data-bs-dismiss='modal'>Close</button>
                                  </div>
                                </div>
                              </div>
                       </div>";
            })
            ->addColumn('action', function ($query){
                $viewBtn ="<a data-bs-toggle='modal' data-bs-target='#exampleModal-".$query->id."'  class='view-property'>
                              <button class='btn btn-inverse-info'>
                              <i class='far fa-eye'></i>
                              </button>
                              </a>";

                $deleteBtn ="<a class='delete-item' href='".route('admin.property-stats.destroy', $this->encryptId($query->id))."'>
                              <button class='btn btn-inverse-danger''>
                              <i class='far fa-trash-alt'></i>
                              </button>
                              </a>";

                return $viewBtn.$deleteBtn;
            })
            ->addColumn('property', function ($query){

                return $query->property->name;
            })
            ->addColumn('created_at', function ($query){

                return Carbon::parse($query->created_at)->ago();
            })
            ->addColumn('updated_at', function ($query){

                return Carbon::parse($query->updated_at)->ago();
            })
            ->addColumn('num', function ($query){

                return "<a>
                        <button type='button' class='mb-2 btn btn-inverse-info'>$query->id</button>
                       </a>";
            })
            ->rawColumns(['num', 'image', 'created_at', 'updated_at', 'action'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param PropertyStats $model
     * @return QueryBuilder
     */
    public function query(PropertyStats $model): QueryBuilder
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
                    ->setTableId('propertystats-table')
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
            Column::make('image'),
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
        return 'PropertyStats_' . date('YmdHis');
    }
}
