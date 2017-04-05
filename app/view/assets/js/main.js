$( document ).ready(function(){
    $('#dt_nasc').mask('00/00/0000');
    $('#telefone').mask('(00)0000-0000');
    $('#whatsapp').mask('(00)00000-0000');
    
    $('#dt_real').datepicker({
        altField: '#dt_real',
        altFormat: "yyyy-mm-dd"
    });
});