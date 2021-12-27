<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>CPS530 Lab 5 Problem 2</title>
<style>

    img {max-width: 98%; height: auto; border: 4px solid black}

    table {
        font-size: 18pt;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid gray;
        padding: 8px;
    }

    .picWithCaptionDivElement {
        border: 4px outset black;
        background-color: lightgray;
        text-align: center;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    #captionBorder {border: 2px outset black; margin: 5%; font-size: 18pt}

</style>
</head>

<body>
    <?php

    $hostname = "localhost";
    $username = "dromita";
    $password = "mimAmoam";
    $database = "dromita";

    $connect = mysqli_connect($servername, $username, $password, $database);

    //echo "<h3>Connection Status:</h3>";

    if ($connect) {
        //print ("Connection Established Successfully");
        } else {
        //print("Connection Failed");
        }
    ?>

    <?php //AUTO_INCREMENT

        $picNumSelected = (int) $_POST['Selection'];

        /*echo "<h3>Drop Table Status:</h3>";

        $sql = "DROP TABLE Photos";

        if (mysqli_query($connect, $sql)) {
            echo "Table Photos Dropped.<br>";
        } else {
            echo "Error: " . $sql . "=>" . mysqli_error($connect);
        }*/

        //echo "<h3>Create Table Status:</h3>";

        $sql = "CREATE TABLE Photos (
            picture_number INT(6) UNSIGNED PRIMARY KEY,
            picture_subject VARCHAR(200),
            picture_location VARCHAR(200),
            date_taken DATE,
            picture_url VARCHAR(200)
            )";

        $created = mysqli_query($connect, $sql);
        
        if ($created) {
            //print "Table Photos Created.<br>";
        } else {
            //echo "Error: ".$sql." => ".mysqli_error($connect);
            //print "Table Photos Already Created Previously.<br>";
        }
        
        //echo "<h3>Insertion Status:</h3>";

        //Insertion Statements
        $sql = "INSERT INTO Photos (picture_number, picture_subject, picture_location, date_taken, picture_url)
            VALUES (1, 'Night View of Downtown Toronto from Toronto Islands with the Lake Ontario', 'Ontario', '2020-05-08', 
                'https://ihrmagazine.com/wp-content/uploads/2020/05/night-view-of-downtown-toronto-ontario-canada-HNT5PJB-696x464.jpg');";
        $sql .= "INSERT INTO Photos (picture_number, picture_subject, picture_location, date_taken, picture_url)
            VALUES (2, 'Statue of Liberty', 'New York', '2012-06-27',
                'https://images2.pics4learning.com/catalog/s/statueofliberty12.jpg');";
        $sql .= "INSERT INTO Photos (picture_number, picture_subject, picture_location, date_taken, picture_url)
            VALUES (3, 'Goderich, Ontario Harbour: Evening Images', 'Ontario', '2018-05-02',
                'https://www.itsabouttravelling.com/wp-content/uploads/2018/05/goderich-harbour-sunset-750x500.jpg');";
        $sql .= "INSERT INTO Photos (picture_number, picture_subject, picture_location, date_taken, picture_url)
            VALUES (4, 'Ontario Capitol Building', 'Ontario', '2010-02-21',
                'https://c1.staticflickr.com/3/2788/4410224474_ab5665fd34_b.jpg/');";
        $sql .= "INSERT INTO Photos (picture_number, picture_subject, picture_location, date_taken, picture_url)
            VALUES (5, 'Sydney Opera House', 'Sydney', '2017-02-02',
                'http://greenbuildingelements.com/wp-content/uploads/2017/01/IMG_1251-1024x768.jpg');";

        if (mysqli_multi_query($connect, $sql)) {
            //echo "Multiple Photos Added.<br>";
        } else {
            //echo "Error: ".mysqli_error($connect);
            //print "Duplicate entries exist, so they were not added. The table remains the same as when it was first created.";
        }
    ?>

    <header>
        <h1>CPS 530 Lab 5 Problem 2: Picture Display From SQL Table</h1>
        <p>Author: Dante Romita
        <br>Contact: <a href="mailto:dante.romita@ryerson.ca">dante.romita@ryerson.ca</a></p>
        <hr>
    </header>
    
    <?php
            if ($picNumSelected > 0) {
                echo "<h3>Picture in Part 4 Created. Click 
                <a href=\"#toPart4\">HERE</a>
                to jump to the Part 4 section.</h3>";
            }
    ?>

    <h2>Part A: Text Information About Images</h2>
    
    <?php

        $sql = "SELECT * FROM Photos order by date(date_Taken)desc";
        $result = mysqli_query($connect, $sql);

        $titleRowStyle = "<tr style=\"background-color: black; color: yellow; font-family: Arial Black ;\">";
        $evenRowstyle = "<tr style=\"background-color: pink; color: purple;\">";
        $oddRowstyle = "<tr style=\"background-color: lightblue; color: navy;\">";

        if (mysqli_num_rows($result) > 0) {
            echo ("<table>");
            echo ($titleRowStyle);
            echo ("
                <th><b>Subject</b></th>
                <th><b>Location</b></th>
                <th><b>Date Taken</b></th>
                <tr>
            ");
            
            $tableRowNum = 2;

            while($row = mysqli_fetch_assoc($result)) {
                $rowSubject = $row["picture_subject"];
                $rowLocation = $row["picture_location"];
                $rowDate = $row["date_taken"];
                if ($tableRowNum % 2 == 0) {
                    echo ($evenRowstyle);
                    echo ("
                        <th>$rowSubject</th>
                        <th>$rowLocation</th>
                        <th>$rowDate</th>
                    ");
                } else {
                    echo ($oddRowstyle);
                    echo ("
                        <th>$rowSubject</th>
                        <th>$rowLocation</th>
                        <th>$rowDate</th>
                    ");
                }
                echo ("</tr>");
                $tableRowNum = $tableRowNum + 1;
                //echo $row["picture_subject"] . " | " . $row["picture_location"] . " | " .$row["date_taken"] . "<br>";
            }
            echo ("</table>");
        } else {
            echo "No results.";
        }

    ?>

    <h2>Part B: Displaying Images Taken in Ontario</h2>
    
    <?php

        $sql = "SELECT * FROM Photos";
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if ($row["picture_location"] == "Ontario") {
                    $subject = $row["picture_subject"];
                    $location = $row["picture_location"];
                    $url_quoted = '"'.$row["picture_url"].'"';
                    echo ("
                    
                    <div class=\"picWithCaptionDivElement\">
                        <br>
                        <img src=$url_quoted>
                        <p style='font-size: 18pt'>Subject: $subject | Location: $location</p>
                    </div>
                    
                    ");
                }
            }
        } else {
            echo "There are no Ontario photos.";
        }

    ?>

    <h2>Part C: One Random Image</h2>

    <?php

        $maxNum = 0;
        $randNum = 0;
        $sql = "SELECT * FROM Photos";
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $maxNum = $maxNum + 1;
            }
            $randNum = rand(1,$maxNum);
        }
        
        $sql = "SELECT * FROM Photos";
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if ($randNum == $row["picture_number"]) {
                    $subject = $row["picture_subject"];
                    $location = $row["picture_location"];
                    $url_quoted = '"'.$row["picture_url"].'"';
                    echo ("
                    
                    <div class=\"picWithCaptionDivElement\">
                        <br>
                        <img src=$url_quoted>
                        <p style='font-size: 18pt'>Subject: $subject | Location: $location</p>
                    </div>
                    
                    ");
                }
            }
        } else {
            echo "The table does not exist.";
        }

        echo ("<p style=\"font-size: 16pt;\"><b >Number of images in database:</b> $maxNum");
    ?>

    <h2 id="toPart4">Part 4: Select Image to Display</h2>

    <form action="https://webdev.scs.ryerson.ca/~dromita/cps530_Lab5-P2.php" method = "post">
        <div>
            <label for="Selection">Choose an image to display:</label>
        </div>

        <br>

        <select name="Selection" id="Selection">
            <?php
                $sql = "SELECT * FROM Photos";
                $result = mysqli_query($connect, $sql);

                echo "<hr>";

                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $picNum = $row['picture_number'];
                        $picSubject = $row['picture_subject'];
                        $picLocation = $row['picture_location'];
                        $picDate = $row['date_taken'];
                        echo ("
                            <option value=\"$picNum\">$picNum. Subject: $picSubject | Location: $picLocation | Date Taken: $picDate</option>
                        ");
                    }
                    //echo ("<input style=\"text-align: center; font-size: 18pt;\" type=\"submit\">");
                } else {
                    echo "The table does not exist.";
                }
            ?>
        </select>
        <br><br>
        <?php
            $sql = "SELECT * FROM Photos";
            $result = mysqli_query($connect, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo ("<input style=\"text-align: center; font-size: 18pt;\" type=\"submit\">");
            }
        ?>
    </form>
    <br>
    <?php
        $sql = "SELECT * FROM Photos";
        $result = mysqli_query($connect, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if ($picNumSelected == $row['picture_number']) {
                    $subject = $row['picture_subject'];
                    $location = $row['picture_location'];
                    $date = $row['date_taken'];
                    $url_quoted = '"'.$row["picture_url"].'"';
                    echo ("
                    
                    <div class=\"picWithCaptionDivElement\">
                        <br>
                        <img src=$url_quoted>
                        <p style='font-size: 18pt'>Subject: $subject | Location: $location</p>
                    </div>
                    
                    ");
                }
            }
        } else {
            echo "The table does not exist.";
        }

    ?>
    
    <footer>
        <hr>
    
        <p>Author: Dante Romita
        <br>Contact: <a href="mailto:dante.romita@ryerson.ca">dante.romita@ryerson.ca</a></p>
    
    </footer>

    <?php
        
        /*echo "<h3>Drop Table Status:</h3>";

        $sql = "DROP TABLE Photos";
        
        if (mysqli_query($connect, $sql)) {
            echo "Table Photos Dropped.<br>";
        } else {
            echo "Error: " . $sql . "=>" . mysqli_error($connect);
        }*/
        
    ?>

    <?php mysqli_close($connect);?>
</body>
</html>



