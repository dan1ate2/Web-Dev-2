// validates the join form
function validateJoinForm() {
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
    var occupation = document.forms["join"]["occupation"].value;
    var joinDate = new Date(); // date stamp object
    var formattedDate; // the date stamp formatted
    var re; // regular expression

    // validate surname
    // can have single spaces, " ' " or " - "
    if (surname == "") {
        alert("The Surname field cannot be left blank.");
        join.surname.focus();
        return false;
    }
    else {
        re = new RegExp(/^([a-zA-Z\'\-]+)(\s[a-zA-Z\'\-]+){0,5}$/);

        if (!re.test(surname)) {
            alert("You have entered an invalid surname." + 
                "\nOnly words, single spaces, \" ' \" and \" - \" are allowed.");
            document.forms["join"]["surname"].select();
            return false;
        }
    }

    // validate otherNames
    // can have single spaces, " ' " or " - "
    if (otherNames == "") {
        alert("The Other Names field cannot be left blank.");
        document.forms["join"]["other-names"].focus();
        return false;
    }
    else {
        re = new RegExp(/^([a-zA-Z\'\-]+)(\s[a-zA-Z\'\-]+){0,6}$/);

        if (!re.test(otherNames)) {
            alert("You have an invalid entry in 'Other names' field." + 
                "\nOnly words, single spaces, \" ' \" and \" - \" are allowed.");
            document.forms["join"]["other-names"].select();
            return false;
        }
    }
    
    // set chosen contact method (initialize var)
    if (document.join.mobile.checked == true)
        chosenContact = document.join.mobile.value;
    else if (document.join.daytime.checked == true)
        chosenContact = document.join.daytime.value;
    else
        chosenContact = document.join.email.value;

    // validate mobile
    // format '0(4 or 5)xx xxx xxx' eg '0412 345 678'
    if (mobile == "" && chosenContact == document.join.mobile.value) {
        alert("As your preferred contact method, a mobile number is required" + 
            "\nMust start with 04 or 05." +
            "\nFormat: '0xxx xxx xxx' (including spaces).");
        document.forms["join"]["mobile-info"].focus();
        return false;
    }
    else if (!mobile == "") {
        re = new RegExp(/^0[4|5]\d{2}\s\d{3}\s\d{3}$/);

        if (!re.test(mobile)) {
            alert("You have entered an invalid mobile number." +
                "\nMust start with 04 or 05." +
                "\nRequired format: '0xxx xxx xxx' (including spaces).");
            document.forms["join"]["mobile-info"].select();
            return false;
        }
    }

    // validate daytime phone
    // format '(xx) xxxxxxxx' (includes brackets)
    if (dayTime == "" && chosenContact == document.join.daytime.value) {
        alert("As your preferred contact method, a daytime number is required." +
            "\nStart with 2 digit area code in brackets, a space, then 8 digits." +
            "\nRequired format: '(0x) xxxxxxxx' (including spaces/brackets).");
        document.forms["join"]["daytime-info"].focus();
        return false;
    }
    else if (!dayTime == "") {
        re = new RegExp(/^\(0[2|3|6|7|8|9]\)\s\d{8}$/);

        if (!re.test(dayTime)) {
            alert("You have entered an invalid daytime number." +
                "\nStart with 2 digit area code in brackets, a space, then 8 digits." +
                "\nRequired format: '(0x) xxxxxxxx' (including spaces/brackets).");
            document.forms["join"]["daytime-info"].select();
            return false;
        }
    }

    // validate email
    // '@' and '.' required
    // can have longer domain prefixes e.g. '.scu.edu.au'
    if (email == "" && chosenContact == document.join.email.value) {
        alert("As your preferred contact method, an email is required.");
        document.forms["join"]["email-info"].focus();
        return false;
    }
    else if (!email == "") {
        re = new RegExp(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}(\.[a-zA-Z]{2,3})*$/);

        if (!re.test(email)) {
            alert('You have entered an invalid email.');
            document.forms["join"]["email-info"].select();
            return false;
        }
    }

    // check for postal address if magazine option selected
    if (document.forms["join"]["magazine"].checked) {

        if (!streetAddress) {
            alert("A street address is required to receive the monthly magazine.");
            document.forms["join"]["street-address"].focus();
            return false;
        }
        else if (!suburbState) {
            alert("A suburb and state are required to receive the monthly magazine.");
            document.forms["join"]["suburb-state"].focus();
            return false;
        }
        else if (!postcode) {
            alert("A postcode is required to receive the monthly magazine.");
            document.forms["join"]["postcode"].focus();
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
            document.forms["join"]["street-address"].select();
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
            document.forms["join"]["suburb-state"].select();
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
            document.forms["join"]["postcode"].select();
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
            document.forms["join"]["username"].select();
            return false;
        }
    }
    else {
        alert("The Username field cannot be left blank.");
        join.username.focus();
        return false;
    }

    // validate first password field
    // must be 4-10 characters
    // must have 1 uppercase, 1 lowercase, 1 digit, 1 special character
    // no whitespace
    if (!password == "") {
        // re = new RegExp(/^(?=.*[~!?@#$%^&*+=])(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,10}$/);
        re = new RegExp(/^(?!.*\s)(?=.*[\W_])(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,10}$/);

        if (!re.test(password)) {
            alert("You have entered an invalid password." + 
                "\nPassword must contain at least one uppercase letter, " + 
                "\none lowercase letter, one number, and one special character." +
                "\nPassword must be between 4-10 characters, no whitespace allowed.<br><br>");
            document.forms["join"]["password"].select();
            return false;
        }
    }
    else {
        alert("The Password field cannot be left blank.");
        join.password.focus();
        return false;
    }
    
    // validate second password field (re-type password)
    // must match first password field
    if (!retypePassword == "") {
        if (retypePassword != password) {
            alert("Passwords don't match, please try again.")
            document.forms["join"]["password"].value = "";
            document.forms["join"]["retype-password"].value = "";
            document.forms["join"]["password"].focus();
            return false;
        }
    }
    else {
        alert("Please confirm password, both password fields must match.")
        document.forms["join"]["retype-password"].focus();
        return false;
    }

    // validate occupation
    if (occupation == " ") {
        alert("Please choose your occupation.")
        document.forms["join"]["occupation"].focus();
        return false;
    }
} // end of validateJoinForm

// Contact form validation
function validateContactForm() {
    var firstName = document.forms["contact-form"]["first-name"].value;
    var email = document.forms["contact-form"]["email"].value;
    var phone = document.forms["contact-form"]["phone"].value;
    var re; // regular expression

    // validate first name
    // single word no spaces
    if (firstName == "") {
        alert("The First Name field cannot be left blank.");
        document.forms["contact-form"]["first-name"].focus();
        return false;
    }
    else {
        re = new RegExp(/^\w{2,}$/);

        if (!re.test(firstName)) {
            alert("You have entered an invalid first name." + 
                "\nOnly a single word is allowed, no spaces.");
            document.forms["contact-form"]["first-name"].select();
            return false;
        }
    }

    // validate email
    // '@' and '.' required
    // can have longer domain prefixes e.g. '.scu.edu.au'
    if (email == "") {
        alert("An email address is required.");
        document.forms["contact-form"]["email"].focus();
        return false;
    }
    else if (!email == "") {
        re = new RegExp(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}(\.[a-zA-Z]{2,3})*$/);

        if (!re.test(email)) {
            alert('You have entered an invalid email.');
            document.forms["contact-form"]["email"].select();
            return false;
        }
    }

    // validate phone number
    // 12 characters including spaces, only digits
    if (phone == "") {
        alert("A phone or mobile number is required" + 
                "\nMust contain only digits and spaces." + 
                "\nFormat: 'xxxx xxx xxx'.");
        document.forms["contact-form"]["phone"].focus();
        return false;
    }
        else if (!phone == "") {
        re = new RegExp(/^\d{4}\s\d{3}\s\d{3}$/)

        if (!re.test(phone)) {
            alert("You have entered an invalid phone number." + 
                "\nMust contain only digits and spaces." + 
                "\nFormat: 'xxxx xxx xxx'.");
            document.forms["contact-form"]["phone"].select();
            return false;
        }
    }
} // end of validateContactForm