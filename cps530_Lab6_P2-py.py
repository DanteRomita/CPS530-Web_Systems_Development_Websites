#!/usr/bin/python

print "Content-type:text/html\n\n"

import cgi, cgitb
form = ""

city = ""
province_state = ""
country = ""
population = ""
popNumString = ""
url = ""

try: #NOTE: form.getValue() didn't work for me for some reason, so I instead used string manipulation to output the values
    form = str(cgi.FieldStorage()) #Imports all of the fields and converts to string
    form = form[26:len(form)-2] #Trims off a large unnecessary portion of the string

    #Deletes all unnecessary parts of the string
    form = form.replace('MiniFieldStorage', '') 
    form = form.replace('(', '')
    form = form.replace("'", '')
    form = form.replace(")", '')
    form = form.replace(",", '')

    form = list(form.split()) #Splits all substrings into distinct list elements
    
    #Extracts all odd indicies of the list, as those contain the values desired for output
    city = form[1].upper()
    province_state = form[3].upper()
    country = form[5].upper()
    population = form[7]
    for currentChar in population: #Ensures only all non-numeric characters will be displayed
        if currentChar in "0123456789":
            popNumString = popNumString + currentChar
    url = form[9]
except: #Used for debugging
    print "form = cgi.FieldStorage() doesn't work"

print '''
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>(Python) CPS 530 Problem 2</title>'''

#---BEGINNING OF STYLING---

print '''
<style>
    .centeredLarge {
        text-align: center;
        font-size: 60pt;
        font-family: Arial, sans-serif;
        margin: 0.5%;
    }

    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 80%;
        border: 16px solid cyan
    }
</style>'''

#centredLarge is responsible for ensuring the text is large and centred at the top of the page
#img is responsible fo ensuring the image has 80% width and a thick, coloured border

#---END OF STYLING---

print "</head>"

print "<body style='background-color: rgb(90, 0, 0)'>"
print " <div class = 'centeredLarge'>"
print "     <div style='color: lime'><b>CITY:</b> " + city + "</b></div>" #Prints city
print "     <div style='color: yellow'><b>PROVINCE/STATE:</b> " + province_state + "</b></div>" #Prints province/state
print "     <div style='color: red'><b>COUNTRY:</b> " + country + "</b></div>" #Prints Country
print "     <div style='color: magenta'><b>POPULATION:</b> " + popNumString + "</b></div>" #Prints population number
print "</div>"
print "<img src='" + url + "'>" #Displays the stylized image based on the URL
print "</body></html>"