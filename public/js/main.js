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


//Máscaras
$('.cpf').mask('999.999.999-99');
$('.date').mask('99/99/9999');
$('.phone').mask('(99) 9999-9999?9');


var count = 0;


$('#add-insured').click(function(e) {

    e.preventDefault();

    count++;

    //Adicionar segurados
    var newLine = '';
    newLine += '<div class="row">';
    newLine += '    <div class="col-md-5">';
    newLine += '        <div class="form-group">';
    newLine += '            <label for="full_name-' + count + '">Nome completo</label>';
    newLine += '            <input type="text" id="full_name-' + count + '" name="full_name-' + count + '" class="form-control" placeholder="Nome do segurado" required="">';
    newLine += '        </div>';
    newLine += '    </div>';
    newLine += '    <div class="col-md-3">';
    newLine += '        <div class="form-group">';
    newLine += '            <label for="birth_date-' + count + '">Nascimento</label>';
    newLine += '            <input type="text" id="birth_date-' + count + '" name="birth_date-' + count + '" class="form-control date hasDatepicker" placeholder="Nascimento" required="">';
    newLine += '        </div>';
    newLine += '    </div>';
    newLine += '    <div class="col-md-4">';
    newLine += '        <div class="form-group">';
    newLine += '            <label for="document-' + count + '">CPF</label>';
    newLine += '            <input type="text" id="document-' + count + '" name="document-' + count + '" class="form-control cpf" placeholder="Documento do segurado" required="">';
    newLine += '        </div>';
    newLine += '    </div>';
    newLine += '</div>';
    newLine += '<hr>';

    $('#insureds-section').append($(newLine));

    $('.cpf').off();
    $('.cpf').mask('999.999.999-99');

});


$('#purchase-form').submit(function() {
    $('#document-*')
});
