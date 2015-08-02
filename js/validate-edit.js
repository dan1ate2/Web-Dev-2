// validates the join form
function validateForm() {
    var surname = document.forms["join"]["surname"].value;
    var otherNames = document.forms["join"]["other-names"].value;
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
    if (surname == "") {
        alert("The Surname field cannot be left blank.\n" +
        "Please complete this field.");
        join.surname.focus();
        return false;
    }
        else {
            re = new RegExp(/^\w+\s?\w+?$/);

            if (!re.test(surname)) {
                alert("You have entered an invalid surname." + 
                    "\nOnly letters and spaces are allowed.");
                document.forms["join"]["surname"].select();
                return false;
            }
        }
    }

    // validate otherNames
    if (otherNames == "") {
        alert("The Other Names field cannot be left blank." + 
            "\nPlease complete this field.");
        document.forms["join"]["other-names"].focus();
        return false;
    }
    
    // set contact method chosen (initialize var)
    if (document.join.mobile.checked == true) {
        chosenContact = document.join.mobile.value;
    }
    else if (document.join.daytime.checked == true) {
        chosenContact = document.join.daytime.value;
    }
    else {
        chosenContact = document.join.email.value;
    }

    // validate mobile
    // format '0(4 or 5) xxx xxx'
    if (mobile == "" && chosenContact == document.join.mobile.value) {
        alert("As your preferred contact method, a mobile number is required." + 
            "\nPlease complete this field. Format: 0xxx xxx xxx");
        document.forms["join"]["mobile-info"].focus();
        return false;
    }
        else if (!mobile == "") {
        re = new RegExp(/^0[4|5]\d{2}\s\d{3}\s\d{3}$/);

        if (!re.test(mobile)) {
            alert("You have entered an invalid mobile." + 
                "\nFormat required: 0xxx xxx xxx");
            document.forms["join"]["mobile-info"].select();
            return false;
        }
    }

    // validate daytime phone
    // format '(xx) xxxxxxxx'
    if (dayTime == "" && chosenContact == document.join.daytime.value) {
        alert("As your preferred contact method, a daytime number is required." + 
            "\nFormat: (0x) xxxxxxxx");
        document.forms["join"]["daytime-info"].focus();
        return false;
    }
    else if (!dayTime == "") {
        re = new RegExp(/^\(\d[2|3|6|7|8|9]\)\s\d{8}$/);

        if (!re.test(dayTime)) {
            alert("You have entered an invalid daytime number, please fix");
            document.forms["join"]["daytime-info"].select();
            return false;
        }
    }

    // validate email
    // '@' and '.' required
    // can have longer domain prefixes e.g. '.scu.edu.au'
    if (email == "" && chosenContact == document.join.email.value) {
        alert("As your preferred contact method, an email is required");
        document.forms["join"]["email-info"].focus();
        return false;
    }
    else if (!email == "") {
        re = new RegExp(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}(\.[a-zA-Z]{2,3})*$/);

        if (!re.test(email)) {
            alert('You have entered an invalid email, please fix');
            document.forms["join"]["email-info"].select();
            return false;
        }
    }

    // check for postal address if magazine option selected
    if (document.forms["join"]["magazine"].checked) {
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
    // 1-8 digits, space, street name, space, street type (or longer name)
    if (!streetAddress == "") {
        re = new RegExp(/^\d{1,8}\s(\w+\s\w+)(\s\w+){0,5}$/);

        if (!re.test(streetAddress)) {
            alert('You have entered an invalid street address, please fix');
            document.forms["join"]["street-address"].select();
            return false;
        }
    }

    // validate suburb/state
    // min 2 words with a space in between
    // last word has minimum 3 characters (state abv)
    if (!suburbState == "") {
        re = new RegExp(/^\w+\s(\s\w)*(\w+){3,}$/);

        if (!re.test(suburbState)) {
            alert('You have entered an invalid suburb/state combination, please fix');
            document.forms["join"]["suburb-state"].select();
            return false;
        }
    }

    // validate postcode
    // 4 digits
        if (!postcode == "") {
        re = new RegExp(/^(\d){4}$/);

        if (!re.test(postcode)) {
            alert('You have entered an invalid postcode, please fix');
            document.forms["join"]["postcode"].select();
            return false;
        }
    }

    // validate username
    // 6-10 characters, no whitespace
    if (!username == "") {
        re = new RegExp(/^(\w){6,10}\S$/);

        if (!re.test(username)) {
            alert('You have entered an invalid username, please fix');
            document.forms["join"]["username"].select();
            return false;
        }
    }

    // validate password


    // validate occupation

}