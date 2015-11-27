function ValidationTest() {
    var firstname = document.getElementById("firstname").value;
    var lastname = document.getElementById("lastname").value;
    var cnsty = document.getElementById("cnsty").value;
    var email = document.getElementById("email").value;
    var years = document.getElementById("years").value;
    var psw1 = document.getElementById("psw1").value;
    var psw2 = document.getElementById("psw2").value;
    var emailReg = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if (firstname != '' && lastname != '' && cnsty != '' && email != '' && years != '' && psw1 != '' && psw2 != '') {
        if (email.match(emailReg)) {
            if (years >= 0 && years <= 50) {
                if (psw1 == psw2) {
                    alert("Thanks for your submission.");
                    return true;
                } else {
                    alert("Passwords don't match!!");
                    document.getElementById("psw1").style.backgroundColor = "red";
                    document.getElementById("psw1").value = "";
                    document.getElementById("psw2").style.backgroundColor = "red";
                    document.getElementById("psw2").value = "";
                    return false;
                }
            } else {
                alert("Invalid number!!");
                document.getElementById("years").style.backgroundColor = "red";
                document.getElementById("years").value = "";
                return false;
            }
        } else {
            alert("Invalid Email Address...!!!");
            document.getElementById("email").style.backgroundColor = "red";
            document.getElementById("email").value = "";
            return false;
        }
    } else {
        alert("All fields are required.....!");
        return false;
    }
}