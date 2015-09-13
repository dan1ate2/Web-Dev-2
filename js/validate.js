// validates the join form
function validateJoinForm() {
    // document.getElementById("").value;
    var surname = document.getElementById("surname").value;
    var otherNames = document.getElementById("other-names").value;
    var chosenContact; // preferred contact option
    var mobile = document.getElementById("mobile-info").value;
    var dayTime = document.getElementById("daytime-info").value;
    var email = document.getElementById("email-info").value;
    var streetAddress = document.getElementById("street-address").value;
    var suburbState = document.getElementById("suburb-state").value;
    var postcode = document.getElementById("postcode").value;
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var retypePassword = document.getElementById("retype-password").value;
    var occupation = document.getElementById("occupation").value;
    var re; // regular expression

    // validate surname
    // can have single spaces, " ' " or " - "
    if (surname == "") {
        alert("The Surname field cannot be left blank.");
        document.getElementById("surname").focus();
        return false;
    }
    else {
        re = new RegExp(/^([a-zA-Z\'\-]+)(\s[a-zA-Z\'\-]+){0,5}$/);

        if (!re.test(surname)) {
            alert("You have entered an invalid surname." + 
                "\nOnly words, single spaces, \" ' \" and \" - \" are allowed.");
            document.getElementById("surname").select();
            return false;
        }
    }

    // validate otherNames
    // can have single spaces, " ' " or " - "
    if (otherNames == "") {
        alert("The Other Names field cannot be left blank.");
        document.getElementById("other-names").focus();
        return false;
    }
    else {
        re = new RegExp(/^([a-zA-Z\'\-]+)(\s[a-zA-Z\'\-]+){0,6}$/);

        if (!re.test(otherNames)) {
            alert("You have an invalid entry in 'Other names' field." + 
                "\nOnly words, single spaces, \" ' \" and \" - \" are allowed.");
            document.getElementById("other-names").select();
            return false;
        }
    }
    
    // set chosen contact method (initialize var)
    if (document.getElementById("mobile").checked == true)
        chosenContact = document.getElementById("mobile").value;
    else if (document.getElementById("daytime").checked == true)
        chosenContact = document.getElementById("daytime").value;
    else
        chosenContact = document.getElementById("email").value;

    // validate mobile
    // format '0(4 or 5)xx xxx xxx' eg '0412 345 678'
    if (mobile == "" && chosenContact == document.getElementById("mobile").value) {
        alert("As your preferred contact method, a mobile number is required" + 
            "\nMust start with 04 or 05." +
            "\nFormat: '0xxx xxx xxx' (including spaces).");
        document.getElementById("mobile-info").focus();
        return false;
    }
    else if (!mobile == "") {
        re = new RegExp(/^0[4|5]\d{2}\s\d{3}\s\d{3}$/);

        if (!re.test(mobile)) {
            alert("You have entered an invalid mobile number." +
                "\nMust start with 04 or 05." +
                "\nRequired format: '0xxx xxx xxx' (including spaces).");
            document.getElementById("mobile-info").select();
            return false;
        }
    }

    // validate daytime phone
    // format '(xx) xxxxxxxx' (includes brackets)
    if (dayTime == "" && chosenContact == document.getElementById("daytime").value) {
        alert("As your preferred contact method, a daytime number is required." +
            "\nStart with 2 digit area code in brackets, a space, then 8 digits." +
            "\nRequired format: '(0x) xxxxxxxx' (including spaces/brackets).");
        document.getElementById("daytime-info").focus();
        return false;
    }
    else if (!dayTime == "") {
        re = new RegExp(/^\(0[2|3|6|7|8|9]\)\s\d{8}$/);

        if (!re.test(dayTime)) {
            alert("You have entered an invalid daytime number." +
                "\nStart with 2 digit area code in brackets, a space, then 8 digits." +
                "\nRequired format: '(0x) xxxxxxxx' (including spaces/brackets).");
            document.getElementById("daytime-info").select();
            return false;
        }
    }

    // validate email
    // '@' and '.' required
    // can have longer domain prefixes e.g. '.scu.edu.au'
    if (email == "" && chosenContact == document.getElementById("email").value) {
        alert("As your preferred contact method, an email is required.");
        document.getElementById("email-info").focus();
        return false;
    }
    else if (!email == "") {
        re = new RegExp(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}(\.[a-zA-Z]{2,3})*$/);

        if (!re.test(email)) {
            alert('You have entered an invalid email.');
            document.getElementById("email-info").select();
            return false;
        }
    }

    // check for postal address if magazine option selected
    if (document.getElementById("magazine").checked) {
        document.getElementById("magazine").value = "subscribed"; // flag as subscribed

        if (!streetAddress) {
            alert("A street address is required to receive the monthly magazine.");
            document.getElementById("street-address").focus();
            return false;
        }
        else if (!suburbState) {
            alert("A suburb and state are required to receive the monthly magazine.");
            document.getElementById("suburb-state").focus();
            return false;
        }
        else if (!postcode) {
            alert("A postcode is required to receive the monthly magazine.");
            document.getElementById("postcode").focus();
            return false;
        }
    }

    // validate street address
    // any character/word, followed by single whitespace and character/word
    // additional single whitespace and character/word optional
    if (!streetAddress == "") {
        re = new RegExp(/^\S{1,}(\s\S{1,}){1,}$/);

        if (!re.test(streetAddress)) {
            alert("You have entered an invalid street address." + 
                "\nMinimal: character/s or word followed by single space and another character/word" +
                "\nAcceptable examples:" + 
                "\n123 Anne Street" +
                "\nP.O. Box 123 Street" +
                "\nUnit 1-44 That Street" +
                "\n1/44 That Street");
            document.getElementById("street-address").select();
            return false;
        }
    }

    // validate suburb/state
    // min 2 words with a space in between
    // last word has minimum 3 characters (state abv)
    if (!suburbState == "") {
        re = new RegExp(/^(\w{3,}){1}(\s\w{3,}){1}(\s\w{3,})*$/);

        if (!re.test(suburbState)) {
            alert("You have entered an invalid suburb/state combination." + 
                "\nExample suburb/street: 'Brisbane QLD'");
            document.getElementById("suburb-state").select();
            return false;
        }
    }

    // validate postcode
    // 4 digits
    if (!postcode == "") {
        re = new RegExp(/^(\d){4}$/);

        if (!re.test(postcode)) {
            alert("You have entered an invalid postcode." + 
                "\nShould only contain 4 digits.");
            document.getElementById("postcode").select();
            return false;
        }
    }

    // validate username
    // 6-10 characters, no whitespace
    if (!username == "") {
        re = new RegExp(/^(\S){6,10}$/);

        if (!re.test(username)) {
            alert("You have entered an invalid username." + 
                "\nUsername must be between 6-10 characters only." + 
                "\nNO whitespace allowed.");
            document.getElementById("username").select();
            return false;
        }
    }
    else {
        alert("The Username field cannot be left blank.");
        document.getElementById("username").focus();
        return false;
    }

    // validate first password field
    // must be 4-10 characters
    // must have 1 uppercase, 1 lowercase, 1 digit, 1 special character
    if (!password == "") {
        re = new RegExp(/^(?=.*[~!?@#$%^&*+=])(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,10}$/);

        if (!re.test(password)) {
            alert("You have entered an invalid password." + 
                "\nPassword must contain at least one uppercase letter, " + 
                "\none lowercase letter, one number, and one special character." + 
                "\nSpecial characters accepted: ~!?@#$%^&*+=<br>" +
                "\nPassword must be between 4-10 characters.<br><br>");
            document.getElementById("password").select();
            return false;
        }
    }
    else {
        alert("The Password field cannot be left blank.");
        document.getElementById("password").focus();
        return false;
    }
    
    // validate second password field (re-type password)
    // must match first password field
    if (!retypePassword == "") {
        if (retypePassword != password) {
            alert("Passwords don't match, please try again.")
            document.getElementById("password").value = "";
            document.getElementById("retype-password").value = "";
            document.getElementById("password").focus();
            return false;
        }
    }
    else {
        alert("Please confirm password, both password fields must match.")
        document.getElementById("retype-password").focus();
        return false;
    }

    // validate occupation
    if (occupation == " ") {
        alert("Please choose your occupation.")
        document.getElementById("occupation").focus();
        return false;
    }
} // end of validateJoinForm

// Contact form validation
function validateContactForm() {
    var firstName = document.getElementById("first-name").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var re; // regular expression

    // validate first name
    // single word no spaces
    if (firstName == "") {
        alert("The First Name field cannot be left blank.");
        document.getElementById("first-name").focus();
        return false;
    }
    else {
        re = new RegExp(/^\w{2,}$/);

        if (!re.test(firstName)) {
            alert("You have entered an invalid first name." + 
                "\nOnly a single word is allowed, no spaces.");
            document.getElementById("first-name").select();
            return false;
        }
    }

    // validate email
    // '@' and '.' required
    // can have longer domain prefixes e.g. '.scu.edu.au'
    if (email == "") {
        alert("An email address is required.");
        document.getElementById("email").focus();
        return false;
    }
    else if (!email == "") {
        re = new RegExp(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}(\.[a-zA-Z]{2,3})*$/);

        if (!re.test(email)) {
            alert('You have entered an invalid email.');
            document.getElementById("email").select();
            return false;
        }
    }

    // validate phone number
    // 12 characters including spaces, only digits
    if (phone == "") {
        alert("A phone or mobile number is required" + 
                "\nMust contain only digits and spaces." + 
                "\nFormat: 'xxxx xxx xxx'.");
        document.getElementById("phone").focus();
        return false;
    }
        else if (!phone == "") {
        re = new RegExp(/^\d{4}\s\d{3}\s\d{3}$/)

        if (!re.test(phone)) {
            alert("You have entered an invalid phone number." + 
                "\nMust contain only digits and spaces." + 
                "\nFormat: 'xxxx xxx xxx'.");
            document.getElementById("phone").select();
            return false;
        }
    }
} // end of validateContactForm

