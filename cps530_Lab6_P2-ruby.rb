#!/usr/bin/ruby -w

puts "Content-type: text/html\n\n"
require 'cgi'
cgi = CGI.new

#Variable declarations | .capitalize() ensures that the variable strings have their first letter capitalized while the rest are lower-case

city = cgi['city'].capitalize()
province_state = cgi['province_state'].capitalize()
country = cgi['country'].capitalize()

population = ((cgi['population']).to_i).to_s    #Clears any non-numerical values

url = cgi['url']

#End of variable declarations

puts "<!DOCTYPE html><html>"
puts "<head><meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\" />"
puts "<title>(Ruby) CPS 530 Lab 6 Problem 2</title>"

#---STYLING---
puts "<style>"

#Allows text of the page to be large and stylized
puts ".centeredLarge {"
puts "text-align: center;"
puts "font-size: 60pt;"
puts "font-family: Arial, sans-serif;"
puts "}"

#Ensures the image displayed takes up the full width of the webpage
puts "img {"
puts "width: 100%;"
puts "height: auto; "
puts "}"

puts "</style>"
#---END OF STYLING---

puts "</head>"

puts "<body style='background-color: rgb(90, 0, 0)'"
puts "  <div class = 'centeredLarge'>"
puts "      <div style='color: lime'><b>City:</b> " + city + "</b></div>"                       #Prints the city in lime
puts "      <div style='color: yellow'><b>Province/State:</b> "+ province_state + "</b></div>"  #Prints the province/state in yellow
puts "      <div style='color: red'><b>Country:</b> "+ country +"</b></div>"                    #Prints the country in red
puts "      <div style='color: magenta'><b>Population:</b> "+ population +"</b></div>"          #Prints the population in agenda
puts "  </div>"
puts "<img src='" + url + "'>"  #Displays the stylized image based on the URL provided
puts "</body>"
puts "</html>"