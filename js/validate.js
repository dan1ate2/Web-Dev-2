// validates the join form fields
	function validateForm() {
    var surname = document.forms["join"]["surname"].value;
    var otherNames = document.forms["join"]["other-names"].value;
    // var mobile = document.getElementById("mobile").checked;

    if (surname == null || surname == "") {
        alert("The Surname field cannot be left blank");
        join.surname.focus();
        return false;
    }
    if (otherNames == null || otherNames == "") {
        alert("The Other Names field cannot be left blank");
        document.forms["join"]["other-names"].focus(); // issue with dash
        return false;
    }
    
    // Check contact method chosen then validate data field
    function contactDataValidation() {
        if (document.join.mobile.checked == true) {
            alert("mobile checked"); //TEMP
            return false; //TEMP
        }
        else if (document.join.daytime.checked == true) {
            alert("daytime checked"); //TEMP
            return false; //TEMP
        }
        else {
            alert("email checked"); //TEMP
            return false; //TEMP
        }
    }
}