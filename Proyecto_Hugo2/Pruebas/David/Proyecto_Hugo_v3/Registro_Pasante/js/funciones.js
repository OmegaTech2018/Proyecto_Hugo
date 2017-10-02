$(document).ready(function(){
	// Validación de password.
    $("#contra").keyup(function(){
		// Validación de longitud de password.
		if(($(this).val()).length >= 8){
			$("#mensajePsswLength").hide();
		}
		else{
			$("#mensajePsswLength").show();
		}
		
		// Validación de mayúscula(s).
		if(($(this).val()).match(/[A-Z]/)){
			$("#mensajePsswMayusc").hide();
		}
		else{
			$("#mensajePsswMayusc").show();
		}
		
		// Validación de digito(s).
		if(($(this).val()).match(/\d/)){
			$("#mensajePsswDigit").hide();
		}
		else{
			$("#mensajePsswDigit").show();
		}
		
		if(!$("#mensajePsswLength, #mensajePsswMayusc, #mensajePsswDigit").is(":visible")){
			$("#contra").removeClass('form-control form-control-red').addClass('form-control form-control-green');
		}
		else{
			$("#contra").removeClass('form-control form-control-green').addClass('form-control form-control-red');
		}
    });
});
