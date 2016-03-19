<!DOCTYPE html>
<html>
<head>
     <meta charset = "utf-8">
     <title>Tim</title>
     <link rel="stylesheet" type="text/css" href="css/zadanie2_wt2.css">
     <link href='http://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'>
     <style>
          table, th, td {
               border: 1px solid black;
               padding: 5px;
          }
     </style>
</head>
<body>

     <section>
          <header>
              <h1>Tím</h1>
         </header>
         <div id="tabulky">
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

          include 'config.php';
          $team = $_GET['team'];

          echo "Si kapitán $team. tímu.";

          $sql = "SELECT p1.name AS Meno, p1.surname AS Priezvisko, p1.team AS Tim, p1.id_person AS ID FROM `OSOBY` AS p1, `HODNOTENIA` AS p2 WHERE p1.team='$team' AND p1.team = p2.team";

          $sql2 = "SELECT points AS Body FROM `HODNOTENIA` WHERE team='$team'";

          $result = $conn->query($sql);
          $result2 = $conn->query($sql2);




          if ($result->num_rows > 0) {

               while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['Meno']. "</td><td>" . $row["Priezvisko"]. "</td><td>" . $row["Tim"]. "</td><td><input class='text' type='text' id='body' name=". $row['ID']."></td>";

           }

           echo "<tr><td><button type='submit' name='btn-login'>Submit</button></td></tr></tr>";
           echo "</table>";
           echo "</form>";
      } else {
          echo "0 results";
     }

     $row2 = $result2->fetch_assoc();
     echo "Celkové body tímu: " . $row2["Body"]."";

     if (isset($_POST['btn-login'])) {
          $result = $conn->query($sql);     
          while($row = $result->fetch_assoc()) {
               $sql = "INSERT INTO `BODY`(`id_osoba`, `body`) VALUES ('" . $row['ID'] . "','" . $_POST[$row['ID']] . "')";
               

               if ($conn->query($sql) === TRUE) {


               } else {
                   echo "Error: " . $sql . "<br>" . $conn->error;

              }
         }

    }


    $conn->close();
    ?>  

</div>
</section>
<footer>
   <p><small>Copyright 2015 Kristián Kačinetz</small></p>
</footer>
</body>
</html>