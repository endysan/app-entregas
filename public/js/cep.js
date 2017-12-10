// IMPLEMENTAÇÃO ALTERNATIVA =========================================================
function limpa_formulário_cep(local) {
    // Limpa valores do formulário de cep.
    if(typeof local !== "undefined") {
        local = "_"+local; 
    } else {
        local = ""; 
    }

    $("#rua"+local).val("");
    $("#bairro"+local).val("");
    $("#cidade"+local).val("");
    $("#uf"+local).val("");
}
function preenche_cep(local) {
    if(typeof local !== "undefined") {
        local = "_"+local; 
    } else {
        local = ""; 
    }
    var cep = $("#cep"+local).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {
        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {
            //Preenche os campos com "..." enquanto consulta webservice.
            $("#rua"+local).val("...");
            $("#bairro"+local).val("...");
            $("#cidade"+local).val("...");
            $("#uf"+local).val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#rua"+local).val(dados.logradouro);
                    $("#bairro"+local).val(dados.bairro);
                    $("#cidade"+local).val(dados.localidade);
                    $("#uf"+local).val(dados.uf);
                } //end if.
                else {
                    //CEP pesquisado não foi encontrado.
                    limpa_formulário_cep(local);
                    alert("CEP não encontrado.");
                }
            });
        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
}