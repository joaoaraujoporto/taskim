function validateEmail(input) {
    var mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (inputText.value.match(mailformat)) {
	document.login-form.email.focus();
	return true;
    } else {
	alert("You have entered an invalid email address!");
	document.login-form.email.focus();
	return false;
    }
}

function isEmpty(input) {
    if (input === "") {
	return true;
    }
	
    return false
}
    
function required() {
    if (isEmpty(document.login-form.email.value)) {
	alert("1");
    }

	alert("2");
}

