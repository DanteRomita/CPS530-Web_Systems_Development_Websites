#!/usr/bin/perl
print "Content-type: text/html\n\n";

print qq(
    <!DOCTYPE html>
    <html>
        <head>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Nunito" rel="stylesheet">
            <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
            <title>CPS 530 Lab 4</title>
            <style>
                .styling {
                color: blue;
                font-family: 'Nunito', sans serif;
                font-size: 50pt;
                text-align: center;
                }
            </style>
        </head>

    <body>
        <div class="styling"><b>This is my first Perl program.</b></div>
    </body>
</html>
    );