function ValidarMeusDados(){
    var nome = document.getElementById("nome").value;
    var email = $("#email").val();

    if(nome.trim() == ''){
        alert("Preencher o Campo NOME!");
        $("#nome").focus();
        return false;
    }
    if(email.trim() == ''){
        alert("Preencher o Campo E-MAIL!");
        return false;
    }
}

function ValidarCategoria(){
    if($("#nomecategoria").val().trim() == ''){
        alert("Preencher o Campo NOME DA CATEGORIA!");
        $("#nomecategoria").focus();
        // A linha de baixo, coloca o Campo com Borda em Vermelho, caso usuário não preencha o Campo.
        $("#divNome").addClass("has-error");        
        return false;
    }
}

// Esta função possui a responsabilidade de trocar a cor do Campo quando selecionado e preenchido com aguma informação
function ValidarCampo(){
    if($("#nomecategoria").val().trim() == ''){
        $("#divNome").addClass("has-error");
    }else{
        $("#divNome").removeClass("has-error").addClass("has-success");
    }
}

function ValidarEmpresa(){
    var nomeempresa = $("#nomeempresa").val();
    var telefone = $("#telefone").val();
    var endereco = $("#endereco").val();

    if(nomeempresa.trim() == ''){
        alert("Preencher o Campo NOME!");
        $("#nomeempresa").focus();
        return false;
    }
    if(telefone.trim() == ''){
        alert("Preencher o Campo TELEFONE!");
        return false;
    }
    if(endereco.trim() == ''){
        alert("Preencher o Campo ENDEREÇO!");
        return false;
    }
}

function ValidarConta(){
    var nomebanco = $("#nomebanco").val();
    var agencia = $("#agencia").val();
    var num_conta = $("#num_conta").val();
    var saldo = $("#saldo").val();

    if(nomebanco.trim() == ''){
        alert("Preencher o Campo BANCO!");
        $("#nomebanco").focus();
        return false;
    }
    if(agencia.trim() == ''){
        alert("Preencher o Campo AGÊNCIA!");
        return false;
    }
    if(num_conta.trim() == ''){
        alert("Preencher o Campo NÚMERO DA CONTA!");
        return false;
    }
    if(saldo.trim() == ''){
        alert("Preencher o Campo SALDO");
        return false;
    }
}

function RealizarMovimento(){
    var data = $("#data").val();
    var valor = $("#valor").val();
    var conta = $("#conta").val();

    if($("#tipo").val() == ''){
        alert("Preencher o Campo TIPO");
        $("#tipo").focus();
        return false;
    }
    if(data.trim() == ''){
        alert("Preencher o Campo DATA!");
        return false;
    }
    if(valor.trim() == ''){
        alert("Preencher o Campo VALOR!");
        return false;
    }
    if($("#categoria").val() == ''){
        alert("Preencher o Campo CATEGORIA!");
        return false;
    }
    if($("#empresa").val() == ''){
        alert("Preencher o Campo EMPRESA!");
        return false;
    }
    if($("#conta").val() == ''){
        alert("Preencher o Campo CONTA!");
        return false;
    }
}

function ConsultarMovimento(){
    var dataini = $("#dataini").val();
    var datafinal = $("#datafinal").val();

    if($("#tipomov").val() == ''){
        alert("Preencher o Campo TIPO");
        $("#tipomov").focus();
        return false;
    }
    if(dataini.trim() == ''){
        alert("Preencher o Campo DATA INICIAL!");
        return false;
    }
    if(datafinal.trim() == ''){
        alert("Preencher o Campo DATA FINAL!");
        return false;
    }
}

function ValidarLogin(){
    var emailusuario = $("#emailusuario").val();
    var senhausuario = $("#senhausuario").val();

    if(emailusuario.trim() == ''){
        alert("Preencher o Campo E-mail do Usuário!");
        $("#emailusuario").focus();
        return false;
    }
    if(senhausuario.trim() == ''){
        alert("Preencher o Campo Senha do Usuário!");
        return false;
    }
}

function ValidarCadastro(){
    var usuarionome = $("#usuarionome").val();
    var usuarioemail = $("#usuarioemail").val();

    if(usuarionome.trim() == ''){
        alert("Preencher o Campo Nome do usuário!");
        $("#usuarionome").focus();
        return false;
    }
    if(usuarioemail.trim() == ''){
        alert("Preencher o Campo E-mail do Usuário!");
        $("#usuarionome").focus();
        return false;
    }
    if($("#senhausuario").val().trim() == ''){
        alert("Preencher o Campo Senha do Usuário!");
        $("#senhausuario").focus();
        return false;
    }
    if($("#senhausuario").val().trim().length < 6){
        alert("A senha deverá conter no Mínimo, 6 Caracteres!");
        $("#senhausuario").focus();
        return false;
    }
    if($("#senhausuario").val().trim() != $("#repsenhausuario").val().trim()){
        alert("O Campo SENHA e REPETIR SENHA deverão ser iguais!");
        return false;
    }
}