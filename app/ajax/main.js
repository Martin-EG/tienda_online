$(function() {
    $('[data-toggle="tooltip"]').tooltip();


    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        startDate: '-3d'
    });

    $('.datepicker-complete').datepicker({
        format: 'yyyy-mm-dd',
    });
})



/**************************************SPARE PARTS CATEGORIES */

//add category ajax call
$(document).on('click', '#add_category', function(e) {
    e.preventDefault();
    var data = $("#form-category").serialize();


    $.ajax({
        data: data,
        type: "post",
        url: "functions/functions.php?function=add_category",
        complete: function() {
            $("#category_name").val("");
            $('#example').DataTable().ajax.reload();
        },
        success: function(data) {

            swal("Success!", "Tool Category Added!", "success");
        },
    });
});

//populate edit modal with data
$(document).on('click', '.account_info', function(e) {
    e.preventDefault();
    const category_id = $(this).data('cat-id');
    const category_name = $(this).data('cat-name');

    $("#cat-title").text(category_name);
    $("#category_id").val(category_id);
    $("#category_name_edit").val(category_name);
});




//populate edit modal with data
$(document).on('click', '.edit-cat', function(e) {
    e.preventDefault();
    const category_id = $(this).data('cat-id');
    const category_name = $(this).data('cat-name');

    $("#cat-title").text(category_name);
    $("#category_id").val(category_id);
    $("#category_name_edit").val(category_name);
});



//edit category ajax call
$(document).on('click', '#edit-category', function(e) {
    e.preventDefault();
    var data = $("#form-edit-category").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "functions/functions.php?function=edit_category",
        complete: function() {
            $("#exampleModal .close").click()
            $('#example').DataTable().ajax.reload();
            swal("Success!", "Tool Category Updated!", "success");

        }
    });
});



//populate delete modal with data
$(document).on('click', '.delete-cat', function(e) {
    e.preventDefault();
    const category_id = $(this).data('cat-id');
    const category_name = $(this).data('cat-name');


    $("#cat-title-delete").text(category_name);
    $("#cat-title-delete2").text(category_name);
    $("#category_id_delete").val(category_id);
    $("#category_name_delete").val(category_name);
});


//delete category ajax call
$(document).on('click', '#delete-category', function(e) {
    e.preventDefault();
    var data = $("#form-delete-category").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "functions/functions.php?function=delete_category",
        complete: function() {
            $("#deleteCatModal .close").click()
            $('#example').DataTable().ajax.reload();
            swal("Success!", "Tool Category Deleted!", "success");

        }
    });
});



/***********************SPARE PARTS */

$('#add_part').click(function(evt) {
    // Stop the button from submitting the form:
    evt.preventDefault();

    // Serialize the entire form:
    var data = new FormData(this.form);

    $.ajax({
        url: "functions/functions.php?function=add_part", // NB: Use the correct action name
        type: "POST",
        data: data,
        processData: false,
        contentType: false,
        success: function(response) {
            $("#addPartModal .close").click();
            $('#parts').DataTable().ajax.reload();
            $('#partsmove').DataTable().ajax.reload();
            $('#partsrecommended').DataTable().ajax.reload();
            $("#form-add-part").trigger("reset");

            //alert(response);
            swal("Success!", "Part Added!", "success");

        },
        error: function(response) {
            alert("Error");
            alert(ajaxrequest.responseText)
        }
    });
});

//populate edit modal with data
$(document).on('click', '.edit-part', function(e) {
    e.preventDefault();
    const part_id = $(this).data('part_id');
    const part_name = $(this).data('part_name');
    const part_number = $(this).data('part_number');
    const part_consumable = $(this).data('part_consumable');
    const part_stock = $(this).data('part_stock');
    const part_location = $(this).data('part_location');
    const part_category = $(this).data('part_category');
    const part_image = $(this).data('part_image');
    const min_stock = $(this).data('part_min_stock');
    const max_stock = $(this).data('part_max_stock');
    const reorder_point = $(this).data('part_reorder_point');
    const part_cost = $(this).data('part_cost');

    //alert(part_name);
    $("#part_name_edit_text").text(part_name);


    $("#part_id_edit").val(part_id);
    $("#part_name_edit").val(part_name);
    $("#part_number_edit").val(part_number);
    $("#part_consumable_edit").val(part_consumable);
    $("#part_stock_edit").val(part_stock);
    $("#part_location_edit").val(part_location);
    $("#part_category_edit").val(part_category);
    $("#part_image_edit_show").attr("src", part_image);
    $("#part_minimum_stock_edit").val(min_stock);
    $("#part_maximum_stock_edit").val(max_stock);
    $("#part_reorder_point_edit").val(reorder_point);
    $("#part_cost_edit").val(part_cost);

});

$('#edit_part').click(function(evt) {
    evt.preventDefault();

    var data = new FormData(this.form);

    alert("data" + data);

    $.ajax({
        url: "functions/functions.php?function=edit_part",
        type: "POST",
        data: data,
        processData: false,
        contentType: false,
        success: function(response) {
            $("#editPartModal .close").click();
            $('#parts').DataTable().ajax.reload();
            $('#partsmove').DataTable().ajax.reload();
            $('#partsrecommended').DataTable().ajax.reload();
            //alert("success:"+response);
            swal("Success!", "Part Updated!", "success");

        },
        error: function(response) {
            //alert("Error");
            alert("Error:" + response);
        }
    });
});

$(document).on('click', '.delete-part', function(e) {
    e.preventDefault();
    const part_id = $(this).data('part_id');
    const part_name = $(this).data('part_name');


    //alert(part_name);
    $("#part_name_delete_text").text(part_name);
    $("#part_name_delete_text2").text(part_name);
    $("#part_id_delete").val(part_id);


});

//delete category ajax call
$(document).on('click', '#delete-part', function(e) {
    e.preventDefault();
    var data = $("#form-delete-part").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "functions/functions.php?function=delete_part",
        complete: function() {
            $("#deletePartModal .close").click()
            $('#parts').DataTable().ajax.reload();
            swal("Success!", "Part Has Been Deleted!", "success");

        }
    });
});

/**********************************transactions */
//populate move modal with data
$(document).on('click', '.move-part', function(e) {
    e.preventDefault();
    const part_id = $(this).data('part_id');
    const part_name = $(this).data('part_name');
    const part_number = $(this).data('part_number');
    const part_consumable = $(this).data('part_consumable');
    const part_stock = $(this).data('part_stock');
    const part_available = $(this).data('part_available');
    const part_location = $(this).data('part_location');
    const part_category = $(this).data('part_category');
    const part_image = $(this).data('part_image');


    //alert(part_name);
    $("#part_name_move_text").text(part_name);


    $("#part_id_move").val(part_id);
    $("#part_name_move").val(part_name);
    $("#part_number_move").val(part_number);
    $("#part_consumable_move").val(part_consumable);
    $("#part_stock_move").val(part_stock);
    $("#part_available_move").val(part_available);
    $("#part_location_move").val(part_location);
    $("#part_category_move").val(part_category);
    $("#part_image_move_show").attr("src", part_image);

});

$(document).on('click', '.add-part', function(e) {
    e.preventDefault();


    var selected_id = $(this).data('part_id');
    var selected_pnumber = $(this).data('part_number');
    var selected_pname = $(this).data('part_name');
    var selected_available = $(this).data('part_available');

    

    //let sel = document.querySelector("#contador");
    //let cantidadsel = parseInt(sel.value) + 1;
    
    let sel = document.querySelectorAll(".selector");
    var cantidadsel = sel.length+1;

    

    alert(cantidadsel);

    $("#contador").val(cantidadsel);

    if ($(`#qty_${selected_id}`).length != 0) {
        //alert("This item already exists on you list");
        swal("Information", "This item already exists on you list", "info");
        $("#contador").val(cantidadsel - 1);

    } else {
        const div = `<div class="form-group row selector">
                         <label class="col-sm-1 col-form-label">${selected_pnumber}</label>
                         <div class="col-sm-2">
                              <input  class="form-control form-control-sm inventory" type="number" data-max="${selected_available}" max="${selected_available}" id="qty_${selected_id}" name="i_${cantidadsel}">
                         </div>
                         <a href="#" class="remove" data-remove ="qty_${selected_id}" id="qty_${selected_id}">
                              <i class="far fa-trash-alt"></i>
                         </a>
                         <input  class="form-control form-control-sm" type="hidden" id="qty_${selected_id}" name="item_${cantidadsel}" value="${selected_id}" >
                       </div>`;
        $('#list').append(div);
    }
});

$(document).on('click', '.remove', function(e) {
    e.target.parentElement.parentElement.remove();
});

$(document).on('change', '.inventory', function(e) {

    var max = $(this).data('max');
    var inventory = $(this).val()


    if (inventory > max) {
        swal("Error!", "Max inventory of " + max + " exceeded", "error");
        //alert("Max inventory of "+max+" exceeded");
        $(this).val(parseFloat(max));
    }

});

$(document).on('click', '#move-part-to', function(e) {
    e.preventDefault();

    var data = $("#form_move_part").serialize();
    var responsable = $('#responsable').val();
    if (responsable) {
        $.ajax({

            data: data,
            type: "post",
            url: "functions/functions.php?function=move_part",
            complete: function(response) {
                $("#moveNewPartModal .close").click()
                $('#parts').DataTable().ajax.reload();
                $('#partsmove').DataTable().ajax.reload();
                $("#form_move_part").trigger("reset");
                $("#list").empty();

                //alert("success:"+response);
                swal("Success", "A receipt for this transaction has been generated.", "success");

            }
        }).done(function(response) {
            console.log($(this));
        }).fail(function() {
            console.log('Failed');
        });
    } else {
        swal("Error!", "All fields must be filled", "error");
        //alert("All fields must be filled");
    }
});



/********************************Recommended parts */
$(document).on('click', '.add-recommend-part', function(e) {
    e.preventDefault();

    let selected_id = $(this).data('part_id');
    let selected_pnumber = $(this).data('part_number');
    let selected_pname = $(this).data('part_name');

    //let sel = document.querySelectorAll(".selector_recommended");
    //let cantidadsel = sel.length + 1;

    let sel = document.querySelector("#contador_parts_recommended");
    let cantidadsel = parseInt(sel.value) + 1;



    $("#contador_parts_recommended").val(cantidadsel);

    if ($(`#qty_r${selected_id}`).length != 0) {
        //alert("This item already exists on you list");
        swal("Information", "This item already exists on you list", "info");
        $("#contador_parts_recommended").val(cantidadsel - 1);

    } else {
        const div = `<div class="form-group row selector_recommended">
                         <label class="col-sm-1 col-form-label">${selected_pnumber}</label>
                         <a href="#" class="remove_recommended_part" data-remove ="qty_r${selected_id}" id="qty_r${selected_id}">
                              <i class="far fa-trash-alt"></i>
                         </a>
                         <input  class="form-control form-control-sm" type="hidden" id="qty_r${selected_id}" name="item_${cantidadsel}" value="${selected_id}" >
                       </div>`;
        $('#list_recommend').append(div);
    }
});

$(document).on('click', '.remove_recommended_part', function(e) {
    e.target.parentElement.parentElement.remove();
});

$(document).on('click', '#add-recommended-parts', function(e) {
    e.preventDefault();

    var data = $("#form_part_recomended").serialize();
    $.ajax({

        data: data,
        type: "post",
        url: "functions/functions.php?function=add_recommended_parts",
        complete: function(response) {
            $("#partsRecommendedModal .close").click()
            $('#parts').DataTable().ajax.reload();
            $('#partsmove').DataTable().ajax.reload();
            $('#partsrecommended').DataTable().ajax.reload();
            $("#form_part_recomended").trigger("reset");
            $("#list_recommend").empty();

            //alert("success:"+response);
            swal("Success", "The parts recommended for this manteinance have been saved.", "success");

        }
    }).done(function(response) {
        console.log($(this));
        console.log(response);
    }).fail(function() {
        console.log('Failed');
    });
});
//Machines

//add category ajax call
$(document).on('click', '#add_machine_category', function(e) {
    e.preventDefault();
    var data = $("#form-machine-category").serialize();

    $.ajax({
        data: data,
        type: "post",
        url: "functions/functions.php?function=add_machine_category",
        success: function(data) {
            $("#machine_category_name").val("");
            $('#machine-cat').DataTable().ajax.reload();
            //alert(data);
            swal("Success!", "Machine Category Added!", "success");
        },
        error: function(data) {
            console.log(data);
        }
    })
});

$(document).on('click', '#add_supplier', function(e) {
    e.preventDefault();
    var data = $("#form-supplier").serialize();

    $.ajax({
        data: data,
        type: "post",
        url: "functions/functions.php?function=add_supplier",
        success: function(data) {
            //$("#machine_category_name").val(""); 
            $('#suppliers').DataTable().ajax.reload();
            swal("Success!", "Supplier Added!", "success");
        },
        error: function(data) {
            console.log(data);
        }
    })
});




$('#add_machine').click(function(evt){
     // Stop the button from submitting the form:
     evt.preventDefault();
     // Serialize the entire form:
     var data = new FormData(this.form);
     
     $.ajax({
         url: "functions/functions.php?function=add_machine", // NB: Use the correct action name
         type: "POST",
         data: data,
         processData: false,
         contentType: false,
         success: function(response) {
          //$("#addPartModal .close").click();
          $('#machines').DataTable().ajax.reload();
          swal("Success!", "Machine Added!", "success");
          $("#addMachineModal .close").click();

         },
         error: function(response) {
          alert("Error");
          alert(ajaxrequest.responseText)
          //console.log(ajaxrequest.responseText);
         }
     });
 });


 $('#edit_profile').click(function(evt){
    // Stop the button from submitting the form:
    alert("click");
    evt.preventDefault();
    // Serialize the entire form:
    var data = new FormData(this.form);
    
    $.ajax({
        url: "functions/functions.php?function=edit_profile", // NB: Use the correct action name
        type: "POST",
        data: data,
        processData: false,
        contentType: false,
        success: function(response) {
            if (data.success){
                $("#profile-data").load(" #profile-data");
                 }
         swal("Success!", "Profile Updated!", "success");

        },
        error: function(response) {
         alert("Error");
         alert(ajaxrequest.responseText)
         //console.log(ajaxrequest.responseText);
        }
    });
});



 //populate edit modal with data
$(document).on('click','.respond-corrective',function(e) {
     e.preventDefault();
     const error   = $(this).data('error');
     const machine = $(this).data('machine');
     const id      = $(this).data('id');
     

     $("#error_respond").text(error);
     $("#machine_respond").text(machine);
     $("#corrective_id").val(id);
     //$("#category_name_edit").val(category_name);
});
