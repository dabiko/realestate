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
use Carbon\Carbon;


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

                $viewBtn ="<a data-bs-toggle='modal' data-bs-target='#exampleModal-".$query->id."'  class='view-property'>
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

                $btnOptions = '

                                    <bubtton class="btn btn-inverse-success dropdown-toggle"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-feather="chevron-down">
                                    <i class="fa-solid fa-gear fa-spin"></i>
                                   </bubtton>

                               <div class="dropdown-menu">
                                <a class="dropdown-item" href="'.route('admin.property-gallery-index', ['property' => $this->encryptId($query->id)]).'"><i style="color:#0b6ce1;" class="fa-solid fa-image"></i></i> Gallery</a>
                                <a class="dropdown-item" href="'.route('admin.property-variant-index', ['property' => $this->encryptId($query->id)]).'"> <i style="color:#0b6ce1;" class="fa-solid fa-circle-info"></i> Variants</a>
                                <a class="dropdown-item" href="'.route('admin.property-stats-index', ['property' => $this->encryptId($query->id)]).'"> <i style="color:#0b6ce1;" class="fa-solid fa-chart-line"></i> Stattistics</a>
                               </div>';

                return $viewBtn.$editBtn.$deleteBtn.$btnOptions;
            })
            ->addColumn('image', function ($query){

                if ($query->is_approved === 1){

                    $approval   = '<bubtton  disabled class="btn btn-inverse-success">
                                <i class="fa-solid fa-person-circle-check fa-beat-fade"></i>
                                Yes
                               </bubtton>';
                }else{

                    $approval   = '<bubtton  disabled class="btn btn-inverse-warning">
                              <i class="fas fa-clock fa-spin"></i>
                                Pending
                               </bubtton>';
                }


                if ($query->tag == 'featured'){

                    $tag   = '<i class="btn btn-inverse-warning">Featured</i>';
                }else{

                    $tag   = '<i class="btn btn-inverse-success">Hot</i>';
                }

                if ($query->purpose == 'buy'){

                    $purpose   = '<i class="btn btn-inverse-success">Buy</i>';
                }elseif($query->purpose == 'sale'){

                    $purpose   = '<i class="btn btn-inverse-primary">Sale</i>';
                }else{

                    $purpose   = '<i class="btn btn-inverse-info">Rent</i>';
                }

                if ($query->is_approved === 1){

                    $approved   = '
                                 <label class="form-label">Suspend Project</label>
                                <div class="form-check form-switch">
                                 <input
                                 class="form-check-input change-status"
                                 type="checkbox" id="activeChecked"
                                 data-id="'.$this->encryptId($query->id).'"
                                 checked>
                             </div>';
                }else{

                    $approved   = '
                            <label class="form-label">Activate Project</label>
                            <div class="form-check form-switch">
                                 <input
                                 class="form-check-input change-status"
                                 type="checkbox"
                                 data-id="'.$this->encryptId($query->id).'"
                                 id="inActiveChecked">
                             </div>';
                }

                $created_on = Carbon::parse($query->created_at)->diffForHumans();
                $updated_on = Carbon::parse($query->updated_at)->diffForHumans();

                return "
                       <a data-bs-toggle='modal' data-bs-target='#exampleModal-".$query->id."'>
                       <img class='mb-2' style='border-radius: 2px; width:50%; height:50%;'  src='".asset($query->thumbnail)."' alt='image'></img>
                        <h6>$query->name</h6>
                       </a>

                       <div class='modal fade' id='exampleModal-".$query->id."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                              <div class='modal-dialog-centered modal-dialog modal-lg'>
                                <div class='modal-content'>
                                  <div class='modal-header'>
                                    <h5 class='modal-title' id='exampleModalLabel-".$query->id."'>$query->name $approval $tag $purpose  </h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='btn-close'></button>
                                  </div>
                                  <div class='modal-body'>
                                    <img class='mb-3' style='border-radius: 2px; width:100%; height:100%;' src='".asset($query->thumbnail)."'  alt='property image'/>
                                               <div class='row form-group mb-3'>
                                                  <div class='col-md-3'>
                                                      $approved
                                                   </div>
                                                   <div class='col-md-3'>
                                                       <label for='recipient-name' class='form-label'>Created By</label>
                                                        <input  value='".$query->user->name."' disabled type='text' class='form-control' name='low_price' id='low_price' value='".$query->tag."'>
                                                   </div>
                                                    <div class='col-md-3'>
                                                       <label for='recipient-name' class='form-label'>Created:".$query->created_at->format( 'D-d-M-Y')."</label>
                                                        <input value='".$created_on."' disabled type='text' class='form-control' name='low_price' id='low_price' value='".$query->tag."'>
                                                   </div>
                                                   <div class='col-md-3'>
                                                       <label for='recipient-name' class='form-label'>Updated:".$query->updated_at->format( 'D-d-M-Y')."</label>
                                                        <input value='".$updated_on."' disabled type='text' class='form-control' name='low_price' id='low_price' value='".$query->tag."'>
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
            ->addColumn('video', function ($query){
                $video_link = $query->video_link;
                if (!empty($video_link)){
                    return '<a data-bs-toggle="modal" data-bs-target="#videoModal-'.$query->id.'" href="'.$query->video_link.'" class="btn btn-inverse-danger">
                                 <i class="fa-brands fa-youtube fa-lg"></i>
                               </a>

                                     <div class="modal fade" id="videoModal-'.$query->id.'" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
                                      <div class="modal-dialog-centered modal-dialog  modal-lg">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="videoModalLabel">'.$query->name.'</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                          </div>
                                          <div class="modal-body">
                                              <iframe  width="100%" height="100%"
                                                 src="'.$query->video_link.'" allowfullscreen>
                                              </iframe>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-inverse-secondary" data-bs-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>';
                }else{
                    return '<a  disabled class="btn btn-inverse-secondary no_video">
                                <i class="fa-brands fa-youtube fa-lg"></i>
                               </bubtton>';
                }
            })

            ->addColumn('is approved', function ($query){
                $approved   = '<bubtton
                                  class="btn btn-inverse-success approve-project"
                                  data-id="'.$this->encryptId($query->id).'"
                                  >
                               <i class="fa-solid fa-person-circle-check fa-beat-fade"></i>
                                Yes
                               </bubtton>';

                $pending   = '<bubtton
                                  class="btn btn-inverse-warning approve-project"
                                  data-id="'.$this->encryptId($query->id).'"
                                  >
                                <i class="fas fa-clock fa-spin"></i>
                                Pending
                               </bubtton>';

                if ($query->is_approved === 1){
                    return $approved;
                }else{
                    return $pending;
                }

            })
            ->addColumn('status', function ($query){
                if ($query->is_approved === 1){

                    return    '
                                 <label class="form-label">Suspend</label>
                                <div class="form-check form-switch">
                                 <input
                                 class="form-check-input change-status"
                                 type="checkbox" id="activeChecked"
                                 data-id="'.$this->encryptId($query->id).'"
                                 checked>
                             </div>';
                }else{

                    return    '
                            <label class="form-label">Activate</label>
                            <div class="form-check form-switch">
                                 <input
                                 class="form-check-input change-status"
                                 type="checkbox"
                                 data-id="'.$this->encryptId($query->id).'"
                                 id="inActiveChecked">
                             </div>';
                }
            })
            ->addColumn('code', function ($query)  {
                return "<a>
                        <button type='button' class='mb-2 btn btn-inverse-info'>$query->code</button>
                         <h6 style='text-align: justify'>".$query->category->name."</h6>
                        </a>";
            })
            ->addColumn('low price', function ($query)  {
                return '<i style="color: #FF3366" class="fa-solid fa-arrow-down-long fa-beat-fade"></i> '.$query->low_price;
            })
            ->addColumn('max price', function ($query)  {
                return '<i style="color: #05A34A" class="fa-solid fa-arrow-up-long fa-beat-fade"></i> '.$query->max_price;
            })
            ->addColumn('category', function ($query)  {
                return $query->category->name;
            })
            ->rawColumns(['image', 'action', 'status', 'purpose', 'max price', 'low price', 'code', 'video', 'is approved'])
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
            Column::make('code')->width(50),
            Column::make('image')->width(100),
            Column::make('video')->width(20),
            Column::make('low price')->width(20),
            Column::make('max price')->width(20),
            Column::make('is approved')->width(20),
//            Column::make('status')->width(10),
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
