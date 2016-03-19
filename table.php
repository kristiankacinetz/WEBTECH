<!DOCTYPE html>
<html>
<head>
 <meta charset = "utf-8">
 <title>Tim</title>
 <link rel="stylesheet" type="text/css" href="css/zadanie2_wt2.css">
 <link href='http://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'>
 <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


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

  <div id="tabulky">
    <form method="post" action = "table.php">
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
      <th>
        Suhlas/Nesuhlas
      </th>

    </tr>


    <?php

    include 'config.php';
    $team = $_GET['team'];


    $sql = "SELECT p1.name AS Meno, p1.surname AS Priezvisko, p1.team AS Tim, p1.id_person AS ID, p3.body AS Body, p3.accept AS Accept FROM `OSOBY` AS p1, `HODNOTENIA` AS p2, `BODY` AS p3 WHERE p1.team='$team' AND p1.team = p2.team AND p3.id_osoba = p1.id_person";

    $sql2 = "SELECT points AS Body FROM `HODNOTENIA` WHERE team='$team'";

    $result = $conn->query($sql);
    $result2 = $conn->query($sql2);




    if ($result->num_rows > 0) {

     while($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row['Meno']. "</td><td>" . $row["Priezvisko"]. "</td><td>" . $row["Tim"]. "</td><td>" . $row["Body"] . "</td>";
        //ci uz je schvalena v databaze 
      if ($row["Accept"] == 'S') {
       echo "<td>Suhlas</td></td>";
     }
     elseif ($row["Accept"] == 'N') {
       echo "<td>Nesuhlas</td></td>";
     }
     else{
      echo "<td><button type='submit' class='btns' name=A".$row['ID'].">Suhlasim</button> <button type='submit' class='btns' name=N". $row['ID'].">Nesuhlasim</button></td></td>";
    }

  }


  echo "</table>";
  echo "</form>";
} else {
  echo "0 results";
}

$row2 = $result2->fetch_assoc();
echo "Celkové body tímu: " . $row2["Body"]."";

$result = $conn->query($sql);    
while($row = $result->fetch_assoc()) {
    //echo "$_POST['A$row['ID']']";
 if (isset($_POST['A'.$row["ID"]])) {


   $sql = "UPDATE `BODY` SET `accept`='S' WHERE id_osoba='".$row['ID']."'";



   if ($conn->query($sql) === TRUE) {


   } else {
     echo "Error: " . $sql . "<br>" . $conn->error;

   }
 }
 elseif (isset($_POST['N'.$row["ID"]])) {


   $sql = "UPDATE `BODY` SET `accept`='N' WHERE id_osoba='".$row['ID']."'";


   if ($conn->query($sql) === TRUE) {


   } else {
     echo "Error: " . $sql . "<br>" . $conn->error;

   }
 }

}




$conn->close();
?>  


</div>


</body>
</html>