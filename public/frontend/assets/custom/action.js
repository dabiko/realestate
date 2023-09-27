$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function mouseover() {
    document.getElementById("list-status").style.color = "#FFFFFF";
}

function mouseout() {
    document.getElementById("list-status").style.color = "#00BB77";
}

//Add to wish list
function addToWishList(property_id){

    $.ajax({
        url: "/wishlist-add/"+property_id,
        method: 'POST',
        data: {
            id: property_id,
        },
        success: function (data){

            if(data.status === 'success'){
                wishlist();
                ToastToRight.fire({
                    icon: data.status,
                    title: data.message,
                })
            }else if(data.status === 'exist'){
                ToastToRight.fire({
                    icon: 'info',
                    title: data.message,
                })
            }
            else if(data.status === 'login'){
                Swal.fire({
                    icon: 'info',
                    title: data.message,
                    showConfirmButton: true,
                })
            }else if(data.status === 'error'){
                Swal.fire({
                    icon: 'error',
                    title: data.message,
                    showConfirmButton: true,
                })
            }

        },
        error: function (xhr, status, error){
            console.log(error);
        }

    })
}


function wishlist(){
    $.ajax({
        url: "get-wishlist",
        method: 'GET',
        success: function (response) {
            if(response.count > 0 ){

                $('#count').text(response.count);

                let rows = '';
                $.each(response.list, function (key, value){

                    rows += `
                                          <div class="deals-block-one">
                                                        <div class="inner-box">
                                                            <div class="image-box">
                                                                <figure class="image"><img src="/${value.property.thumbnail}" alt=""></figure>
                                                                <div class="batch"><i class="icon-11"></i></div>
                                                                <span class="category">${value.property.tag}</span>
                                                                <div class="buy-btn"><a href="">${value.property.purpose}</a></div>
                                                            </div>
                                                            <div class="lower-content">
                                                                <div class="title-text"><h4><a href="">${value.property.name}</a></h4></div>
                                                                <div class="price-box clearfix">
                                                                    <div class="price-info pull-left">
                                                                        <h6>Start From</h6>
                                                                        <h4>$ ${value.property.low_price}</h4>
                                                                    </div>
                                                                    <div class="author-box pull-right">
                                                                        <figure class="author-thumb">
                                                                            <img src="${value.agent.photo}" alt="">
                                                                            <span>${value.agent.name}</span>
                                                                        </figure>
                                                                    </div>
                                                                </div>
                                                                <p>${value.property.short_desc}</p>
                                                                <ul class="more-details clearfix">
                                                                    <li><i class="icon-14"></i>${value.property.beds} Beds</li>
                                                                    <li><i class="icon-15"></i>${value.property.bath} Baths</li>
                                                                    <li><i class="icon-16"></i>${value.property.size} Sq Ft</li>
                                                                </ul>
                                                                <div class="other-info-box clearfix">
                                                                    <ul class="other-option pull-right clearfix">
                                                                        <li>
                                                                              <a style="border-color: #00BB77"  type="submit" class="text-body" id="${value.id}" onclick="wishlistRemove(this.id)">
                                                                                <i style="border-color: #00BB77; color: #F0F0F0" class="fa fa-trash"></i>
                                                                              </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                          </div>`;
                })

                $('#responseWishlist').html(rows);

            }else{

                let nodata = `<div class="deals-block-one">
                                            <div colspan="100%" style="text-align: center;" class="alert alert-primary" role="alert">
                                                <i data-feather="alert-circle"></i>
                                                <strong>Your wish list is empty !!! </strong> add properties <a href="">Here</a>
                                            </div>
                                      </div>`

                $('#responseWishlist').html(nodata);
            }

        }
    })
}

wishlist();

function wishlistRemove(id){
    $.ajax({
        url: "delete-wishlist/"+id,
        method: 'DELETE',
        success: function (data) {
            if(data.status === 'success' ){
                wishlist();
                ToastToRight.fire({
                    icon: data.status,
                    title: data.message,
                })
            }else{
                ToastToRight.fire({
                    icon: 'error',
                    title: 'something went wrong..',
                })
            }
        }
    })
}


//Add to Compare page
function addToCompare(property_id){

    $.ajax({
        url: "/compare-add/"+property_id,
        method: 'POST',
        data: {
            id: property_id,
        },
        success: function (data){

            if(data.status === 'success'){
                //wishlist();
                ToastToRight.fire({
                    icon: data.status,
                    title: data.message,
                })
            }else if(data.status === 'exist'){
                ToastToRight.fire({
                    icon: 'info',
                    title: data.message,
                })
            }
            else if(data.status === 'login'){
                Swal.fire({
                    icon: 'info',
                    title: data.message,
                    showConfirmButton: true,
                })
            }else if(data.status === 'error'){
                Swal.fire({
                    icon: 'error',
                    title: data.message,
                    showConfirmButton: true,
                })
            }

        },
        error: function (xhr, status, error){
            console.log(error);
        }

    })
}


function compareRemove(id){
    $.ajax({
        url: "delete-compare/"+id,
        method: 'DELETE',
        success: function (data) {
            if(data.status === 'success' ){
                ToastToRight.fire({
                    icon: data.status,
                    title: data.message,
                    timer: 1000,
                })
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }else{
                ToastToRight.fire({
                    icon: 'error',
                    title: 'something went wrong..',
                })
            }
        }
    })
}
// function compare(){
//     $.ajax({
//         url: "get-compare",
//         method: 'GET',
//         success: function (response) {
//             if(response.count > 0 ){
//
//                 $('#count').text(response.count);
//
//                 let property_head = '';
//                 let property_location = '';
//                 let property_detail = '';
//                 let property_detail_values = '';
//                 let property_amenities = '';
//
//                 $.each(response.list, function (key, value){
//
//                     property_head += `
//                         <th>
//                             <figure class="image-box"><img src="/${value.property.thumbnail}" alt=""></figure>
//                             <div class="title">${value.property.name}</div>
//                             <div class="price">$ ${value.property.low_price}</div>
//                         </th>
//                     `;
//                 })
//
//                 $.each(response.list, function (key, value){
//
//                     property_location += `
//                         <td>
//                             <p>${value.location.value}</p>
//                         </td>
//                     `;
//                 })
//
//
//                 $('#responseCompareHead').append(property_head);
//                 $('#responseCompareLocation').append(property_location);
//
//
//             }else{
//
//                 let nodata = `<div class="deals-block-one">
//                                             <div colspan="100%" style="text-align: center;" class="alert alert-primary" role="alert">
//                                                 <i data-feather="alert-circle"></i>
//                                                 <strong>Your compare list is empty !!! </strong> add properties <a href="">Here</a>
//                                             </div>
//                                       </div>`
//
//                 $('#responseData').html(nodata);
//             }
//
//         }
//     })
// }

//compare();
