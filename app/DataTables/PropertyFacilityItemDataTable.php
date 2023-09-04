<?php

namespace App\DataTables;

use App\Models\PropertyFacilityItem;
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

class PropertyFacilityItemDataTable extends DataTable
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



                $editBtn ="<a href='".route(Auth::user()->role.'.property-facility-item.edit', $this->encryptId($query->id))."'>
                               <button class='btn btn-inverse-primary'>
                               <i class='far fa-edit'></i>
                               </button>
                               </a>";

                $deleteBtn ="<a class='delete-item' href='".route(Auth::user()->role.'.property-facility-item.destroy', $this->encryptId($query->id))."'>
                              <button class='btn btn-inverse-danger'>
                              <i class='far fa-trash-alt'></i>
                              </button>
                              </a>";

                return $editBtn.$deleteBtn;
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
            ->addColumn('distance', content: function ($query)  {
                return "<a><i style='color:#3BB54B' class='fa-solid fa-people-arrows fa-fade'></i> $query->distance <b>KM</b></a>";
            })
            ->addColumn('rating', content: function ($query)  {
                $noStar = '<span>
                           <i class="fa-regular fa-star"></i>
                           <i class="fa-regular fa-star"></i>
                           <i class="fa-regular fa-star"></i>
                           <i class="fa-regular fa-star"></i>
                           <i class="fa-regular fa-star"></i>
                          </span>';

                $oneStar = '<span>
                           <i style="color: #FED900;" class="fa-solid fa-star " ></i>
                          </span>';

                $oneHalfStar = '<span>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                           <i style="color: #FED900;" class="fa-solid fa-star-half-stroke "></i>
                          </span>';

                $twoStar = '<span>
                           <i style="color: #FED900;" class="fa-solid fa-star " ></i>
                            <i style="color: #FED900;" class="fa-solid fa-star " ></i>
                          </span>';

                $twoHalfStar = '<span>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                           <i style="color: #FED900;" class="fa-solid fa-star-half-stroke "></i>
                          </span>';

                $threeStar = '<span>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                          </span>';

                $threeHalfStar = '<span>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                           <i style="color: #FED900;" class="fa-solid fa-star-half-stroke "></i>
                          </span>';

                $fourStar = '<span>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                          </span>';


                $fourHalfStar = '<span>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                           <i style="color: #FED900;" class="fa-solid fa-star-half-stroke "></i>
                          </span>';

                $fiveStar = '<span>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                           <i  style="color: #FED900;" class="fa-solid fa-star "></i>
                          </span>';


                if ($query->rating == 1){

                    return $oneStar;

                }elseif ($query->rating == 1.5){

                    return $oneHalfStar;

                }elseif ($query->rating == 2){

                    return $twoStar;

                }elseif ($query->rating == 2.5){

                    return $twoHalfStar;

                }elseif ($query->rating == 3){

                    return $threeStar;

                }elseif ($query->rating == 3.5){

                    return $threeHalfStar;

                }elseif ($query->rating == 4){

                    return $fourStar;

                }elseif ($query->rating == 4.5){

                    return $fourHalfStar;

                }elseif ($query->rating == 5){

                    return $fiveStar;

                }else{

                    return $noStar;
                }

            })
            ->rawColumns(['rating', 'action', 'distance', 'status', 'num'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param PropertyFacilityItem $model
     * @return QueryBuilder
     */
    public function query(PropertyFacilityItem $model): QueryBuilder
    {
        return $model->where('property_id', $this->decryptId(request()->propertyId))
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
                    ->setTableId('propertyfacilityitem-table')
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
            Column::make('distance'),
            Column::make('rating'),
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
        return 'PropertyFacilityItem_' . date('YmdHis');
    }
}
