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
    $("[type='submit']").click(function(e) {
	e.preventDefault();

	if (isEmpty($("[name='name']")))
	    return;

	if (isEmpty($("[name='email']")))
	    return;

	if (!isValidEmail($("[name='email']")))
	    return;

	if (isEmpty($("[name='password']")))
	    return;

	var name = $("[name='name']").val();
	var email = $("[name='email']").val();
	var password = $("[name='password']").val();
			       
	$.ajax({
	    type: "POST",
	    url: "register.php",
	    dataType: "json",
	    data: {name:name, email:email, password:password},
	    success : function(data) {
		if (data.code == "200") {
		    $("#header").html("<h2>sii</h2>");
		} else {
		    $("#header").html("<h2>rii</h2>");
		}
		alert("as");
	    }
	});
    });
}

$(document).ready(function() {
    onSubmit();

    
});
