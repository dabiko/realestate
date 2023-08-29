// Delete Action
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.delete-item', function (event){
        event.preventDefault();

        let deleteUrl = $(this).attr('href');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-inverse-success',
                cancelButton: 'btn btn-inverse-danger'
            },
            buttonsStyling: true
        })


        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: 'DELETE',
                    url: deleteUrl,
                    success: function (data) {
                        if(data.status === 'success'){
                            Swal.fire({
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: true,
                                timer: 3000,
                            })

                            window.setTimeout(function(){
                                location.reload();
                            } ,3000);

                        }else if(data.status === 'error'){
                            Swal.fire({
                                icon: 'error',
                                title: data.title,
                                text: data.message,
                                showConfirmButton: true,
                            })
                        }
                        // console.log(data);
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                })

            }
        })

    })
})
