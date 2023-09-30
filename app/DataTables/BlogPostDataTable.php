<?php

namespace App\DataTables;

use App\Models\BlogPost;
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

class BlogPostDataTable extends DataTable
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

                $viewBtn ="<a data-bs-toggle='modal' data-bs-target='#exampleModal-".$query->id."'  class='view-property'>
                              <button class='btn btn-inverse-info'>
                              <i class='far fa-eye'></i>
                              </button>
                              </a>";

                $editBtn ="<a href='".route('admin.blog-post.edit', $this->encryptId($query->id))."'>
                               <button class='btn btn-inverse-primary'>
                               <i class='far fa-edit'></i>
                               </button>
                               </a>";

                $deleteBtn ="<a class='delete-item' href='".route('admin.blog-post.destroy', $this->encryptId($query->id))."'>
                              <button class='btn btn-inverse-danger'>
                              <i class='far fa-trash-alt'></i>
                              </button>
                              </a>";



                return $viewBtn.$editBtn.$deleteBtn;
            })
            ->addColumn('image', function ($query){

                if ($query->status === 1){

                    $status   = '<bubtton  disabled class="btn btn-inverse-success">
                                <i class="fa-solid fa-person-circle-check fa-beat-fade"></i>
                                Activated
                               </bubtton>';
                }else{

                    $status   = '<bubtton  disabled class="btn btn-inverse-warning">
                              <i class="fas fa-clock fa-spin"></i>
                                Pending
                               </bubtton>';
                }

                $created_on = Carbon::parse($query->created_at)->diffForHumans();
                $updated_on = Carbon::parse($query->updated_at)->diffForHumans();

                return "
                        <h6 class='mb-2' style='text-align: justify'>".$query->title."</h6>
                       <a data-bs-toggle='modal' data-bs-target='#exampleModal-".$query->id."'>
                       <img class='mb-2' style='border-radius: 2px; width:30%; height:30%;'  src='".asset($query->image)."' alt='image'></img>
                        <h6 class='mb-2' style='text-align: justify'>".$query->category->name."</h6>
                       </a>

                       <div class='modal fade' id='exampleModal-".$query->id."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                              <div class='modal-dialog-centered modal-dialog modal-lg'>
                                <div class='modal-content'>
                                  <div class='modal-header'>
                                    <h5 class='modal-title' id='exampleModalLabel-".$query->id."'>$query->title &ensp; </h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='btn-close'></button>
                                  </div>
                                  <div class='modal-body'>
                                    <img class='mb-3' style='border-radius: 2px; width:100%; height:100%;' src='".asset($query->image)."'  alt='property image'/>
                                               <div class='row form-group mb-3'>
                                                  <div class='col-md-3'>
                                                      $status
                                                   </div>
                                                   <div class='col-md-3'>
                                                       <label for='recipient-name' class='form-label'>Created By</label>
                                                        <input  value='".$query->user->name."' disabled type='text' class='form-control' name='low_price' id='low_price' value='".$query->tags."'>
                                                   </div>
                                                    <div class='col-md-3'>
                                                       <label for='recipient-name' class='form-label'>Created:".$query->created_at->format( 'D-d-M-Y')."</label>
                                                        <input value='".$created_on."' disabled type='text' class='form-control' name='low_price' id='low_price' value='".$query->tags."'>
                                                   </div>
                                                   <div class='col-md-3'>
                                                       <label for='recipient-name' class='form-label'>Updated:".$query->updated_at->format( 'D-d-M-Y')."</label>
                                                        <input value='".$updated_on."' disabled type='text' class='form-control' name='low_price' id='low_price' value='".$query->tags."'>
                                                   </div>
                                               </div>

                                                <div class='row form-group mb-3'>
                                                        <label for='recipient-name' class='form-label'>Short Description</label>
                                                        <textarea  disabled class='form-control' name='low_price' id='low_price'>
                                                        $query->short_desc
                                                      </textarea>
                                                 </div>
                                                  <div class='row form-group mb-3'>
                                                        <label for='recipient-name' class='form-label'>Long Description</label>
                                                        <textarea maxlength='100' rows='8' disabled id='tinymceExample' class='form-control' name='low_price' id='low_price'>
                                                        $query->long_desc
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

                    return    '
                            <div class="form-check form-switch">
                                 <input
                                 class="form-check-input change-status"
                                 type="checkbox"
                                 data-id="'.$this->encryptId($query->id).'"
                                 id="inActiveChecked">
                             </div>';
                }
            })

                ->addColumn('tags', function ($query){
                    return '<button class="btn btn-inverse-primary">'.$query->tags.'</button';
                })

            ->addColumn('num', function ($query){
                return '<button class="btn btn-inverse-info">'.$query->id.'</button';
            })

            ->rawColumns(['num', 'image', 'action', 'status', 'tags'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param BlogPost $model
     * @return QueryBuilder
     */
    public function query(BlogPost $model): QueryBuilder
    {
        return $model->with(['category','user'])->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return HtmlBuilder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('blogpost-table')
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
            Column::make('tags'),
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
        return 'BlogPost_' . date('YmdHis');
    }
}
