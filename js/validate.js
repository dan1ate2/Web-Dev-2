// validates the join form fields
function validateForm() {
    var surname = document.forms["join"]["surname"].value;
    var otherNames = document.forms["join"]["other-names"].value;
    // var mobile = document.getElementById("mobile").checked;
    var chosenContact; // preferred contact option
    var mobile = document.forms["join"]["mobile-info"].value;
    var dayTime = document.forms["join"]["daytime-info"].value;
    var email = document.forms["join"]["email-info"].value;
    var streetAddress = document.forms["join"]["street-address"].value;
    var suburbState = document.forms["join"]["suburb-state"].value;
    var postcode = document.forms["join"]["postcode"].value;
    var username = document.forms["join"]["username"].value;
    var password = document.forms["join"]["password"].value;
    var retypePassword = document.forms["join"]["retype-password"].value;
    var occupation; // FIGURE OUT HOW TO GET SELECTED OPTION
    var re; // regular expression

    // validate surname
    if (surname == null || surname == "") {
        alert("The Surname field cannot be left blank");
        join.surname.focus();
        return false;
    }

    // validate otherNames
    if (otherNames == null || otherNames == "") {
        alert("The Other Names field cannot be left blank");
        document.forms["join"]["other-names"].focus();
        return false;
    }
    
    // set contact method chosen
    if (document.join.mobile.checked == true) {
        alert("mobile checked"); //TEMP
        chosenContact = document.join.mobile.value;
    }
    else if (document.join.daytime.checked == true) {
        alert("daytime checked"); //TEMP
        chosenContact = document.join.daytime.value;
    }
    else {
        alert("email checked"); //TEMP
        chosenContact = document.join.email.value;
    }

    // validate mobile
    if ((mobile == "" || mobile == null) && chosenContact == document.join.mobile.value) {
        alert("As your preferred contact method, a mobile number is required");
        document.forms["join"]["mobile-info"].focus();
        return false;
    }
    // else if (mobile != "" || mobile != null) {
        else if (!mobile == "") {
        re = new RegExp(/^0[4|5]\d{2}\s\d{3}\s\d{3}$/);

        if (!re.test(mobile)) {
            alert('You have entered an invalid mobile, please fix');
            document.forms["join"]["mobile-info"].select();
            return false;
        }
    }

    // validate daytime phone
    if ((dayTime == "" || dayTime == null) && chosenContact == document.join.daytime.value) {
        alert("As your preferred contact method, a daytime number is required");
        document.forms["join"]["daytime-info"].focus();
        return false;
    }
    //else if (typeof dayTime !== undefined || dayTime != "" || dayTime != null) { // ISSUE - KEEPS ENTERING WHEN VARIABLE IS EMPTY
    else if (!dayTime == "") {
        re = new RegExp(/^\(\d[2|3|6|7|8|9]\)\s\d{8}$/);

        if (!re.test(dayTime)) {
            alert('You have entered an invalid daytime number, please fix');
            document.forms["join"]["daytime-info"].select();
            return false;
        }
    }

    // validate email
    if ((email == "" || email == null) && chosenContact == document.join.email.value) {
        alert("As your preferred contact method, an email is required");
        document.forms["join"]["email-info"].focus();
        return false;
    }
    //else if (email != "" || email != null) {
    else if (!email == "") {
        // re = new RegExp(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/); // WORKING, 1 DOT ALLOWED
        re = new RegExp(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}(\.[a-zA-Z]{2,3})*$/); // WORKS, ANY COMBO

        if (!re.test(email)) {
            alert('You have entered an invalid email, please fix');
            document.forms["join"]["email-info"].select();
            return false;
        }
    }

    // check for postal address if magazine option selected
    if (document.forms["join"]["magazine"].checked) {
        alert('magazine is checked'); // TEMP
        if (!streetAddress) {
            alert('A street address is required to receive the monthly magazine');
            document.forms["join"]["street-address"].focus();
            return false;
        }
        else if (!suburbState) {
            alert('A suburb and state are required to receive the monthly magazine');
            document.forms["join"]["suburb-state"].focus();
            return false;
        }
        else if (!postcode) {
            alert('A postcode is required to receive the monthly magazine');
            document.forms["join"]["postcode"].focus();
            return false;
        }
    }

    // validate street address
    re = new RegExp(/^\d$/);

    // validate suburb/state

    // validate postcode

    // validate username

    // validate password

    // validate occupation

}