<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <title>Kapitan</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href='http://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'>
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>
    <body>

<div id="all">
            <h1>Kapitan</h1>

    <div id="smallDiv">
            <form method="post" action = "<?php $_PHP_SELF ?>">
                <table id="table"><tr>
                        <th>
                            Meno
                        </th>
                        <th>
                            Priezvisko
                        </th>
                        <th>
                            Tím
                        </th>
                        <th>
                            Priradené body
                        </th>
                    </tr>


                    <?php
                    session_start();
                    include 'config.php';
                    if (!isset($_SESSION['captain'])) {
                        header("Location: index.php");
                    }
                    $team = $_GET['team'];
                    $id_captain = $_GET['captain'];

                    echo "Si kapitán $team. tímu.";

                    $mainsql = "SELECT p1.name AS Meno, p1.surname AS Priezvisko, p1.team AS Tim, p1.id_person AS ID FROM `OSOBY` AS p1, `HODNOTENIA` AS p2 WHERE p1.team='$team' AND p1.team = p2.team";

                    $sql2 = "SELECT points AS Body FROM `HODNOTENIA` WHERE team='$team'";

                    $sql3 = "SELECT p1.name AS Meno, p1.surname AS Priezvisko, p1.team AS Tim, p1.id_person AS ID, p3.body AS Body, p3.accept AS Accept FROM `OSOBY` AS p1, `HODNOTENIA` AS p2, `BODY` AS p3 "
                            . "WHERE p1.team='" . $team . "' AND p1.team = p2.team AND p3.id_osoba = p1.id_person";

                    $result = $conn->query($mainsql);
                    $result2 = $conn->query($sql2);
                    $row2 = $result2->fetch_assoc();


                    if (isset($_POST['btn-login'])) {
                        $result = $conn->query($mainsql);
                        $sucet = 0;
                        while ($row = $result->fetch_assoc()) {

                            $sucet = $sucet + intval($_POST[$row['ID']]);
                        }

                        if (intval($row2['Body']) == $sucet) {

                            $result = $conn->query($mainsql);
                            while ($row = $result->fetch_assoc()) {
                                $sql = "INSERT INTO `BODY`(`id_osoba`, `body`) VALUES ('" . $row['ID'] . "','" . $_POST[$row['ID']] . "')";


                                if ($conn->query($sql) === TRUE) {
                                    
                                } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                            }

                            $sql = "UPDATE `BODY` SET `accept`='S' WHERE id_osoba='" . $id_captain . "'";


                            if ($conn->query($sql) === TRUE) {
                                
                            } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }
                        } else {
                            echo"<script> alert('nesedia body');</script>";
                            //   unset($_POST['btn-login']);
                            // echo "<script>window.location = 'captain.php?team='.$team.'&captain='.$id_captain.'</script>";
                        }
                        // header("Location: captain.php?team=".$team."&captain=".$id_captain."");
                    }


                    $body = $conn->query($sql3);
                    if ($body->num_rows > 0) {

                        while ($row = $body->fetch_assoc()) {
                            echo "<tr><td>" . $row['Meno'] . "</td><td>" . $row["Priezvisko"] . "</td><td>" . $row["Tim"] . "</td><td><input class='text' type='text' id='body' value='" . $row['Body'] . "' disabled></td>";
                        }

                        echo "<tr><td>Uz si hlasoval</td></tr></tr>";
                         "</table>";
                        echo "</form>";
                    } else {


                        $result = $conn->query($mainsql);
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row['Meno'] . "</td><td>" . $row["Priezvisko"] . "</td><td>" . $row["Tim"] . "</td><td><input class='text' type='text' id='body' name=" . $row['ID'] . "></td>";
                            }
                            echo "<tr><td><button type='submit' name='btn-login'>Submit</button></td></tr></tr>";
                            echo "</table>";
                            echo "</form>";
                        } else {
                            echo "0 results";
                             echo "</table>";
                            echo "</form>";
                        }
                    }
                    // $row2 = $result2->fetch_assoc();
                    echo "Celkové body tímu: " . $row2["Body"] . "";




                    $conn->close();
                    ?>  

                    <script type="text/javascript">
                        $(document).ready(function () {
                            
                            if( bool() )
                            {
                            
                            setTimeout(function () {
                                $('body').load('captain.php?team=<?php echo $team ?>&captain=<?php echo $id_captain ?>')
                            }, 2000);
                       
                       }
                       });
                       
                       function bool(){
                       bool = false;
                    $("#body").each(function(index){
                               if( $(this).val() !=""){
                                   bool = true;
                                   return false;
                               }
                            })   ;
                            return bool;
                    }
                        
                        
                    </script>

                   
                    <a href="logout.php?logout">odhlas</a>
                    </div>
 </div>

                    </body>


                    </html>