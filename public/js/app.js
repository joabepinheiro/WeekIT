function mensagem(texto, status){
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    };

    if(status == 'success'){
        toastr.success(texto);
    }

    if(status == 'error'){
        toastr.error(texto);
    }
    
}

jQuery(document).ready(function() {
    $('.calendario_datepicker').datepicker({
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior',
        dateFormat: 'DD/MM/YYYY',
        todayHighlight: true,
        orientation: "bottom left",
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    });

    $('.calendario_daterangepicker').daterangepicker({
        "locale": {
            "format": "MM/DD/YYYY",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Limpar",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "Personalizar",
            "daysOfWeek": [
                "Dom.",
                "Seg.",
                "Terç.",
                "Qua.",
                "Qui.",
                "Sex.",
                "Sáb."
            ],
            "monthNames": [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outrubro",
                "Novembro",
                "Dezembro"
            ],
            "firstDay": 1
        },
        buttonClasses: 'm-btn btn',
        applyClass: 'btn-primary',
        cancelClass: 'btn-secondary'
    }, function(start, end, label) {
        $('.calendario_daterangepicker .form-control').val('De ' + start.format('DD/MM/YYYY') + ' até ' + end.format('DD/MM/YYYY'));
    });

    $(".cpf_inputmask").inputmask("mask", {
        "mask": "999.999.999-99"
    });

    $(".telefone_inputmask").inputmask("mask", {
        "mask": "(99) 9999-9999"
    });

    $(".cnpj_inputmask").inputmask("mask", {
        "mask": "99.999.999/9999-99"
    });

    $(".endereco_cep_inputmask").inputmask("mask", {
        "mask": "99999-999"
    });

    $(".data_1").inputmask("mask", {
        "mask": "99/99/9999"
    });


    $(".datetime_inputmask").inputmask("mask", {
        "mask": "99/99/9999 99:99"
    });

    $(".time_inputmask").inputmask("mask", {
        "mask": "99:99",
        "clearIncomplete": true
    });

    $(".date_inputmask").inputmask("mask", {
        "mask": "99/99/9999",
         "clearIncomplete": true
    });

    $(".block_form_submit").submit(function() {
        mApp.block('body', {
            overlayColor: '#000000',
            type: 'loader',
            state: 'success',
            message: 'Por favor aguarde...'
        });
    });


});



var FormRepeater={init:function(){$("#m_repeater_1").repeater({initEmpty:!1,defaultValues:{"text-input":"foo"},show:function(){$(this).slideDown()},hide:function(e){$(this).slideUp(e)}}),$("#m_repeater_2").repeater({initEmpty:!1,defaultValues:{"text-input":"foo"},show:function(){$(this).slideDown()},hide:function(e){confirm("Are you sure you want to delete this element?")&&$(this).slideUp(e)}}),$("#m_repeater_3").repeater({initEmpty:!1,defaultValues:{"text-input":"foo"},show:function(){$(this).slideDown()},hide:function(e){confirm("Are you sure you want to delete this element?")&&$(this).slideUp(e)}}),$("#m_repeater_4").repeater({initEmpty:!1,defaultValues:{"text-input":"foo"},show:function(){$(this).slideDown()},hide:function(e){$(this).slideUp(e)}}),$("#m_repeater_5").repeater({initEmpty:!1,defaultValues:{"text-input":"foo"},show:function(){$(this).slideDown()},hide:function(e){$(this).slideUp(e)}}),$("#m_repeater_6").repeater({initEmpty:!1,defaultValues:{"text-input":"foo"},show:function(){$(this).slideDown()},hide:function(e){$(this).slideUp(e)}})}};jQuery(document).ready(function(){FormRepeater.init()});

var Autosize={init:function(){var i,t;i=$("#m_autosize_1"),t=$("#m_autosize_2"),autosize(i),autosize(t),autosize.update(t)}};jQuery(document).ready(function(){Autosize.init()});


