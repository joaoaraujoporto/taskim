function isValidEmail(emailElement) {
    var mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (emailElement.val().match(mailFormat)) {
	return true;
    }

    alert("You have entered an invalid email address.");
    emailElement.focus();
    return false;
}

function isEmpty(element) {
    if (element.val() === "") {
	alert("The ".concat(element.attr("name"), " field is empty. Fill it to login."));
	element.focus();
	return true;
    }
	
    return false;
}

function onSubmit() {
    $("form").submit(function() {
	if (!isEmpty($("[name='name']")))
	    if (!isEmpty($("[name='email']")))
		if (isValidEmail($("[name='email']")))
		    if (!isEmpty($("[name='password']")))
			return true;
	return false;
    });
}

$(document).ready(function() {
    onSubmit();

    
});
