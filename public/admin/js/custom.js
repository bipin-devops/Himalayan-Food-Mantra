// Danger
$(".control-danger").uniform({
    radioClass: 'choice',
    wrapperClass: 'border-danger-600 text-danger-800'
});

$(document).ready(function () {
    //check all
    $('#checkAll').checkAll();
    $.each($(".btnStatus"), function (i, v) {

        $(v).on("click", function (e) {

            e.preventDefault();

            var Status = $(this).data('status');
            var Id = $(this).data('id');
            var Url = $(this).data('url');

            swal({

                title: 'Are you sure?',
                text: "Change Status",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'

            }, function (isConfirm) {

                if (isConfirm) {
                    $.ajax({

                        type: "GET",
                        url: Url,
                        data: {status: Status, id: Id},
                        success: function (dt) {

                            if (dt) {
                                $(v).html(dt.tgle);
                            }

                        },
                        error: function (err) {

                            swal('Error', "Oops something went wrong! " + err);

                        }

                    });// Ajax

                }
            });
        });// Status
    });

});


function confirmAndSubmit(Url) {

    swal({

        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'

    }, function (isConfirm) {

        if (isConfirm) {
            window.location = Url;
        } else {
            // console.log("Cancelled");
        }
    });

}

function confirmAndSubmitForm() {

    swal({

        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete !'

    }, function (isConfirm) {

        if (isConfirm) {

            $("#formDelete").submit();

        }
    });
}

/*
 |----------------------------------------------------------------------
 | Confirm to remove image from file browser
 |----------------------------------------------------------------------
 |
 */

function confirmFirst(field_id) {

    swal({

        title: "Are you sure?",
        text: "You will not be able to recover this imaginary data!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false

    }, function (isConfirm) {

        if (isConfirm) {

            if (field_id) {
                clearImg(field_id);
            }
            swal({
                title: "Successfully deleted",
                animation: "slide-from-top",
                type: "success",
                timer: 1200,
                showConfirmButton: false
            });

        } else {

            swal({
                animation: "slide-from-top",
                title: "Data deletion cancelled",
                type: 'warning',
                timer: 1200,
                showConfirmButton: false

            });
        }
    });
}

/*
 |----------------------------------------------------------------------
 | Filemanager popup box
 |----------------------------------------------------------------------
 |
 */
//
// $('.standAloneFacnyBox').fancybox({
//     'width': 900,
//     'height': 600,
//     'type': 'iframe',
//     'autoScale': true,
//     'padding': 0,
//     'openEffect': 'elastic',//fade
//     'closeEffect': 'elastic',
//     'openSpeed': 'fast',
//     'closeSpeed': 'fast'//slow
// });

function responsive_filemanager_callback(field_id) {

    var image = $('#' + field_id).val();
    $('#' + field_id).attr('src', image);
    $('#h' + field_id).val(image);
}

function clearImg(field_id) {

    var noImg = '/admin/images/no_img.png';
    $('#' + field_id).attr('src', noImg);
    $('#h' + field_id).val('');
}

/*
 |----------------------------------------------------------------------
 | Product Brochure
 |----------------------------------------------------------------------
 |
 */

// $('.standAloneFacnyBoxBrochure').fancybox({
//     'width': 900,
//     'height': 600,
//     'type': 'iframe',
//     'autoScale': true,
//     'padding': 0,
//     'openEffect': 'elastic',//fade
//     'closeEffect': 'elastic',
//     'openSpeed': 'fast',
//     'closeSpeed': 'fast'//slow
// });

// Warning
$(".control-warning").uniform({
    radioClass: 'choice',
    wrapperClass: 'border-warning-600 text-warning-800'
});

function readURL(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#' + id)
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}


$('#title').on('change', function () {
    Title = $(this).val();
    Title = slugify(Title);
    $("#slug").val(Title);
})


function slugify(string) {
    return string
        .toString()
        .trim()
        .toLowerCase()
        .replace(/\s+/g, "-")
        .replace(/[^\w\-]+/g, "")
        .replace(/\-\-+/g, "-")
        .replace(/^-+/, "")
        .replace(/-+$/, "");
}


$('.datepicker').pickadate({
    format: 'yyyy-mm-dd',
    closeOnSelect: true,
    today: 'Today',
    closeOnClear: true,
    min: new Date()-1,


});

$('.datepicker1').pickadate({
    format: 'yyyy-mm-dd',
    closeOnSelect: true,
    today: 'Today',
    closeOnClear: true



});
$('.timepicker').pickatime({
    format: 'h:i A',
    interval: 30,
    closeOnSelect: true
});

