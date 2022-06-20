function ValidateEmail(input) {
    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (input.match(validRegex)) {
        return true;
    } else {
        return false;
    }
}
function notEmptyInput(input){
    if(input !==''){
        return true
    }else{
        return false
    }
}
function  isPostive(input){
    if(Math.sign(input)>0){
        return true;
    }else {
        return false
    }
}

/**
 * fonction pour verfier la validation de  formulaire client
 */
function checkDataCustomer() {
    if(notEmptyInput($('#customer_name').val())!== true){
        $('#alert_name').text('nom ne doit pas être vide');
        $("#alert_name").show();
    }else {
        $("#alert_name").hide();
    }
    if(notEmptyInput($('#customer_lastName').val())!== true){
        $('#alert_lastname').text('prénom ne doit pas être vide');
        $("#alert_lastname").show();
    }else{
        $("#alert_lastname").hide();
    }
    if(ValidateEmail($('#customer_email').val())!== true){
        $('#alert_email').text('vérifier format email ');
        $("#alert_email").show();
    }else{
        $("#alert_email").hide();
    }
    if(notEmptyInput($('#customer_name').val())=== true &&
        notEmptyInput($('#customer_lastName').val())=== true &&
        ValidateEmail($('#customer_email').val())=== true){
        $("#form_customer").submit();
    }
}
function  checkDataMaterial(){
    if(notEmptyInput($('#material_name').val())!== true){
        $('#alert_name').text('nom de material ne doit pas être vide');
        $("#alert_name").show();
    }else {
        $("#alert_name").hide();
    }
    if(notEmptyInput($('#material_description').val())!== true){
        $('#alert_description').text('description de material ne doit pas être vide');
        $("#alert_description").show();
    }else {
        $("#alert_description").hide();
    }
    if(isPostive($('#material_price').val())!== true){
        $('#alert_price').text('la valeur de champs prix doit être un numéro positive  ');
        $("#alert_price").show();
    }else{
        $("#alert_price").hide();
    }
    if(notEmptyInput($('#material_name').val())=== true &&
        notEmptyInput($('#material_description').val())=== true &&
        isPostive($('#material_price').val())=== true){
        $("#form_material").submit();
    }
}