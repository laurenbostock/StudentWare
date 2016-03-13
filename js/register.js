function usernameNotEmpty() {
	var username = document.getElementById("usernameTextbox");
	if(username.value.trim() != "")
	{
		return true;
	}
}

function emailNotEmpty() {
	var email = document.getElementById("emailTextbox");
	if(email.value.trim() != "")
	{
		return true;
	}
}

function validateEmail() {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(document.getElementById("emailTextbox").value);
}

function validatePassword() {
	var password = document.getElementById("password");
	var passwordConfirm = document.getElementById("passwordc");
	if(password.value == passwordConfirm.value) {
		return true;
	}
}

function passwordNotEmpty() {
	var password = document.getElementById("password");
	if(password.value.trim() != "")
	{
		return true;
	}
}

function confirmPasswordNotEmpty() {
	var cpassword = document.getElementById("passwordc");
	if(cpassword.value.trim() != "")
	{
		return true;
	}
}

function validateForm() {
	var isValid = true;
	var usernameVal = document.getElementById("usernameVal");
	var emailVal = document.getElementById("emailVal");
	var passVal = document.getElementById("passVal");
	var cPassVal = document.getElementById("cPassVal");

	if(!usernameNotEmpty()) {
		usernameVal.style.visibility = "visible";
		usernameVal.innerHTML = "Username cannot be blank!";
		isValid = false;
	} else {
		usernameVal.style.visibility = "hidden";
	}

	if(!emailNotEmpty()){
		emailVal.style.visibility = "visible";
		emailVal.innerHTML = "Email cannot be blank!";
		isValid = false;
	}
	else if(!validateEmail()) {
		emailVal.style.visibility = "visible";
		emailVal.innerHTML = "Invalid email!";
		isValid = false;
	}
	else {
		emailVal.style.visibility = "hidden";
	}

	if(!passwordNotEmpty()) {
		passVal.style.visibility = "visible";
		passVal.innerHTML = "Password cannot be blank!";
		isValid = false;
	} else {
		passVal.style.visibility = "hidden";
	}

	if(!confirmPasswordNotEmpty()) {
		cPassVal.style.visibility = "visible";
		cPassVal.innerHTML = "This field cannot be blank!";
		isValid = false;
	} 
	else if (!validatePassword()) {
		cPassVal.style.visibility = "visible";
		cPassVal.innerHTML = "Passwords don't match";
		isValid = false;
	}
	else {
		cPassVal.style.visibility = "hidden";
	}

	// If this is false then the form shouldnt submit
	return isValid;
}