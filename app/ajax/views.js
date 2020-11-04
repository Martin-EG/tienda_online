//populate edit modal with data
$(document).on('click','.view-image',function(e) {
    e.preventDefault();
    const src   = $(this).data('image');
    console.log(src);
    $("#image_show").attr("src",src);

});


//populate edit modal with data
$(document).on('click','.view_image_machine',function(e) {
    e.preventDefault();
    const src   = $(this).data('image_machine');
    //alert("src"+src)
    $("#image_show_machine").attr("src",src);

});
