function validaSenha(input){
    if (input.value != document.getElementById('senha').value){
        input.setCustomValidity('Repita a senha corretamente');
    }else{
        input.setCustomValidity('');
    }
}
