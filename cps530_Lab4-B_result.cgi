#!/usr/bin/perl
use CGI ':standard';
print "Content-type: text/html\n\n";

#---Var Declarations---

$FirstName = param ('FirstName');
$LastName = param ('LastName');

$StreetName = param ('StreetName');
$City = param ('City');
$PostalCode = param ('PostalCode');
$Province = param ('Province');

@Gender_s = param ('gender');
$GenderSize = @Gender_s;
$GenderString = "";

$Email = param ('Email');
$PhoneNum = param ('PhoneNum');

$Password = param ('Password');

#---Validity Checks---

#Check validity of phone number
$validPhoneNum = "true";
if (length($PhoneNum) != 10) {
    $validPhoneNum = "false"; 
} else {
    for $i (0..length($PhoneNum)-1) {
        $currentChar = substr($PhoneNum, $i, 1);
        unless ($currentChar =~ /^\d/) {    #Checks if the current character is not a digit
            $validPhoneNum = "false";
            break;
        }
    }
}

#Check validity of postal code
$validPostalCode = "false";
if (length($PostalCode) == 6) {
    $validPostalCode = "true";
}

$validEmail = "false";
for $i (0..length($Email)-1) {
    $currentChar = substr($Email, $i, 1);
    if ($currentChar eq "@") {
        $validEmail = "true";
        break
    }
}

print qq(
    <!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito" rel="stylesheet">
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>CPS 530 Lab 4 Part B (Result)</title>
<style>
    #defaultDivMargin {margin: 2%;}

    #inputErrorText {
        color: red;
    }

    #nameStyle {
        background: yellow;
        border-style: ridge;
        border-width: thick;
        border-color: dodgerblue;
        color:dodgerblue;
    }

    #addressStyle {
        background: navy;
        border-style: ridge;
        border-width: thick;
        border-color: yellow;
        color: yellow;
    }

    #genderStyle {
        background: cyan;
        border-style: ridge;
        border-width: thick;
        border-color: purple;
        color: purple;
    }

    #contactStyle {
        background: darkslateblue;
        border-style: ridge;
        border-width: thick;
        border-color: orange;
        color: magenta;
    }

    #passwordStyle {
        background: rgb(0, 46, 0);
        border-style: ridge;
        border-width: thick;
        border-color: lime;
        color: lime;
    }
</style>
</head>

<body>
    <div class = "container-fluid" style="font-family: 'Nunito', sans serif;">
        <div class="row">
            <div class="col-md-12" id="nameStyle">
                <div id="defaultDivMargin" style="text-align: center;">
                    <h1><b>Welcome <div style="color: blue;">$FirstName $LastName!</div></b></h1>
                    <h4>We are happy to have you as a customer! Feel free to view your information below.</h4>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12" id="addressStyle">
                <div id="defaultDivMargin" style="text-align: center;">
                    <h1><b>Address:</b></h1>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3" id="addressStyle">
                <div id="defaultDivMargin" style="text-align: center;">
                    <h3><b>Street Name:</b></h3>
                    <h5>$StreetName</h5>
                </div>
            </div>
            <div class="col-md-3" id="addressStyle">
                <div id="defaultDivMargin" style="text-align: center;">
                    <h3><b>City:</b></h3>
                    <h5>$City</h5>
                </div>
            </div>
            <div class="col-md-3" id="addressStyle">
                <div id="defaultDivMargin" style="text-align: center;">
                    <h3><b>Postal Code:</b></h3>
                    <h5>$PostalCode</h5>
);

if ($validPostalCode eq "false") {
    print qq(<p id="inputErrorText">Invalid postal code! It must be exactly 6 characters long with no spaces.</p>)
}
                    
print qq(
                </div>
            </div>
            <div class="col-md-3" id="addressStyle">
                <div id="defaultDivMargin" style="text-align: center;">
                    <h3><b>Province:</b></h3>
                    <h5>$Province</h5>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12" id="genderStyle">
                <div id="defaultDivMargin" style="text-align: center;">
                    <h1><b>Gender(s): </b> 
);

if ($GenderSize == 1 and @Gender_s[0] eq "") {
    print qq(Prefer Not to Say</h1>);
} else {
    for $i (0..$GenderSize-1) {
        $GenderString = $GenderString.@Gender_s[$i];
        $GenderString = $GenderString.", ";
    }
    $GenderString = substr($GenderString, 0, length($GenderString)-2);
    if (@Gender_s[$GenderSize-1] eq "") {
        $GenderString = substr($GenderString, 0, length($GenderString)-2);
    }
    print qq($GenderString</h1>);
}

print qq(
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6" id="contactStyle">
                <div id="defaultDivMargin" style="text-align: center;">
                    <h3><b>Phone Number:</b></h3>
                    <h5>$PhoneNum</h5>
);
if ($validPhoneNum eq "false") {
    print qq(<p id="inputErrorText">Invalid phone number. It must be exactly 10 characters long and consist of only numbers.</p>)
}

print qq(
                </div>
            </div>
            <div class="col-md-6" id="contactStyle">
                <div id="defaultDivMargin" style="text-align: center;">
                    <h3><b>Email:</b></h3>
                    <h5>$Email</h5>
);
if ($validEmail eq "false") {
    print qq(<p id="inputErrorText">Invalid email. Valid emails must include an @ symbol.</p>)
}

print qq(
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12" id="passwordStyle">
                <div id="defaultDivMargin" style="text-align: center;">
                    <h1><b>Your Password:</b> $Password</h1>
);

if ($Password eq "") {
    print qq(<p id="inputErrorText">You have not entered a password. Please click the back arrow and ensure you enter a password.</p>);
}

print qq(
                </div>
            </div>
        </div>
    </div>
</body>
</html>
);
