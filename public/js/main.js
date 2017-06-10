var current_date = new Date();
current_date.setDate(current_date.getDate() + 1);

$( ".date" ).datepicker({
    inline: true,
    minDate: current_date
});

$(function() {

    $('#search_products').submit(function(e) {

        e.preventDefault();


        var dataSearch = {
            destination: $('#destination').val(),
            begin_date: $.datepicker.formatDate('yy-mm-dd', $('#begin_date').datepicker('getDate')),
            end_date: $.datepicker.formatDate('yy-mm-dd', $('#begin_date').datepicker('getDate')),
            name: $('#name').val(),
            email: $('#email').val(),
            cellphone: $('#cellphone').val()
        };


        $.ajax({
            url: '/quotation',
            dataType: 'json',
            data: dataSearch,
            success: function(response) {
                // console.log();
            }
        });

    });


})
