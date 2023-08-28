<?php

namespace App\DataTables;

use App\Models\Property;
use App\Traits\EncryptDecrypt;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PropertyDataTable extends DataTable
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
                $viewBtn ="<a  class='view-property' href='".route('admin.property.show', $this->encryptId($query->id))."'>
                              <button class='btn btn-inverse-info'>
                              <i class='far fa-eye'></i>
                              </button>
                              </a>";

                $editBtn ="<a href='".route('admin.property.edit', $this->encryptId($query->id))."'>
                               <button class='btn btn-inverse-primary'>
                               <i class='far fa-edit'></i>
                               </button>
                               </a>";

                $deleteBtn ="<a class='delete-item' href='".route('admin.property.destroy', $this->encryptId($query->id))."'>
                              <button class='btn btn-inverse-danger'>
                              <i class='far fa-trash-alt'></i>
                              </button>
                              </a>";

                $btnOptions = '<bubtton class="btn btn-inverse-success dropdown-toggle"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-feather="chevron-down">
                                 <i class="fas fa-cog"></i>
                               </bubtton>
                               <div class="dropdown-menu">
                                <a class="dropdown-item" href=""> <i class="fas fa-cog"></i> Gallery</a>
                                <a class="dropdown-item" href=""> <i class="fas fa-cog"></i> Variants</a>
                               </div>';

                return $viewBtn.$editBtn.$deleteBtn.$btnOptions;
            })
            ->addColumn('image', function ($query){
                return "<img style='border-radius: 2px; width:50%; height:50%;'  src='".asset($query->thumbnail)."' alt='image'></img>";
            })
            ->addColumn('video', function ($query){
                $video_link = $query->video_link;
                if (!empty($video_link)){
                    return '<bubtton class="btn btn-inverse-danger">
                                 <i class="fa-brands fa-youtube fa-lg"></i>
                               </bubtton>';
                }else{
                    return '<bubtton  disabled class="btn btn-inverse-secondary">
                                <i class="fa-brands fa-youtube fa-lg"></i>
                               </bubtton>';
                }
            })
            ->addColumn('purpose', function ($query){
                return match ($query->purpose) {
                    'buy' => '<i class="btn btn-inverse-success">Buy</i>',
                    'sale' => '<i class="btn btn-inverse-primary">Sale</i>',
                    'rent' => '<i class="btn btn-inverse-info">Rent</i>',
                    default => '<i class="btn btn-inverse-warning">None</i>',
                };
            })

            ->addColumn('tag', function ($query){
                return match ($query->tag) {
                    'hot' => '<i class="btn btn-inverse-success">Hot</i>',
                    'featured' => '<i class="btn btn-inverse-warning">Featured</i>',
                    default => '<i class="btn btn-inverse-warning">None</i>',
                };
            })
            ->addColumn('is approved', function ($query){
                $approved   = '<bubtton  disabled class="btn btn-inverse-success">
                                <i class="fa-solid fa-square-check"></i>
                                Pending
                               </bubtton>';

                $pending   = '<bubtton  disabled class="btn btn-inverse-warning">
                              <i class="fas fa-clock"></i>
                                Pending
                               </bubtton>';

                if ($query->is_approved == 1){
                    return $approved;
                }else{
                    return $pending;
                }

            })
            ->addColumn('status', function ($query){
                $active   = '<div class="form-check form-switch">
                                 <input
                                 class="form-check-input change-status"
                                 type="checkbox" id="activeChecked"
                                 data-id="'.$query->id.'"
                                 checked>
                             </div>';

                $InActive   = '<div class="form-check form-switch">
                                 <input
                                 class="form-check-input change-status"
                                 type="checkbox"
                                 data-id="'.$query->id.'"
                                 id="inActiveChecked">
                             </div>';

                if ($query->status == 1){
                    return $active;
                }else{
                    return $InActive;
                }

            })
            ->addColumn('code', content: function ($query)  {
                return "<a><button type='button' class='btn btn-inverse-info'>$query->code</button></a>";
            })
            ->rawColumns(['image', 'action', 'status', 'purpose', 'tag', 'code', 'video', 'is approved'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param Property $model
     * @return QueryBuilder
     */
    public function query(Property $model): QueryBuilder
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
                    ->setTableId('property-table')
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
            Column::make('code')->width(100),
            Column::make('name')->width(200),
            Column::make('image'),
            Column::make('video'),
            Column::make('low_price'),
            Column::make('max_price'),
            Column::make('purpose'),
            Column::make('is approved'),
            Column::make('tag'),
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
        return 'Property_' . date('YmdHis');
    }
}
