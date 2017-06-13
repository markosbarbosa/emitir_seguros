//Função para formatar valores monetários
Number.prototype.formatMoney = function(c, d, t){
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
        j = (j = i.length) > 3 ? j % 3 : 0;
       return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };


//Formata data de destino
var current_date = new Date();
current_date.setDate(current_date.getDate() + 1);

$( ".date-destination" ).datepicker({
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
$('.date-destination').mask('99/99/9999');
$('.phone').mask('(99) 9999-9999?9');


var count = 0;


$('#add-insured').click(function(e) {

    e.preventDefault();

    count++;

    //Adicionar segurados
    var newLine = '';
    newLine += '<div class="insured-row">';
    newLine += ' <div class="row">';
    newLine += '    <div class="col-md-5">';
    newLine += '        <div class="form-group">';
    newLine += '            <label for="full_name-' + count + '">Nome completo</label>';
    newLine += '            <input type="text" id="full_name-' + count + '" name="full_name-' + count + '" class="form-control" placeholder="Nome do segurado" required="">';
    newLine += '        </div>';
    newLine += '    </div>';
    newLine += '    <div class="col-md-2">';
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
    newLine += '    <div class="col-md-1">';
    newLine += '        <a href="#" class="remove-insured" style="line-height: 74px;">';
    newLine += '            <span class="glyphicon glyphicon-minus-sign" aria-hidden="true" style="color: #c16363;"></span>';
    newLine += '        </a>';
    newLine += '    </div>';
    newLine += '</div>';
    newLine += '<hr>';
    newLine += '</div>';

    $('#insureds-section').append($(newLine));

    $('.cpf').off();
    $('.cpf').mask('999.999.999-99');
    $('.date').off();
    $('.date').mask('99/99/9999');

    $('.remove-insured').off();

    //Remove um segurado
    $('.remove-insured').click(function(e) {
        e.preventDefault();
        $(this).parents('.insured-row').remove();


        //Calcula totais ao remover segurado
        var price_day = $('#price_day').val();
        var price_adult = $('#price_adult').val();

        var total_day = $('#total_day').html();
        total_day = total_day.replace('.', '');
        total_day = total_day.replace(',', '.');

        var total = $('#total').html();
        total = total.replace('.', '');
        total = total.replace(',', '.');


        total_day = (total_day - price_day);
        total = (total - price_adult);

        $('#total_day').html(total_day.formatMoney(2, ',', '.'));
        $('#total').html(total.formatMoney(2, ',', '.'));

    });


    //Calcula totais por segurado
    var insureds_count = $('.insured-row').length;
    var price_day = $('#price_day').val();
    var price_adult = $('#price_adult').val();

    var price_total_day = (price_day * insureds_count);
    var price_total = (price_adult * insureds_count);

    $('#total_day').html(price_total_day.formatMoney(2, ',', ''));
    $('#total').html(price_total.formatMoney(2, ',', '.'));

});


$('#purchase-form').submit(function() {

    //Valida número do cartão de crédito
    var creditcard_number = $.payment.validateCardNumber($('#creditcard_number').val());

    if (!creditcard_number) {
      alert('Número do cartão de crédito inválido!');
      $('creditcard_number').focus()
      return false;
    }

    var erroCPF = false;

    //Valida CPF
    $('.cpf').each(function() {

        if(!validarCPF($(this).val())) {
            alert('CPF inválido');
            $(this).focus();
            erroCPF = true;
            return false;
        }

    });

    if(erroCPF) {
        return false;
    }

});
