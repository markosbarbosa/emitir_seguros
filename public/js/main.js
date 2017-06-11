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

        //Provavelmente existe outra forma de fazer isso,
        //mas eu não conheço uma forma de gerar a url amigável a partir do formulário
        var params = ['pesquisa'];

        params.push($('#destination').val());
        params.push($.datepicker.formatDate('yy-mm-dd', $('#begin_date').datepicker('getDate')));
        params.push($.datepicker.formatDate('yy-mm-dd', $('#end_date').datepicker('getDate')));

        window.location = '/products/' + params.join('/');

    });


})
