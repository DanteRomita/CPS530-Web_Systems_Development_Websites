<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>CPS 530 Lab 6 Problem 1 by Dante Romita</title>

<%  
    '---VARIABLE DECLARATIONS---

    'RGB
    redVal = Request.QueryString("redVal")
    greenVal = Request.QueryString("greenVal")
    blueVal = Request.QueryString("blueVal")
    alphaVal = Request.QueryString("alphaVal")
    validRGB = false

    if (isNumeric(redVal) and isNumeric(greenVal) and isNumeric(blueVal) and isNumeric(alphaVal) and _ 
        redVal <> "" and greenVal <> "" and blueVal <> "" and alphaVal <> "") then
        redVal = cInt(redVal)
        greenVal = cInt(greenVal)
        blueVal = cInt(blueVal)
        alphaVal = cInt(alphaVal) * 0.01

        if (redVal >= 0 and redVal <= 255 and greenVal >= 0 and greenVal <= 255 _
            and blueVal >= 0 and blueVal <= 255 and alphaVal >= 0 and alphaVal <= 1) then
            backgroundStyleString = "background-color: rgba(" & redVal & ", " & greenVal & ", " & blueVal & " ," & alphaVal & ");"
            validRGB = true
        end if
    end if

    'response.write(validRGB)
    'response.write("<br>")

    'HEX
    hexVal = Request.QueryString("hexVal")
    validHex = true

    if len(hexVal) = 8 then
        for i = 1 to len(hexVal)
            if (not (isNumeric(mid(hexVal, i, 1)))) then
                charToLower = ucase(mid(hexVal, i, 1))
                if charToLower <> "a" and charToLower <> "b" and charToLower = "c" and _ 
                    charToLower <> "d" and charToLower <> "e" and charToLower = "f" then
                    validHex = false
                end if
            end if
        next
        backgroundStyleString = "background-color: #" & hexVal
    else
        validHex = false
    end if

    'response.write(validHex)
    'response.write("<br>")
    
    'COLOR NAME
    colorVal = Request.QueryString("colorVal")
    validColor = false

    if colorVal <> "" then
        validColor = true
        backgroundStyleString = "background-color: " & colorVal
    end if

    'response.write(validColor)
    'response.write("<br>")
    
    'URL
    urlVal = Request.QueryString("urlVal")
    validURL = false
    if urlVal <> "" and validRGB = false and validHex = false and validColor = false then
        validURL = true
        backgroundStyleString = "background-image: url('" & urlVal & "'); "
    end if

    'response.write(validURL)
    'response.write("<br>")

    'TIME, DATE AND NUMBER OF VISITS
    Response.Cookies("lastVisitTime") = time()
    lastVisitTime = Request.Cookies("lastVisitTime")
    Response.Cookies("lastVisitDate") = date()
    lastVisitDate = Request.Cookies("lastVisitDate")
    Response.Write("You last visited this page on <b>" & lastVisitDate & "</b> at <b>" & lastVisitTime & "</b>.<br>")

    dim numVisits
    response.cookies("numVisits").Expires=date+365
    numvisits=request.cookies("NumVisits")

    if numVisits = "" then
        response.cookies("numVisits")=2
        response.write("This is your first time visiting this webpage. Welcome!")
    else
        response.cookies("NumVisits")=numvisits+1
        response.write("You have visited this webpage " & numVisits & " times in total.")
    end if

%>

<style>
    body {
        <%Response.Write(backgroundStyleString)%>
    }
</style>
</head>

<body>
    <header>
        <h1>CPS 530 Lab 6 Problem 1: Background Generation</h1>
        <p>Author: Dante Romita
        <br>Contact: <a href="mailto:dante.romita@ryerson.ca">dante.romita@ryerson.ca</a></p>
        <hr>
    </header>

    <h2>Generate a Background:</h2>

    <p><b>Instructions:</b> Enter a colour or input an image to use as the page's background.
        You may submit to any <b>ONE</b> of the forms below.</p>

    <hr>
    <h3>RGB:</h3>
    
    <p>Ensure all RGB values are between 0 and 255 inclusive.<br>Ensure the alpha percentage is between 0 and 100 inclusive.</p>

    <form action="default.asp" method="get">
        <b style="color: red">Red: </b><input type="text" name="redVal"><br>
        <b style="color: green">Green: </b><input type="text" name="greenVal"><br>
        <b style="color: blue">Blue: </b><input type="text" name="blueVal"><br>
        <b style="color: #00000088">Alpha (Transparency): </b><input type="text" name="alphaVal">%<br>
        <br>
        <input style="font-size: 18pt;" type="submit">
    </form>
    
    <hr>
    <h3>Hex:</h3>

    <form action="default.asp" method="get">
        <b>Enter an eight-digit hex code: #</b><input type="text" name="hexVal"><br>
        <br>
        <input style="font-size: 18pt;" type="submit">
    </form>
    
    <hr>
    <h3>Colour Name:</h3>

    <form action="default.asp" method="get">
        <b>Enter the name of a colour: </b><input type="text" name="colorVal"><br>
        <b>NOTE: </b>Ensure that the colour name is spelt correct and is supported by CSS.
            Otherwise, the page will default to a white background. No errors will be displayed for this form.
        <br><br>
        <input style="font-size: 18pt;" type="submit">
    </form>

    <hr>
    <h3>Enter URL to Image:</h3>

    <form action="default.asp" method="get">
        <b>Enter the exact URL of the image you would like to display: </b><input type="text" name="urlVal"><br>
        <br>
        <input style="font-size: 18pt;" type="submit">
    </form>
    
</body>
</html>
