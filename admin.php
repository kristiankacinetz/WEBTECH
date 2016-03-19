<!DOCTYPE html>
<html>
<head>
 <meta charset = "utf-8">
 <title>Tim</title>
 <link rel="stylesheet" type="text/css" href="css/zadanie2_wt2.css">
 <link href='http://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'>
 <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>


 <script language="JavaScript" type="text/javascript">
  $(document).ready(function(){
    $(".btns").click(function(e){
      if(!confirm('Potvrd svoje rozhodnutie!')){
        e.preventDefault();
        return false;
      }
      return true;
    });
  });
</script>


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
     <table id="table1"><tr>
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
      <th>
        Status
      </th>
      <th>
        Suhlas/Nesuhlas
      </th>

    </tr>


    <?php

    include 'config.php';
   


    $sqlTeam1 = "SELECT p1.name AS Meno, p1.surname AS Priezvisko, p1.team AS Tim, p1.id_person AS ID, p3.body AS Body, p3.accept AS Accept FROM `OSOBY` AS p1, `HODNOTENIA` AS p2, `BODY` AS p3 WHERE p1.team='1' AND p1.team = p2.team AND p3.id_osoba = p1.id_person";


    $sqlPoints1 = "SELECT points AS Body FROM `HODNOTENIA` WHERE team='1'";
   

    $resultTeam1 = $conn->query($sqlTeam1);
    $resultPoints1 = $conn->query($sqlPoints1);




    if ($resultTeam1->num_rows > 0) {

     while($rowTeam1 = $resultTeam1->fetch_assoc()) {
      echo "<tr><td>" . $rowTeam1['Meno']. "</td><td>" . $rowTeam1["Priezvisko"]. "</td><td>" . $rowTeam1["Tim"]. "</td><td>" . $rowTeam1["Body"] . "</td>";
        //ci uz je schvalena v databaze 
      if ($rowTeam1["Accept"] == 'S') {
       echo "<td>Suhlas</td></td>";
     }
      elseif ($rowTeam1["Accept"] == 'N') {
       echo "<td>Nesuhlas</td>";
     }
     else{
      echo "<td>Nedefinovane</td>";
    }

    echo "<td><button type='submit' class='btns' name=A".$rowTeam1['ID'].">Suhlasim</button> <button type='submit' class='btns' name=N". $rowTeam1['ID'].">Nesuhlasim</button></td></td>";

  }


  echo "</table>";
  // echo "</form>";
} else {
  echo "0 results";
}

$rowPoints1 = $resultPoints1->fetch_assoc();
echo "Celkové body 1. tímu: " . $rowPoints1["Body"]."";
?>

<!-- Druha tabulka -->

     <table id="table2"><tr>
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
      <th>
        Status
      </th>
      <th>
        Suhlas/Nesuhlas
      </th>

    </tr>


    <?php

  
  

    $sqlTeam2 = "SELECT p1.name AS Meno, p1.surname AS Priezvisko, p1.team AS Tim, p1.id_person AS ID, p3.body AS Body, p3.accept AS Accept FROM `OSOBY` AS p1, `HODNOTENIA` AS p2, `BODY` AS p3 WHERE p1.team='2' AND p1.team = p2.team AND p3.id_osoba = p1.id_person";

  
    $sqlPoints2 = "SELECT points AS Body FROM `HODNOTENIA` WHERE team='2'";

    $resultTeam2 = $conn->query($sqlTeam2);
    $resultPoints2 = $conn->query($sqlPoints2);




    if ($resultTeam2->num_rows > 0) {

     while($rowTeam2 = $resultTeam2->fetch_assoc()) {
      echo "<tr><td>" . $rowTeam2['Meno']. "</td><td>" . $rowTeam2["Priezvisko"]. "</td><td>" . $rowTeam2["Tim"]. "</td><td>" . $rowTeam2["Body"] . "</td>";
        //ci uz je schvalena v databaze 
      if ($rowTeam2["Accept"] == 'S') {
       echo "<td>Suhlas</td>";
     }
     elseif ($rowTeam2["Accept"] == 'N') {
       echo "<td>Nesuhlas</td>";
     }
     else{
      echo "<td>Nedefinovane</td>";
    }

    echo "<td><button type='submit' class='btns' name=A".$rowTeam2['ID'].">Suhlasim</button> <button type='submit' class='btns' name=N". $rowTeam2['ID'].">Nesuhlasim</button></td></td>";

  }


  echo "</table>";
  echo "</form>";
} else {
  echo "0 results";
}

$rowPoints2 = $resultPoints2->fetch_assoc();
echo "Celkové body 2. tímu: " . $rowPoints2["Body"]."";


// $result = $conn->query($sql);    
// while($row = $result->fetch_assoc()) {
//     //echo "$_POST['A$row['ID']']";
//  if (isset($_POST['A'.$row["ID"]])) {


//    $sql = "UPDATE `BODY` SET `accept`='S' WHERE id_osoba='".$row['ID']."'";



//    if ($conn->query($sql) === TRUE) {


//    } else {
//      echo "Error: " . $sql . "<br>" . $conn->error;

//    }
//  }
//  elseif (isset($_POST['N'.$row["ID"]])) {


//    $sql = "UPDATE `BODY` SET `accept`='N' WHERE id_osoba='".$row['ID']."'";


//    if ($conn->query($sql) === TRUE) {


//    } else {
//      echo "Error: " . $sql . "<br>" . $conn->error;

//    }
//  }

// }




$conn->close();
?>  

</div>
</section>
<footer>
 <p><small>Copyright 2015 Kristián Kačinetz</small></p>
</footer>
</body>
</html>