var current_date = new Date();
current_date.setDate(current_date.getDate() + 1);

$( ".date" ).datepicker({
    inline: true,
    minDate: current_date
});

//Monta url para enviar para página de cotação
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

    window.location = '/produtos/' + params.join('/');

});

//Formatar número do cartão de crédito
$('.card-number').payment('formatCardNumber');

//Capturar a bandeira do cartão pelo número
$('#creditcard_number').blur(function() {
    var brand = $.payment.cardType(this.value);
    $('#purchase-form #brand_name').val(brand == 'dinersclub' ? 'diners' : brand);
});


$('#begin_date').change(function() {
    $('#end_date').val(this.value);
});
