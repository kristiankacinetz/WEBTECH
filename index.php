<!DOCTYPE html>
<html>
<head>
  <meta charset = "utf-8">
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="css/zadanie2_wt2.css">

</head>

<?php
session_start();
include 'config.php';





if(isset($_POST['btn-login']))
{
 $login = $conn->real_escape_string($_POST['login']);
 $upass = $conn->real_escape_string($_POST['pass']);

 $res=$conn->query("SELECT * FROM `OSOBY` WHERE login='$login'");
 

 $row=$res->fetch_assoc();


 if($row['passwd']==$upass)
 {
     if($row['id_role']==1){
          $_SESSION['admin'] = $row['id_role'];
     }

  if($row['captain'] == 1){
    $_SESSION['user'] = $row['id_person'];
    $_SESSION['captain'] = $row['captain'];
    header("Location: captain.php?team=".$row['team']."&captain=".$row['id_person']."");
   
  }
  else{
     $_SESSION['user'] = $row['id_person'];
    header("Location: team.php?team=".$row['team']."&id=".$row['id_person']."");
  }

  if($row['id_role'] == 1){
    $_SESSION['user'] = $row['id'];
    header("Location: admin.php");
  }

  
}
else
{
  ?>
  <script>alert('wrong details');</script>
  <?php
}

}


?>



<body>
  <section>
    <header>
      <h2>Prihlásenie</h2>
    </header>
    <div id="login-form">
      <form method="post" action = "<?php $_PHP_SELF ?>">
        <table>
          <tr>
            <td><input type="text" name="login" placeholder="Your Login" required /></td>
          </tr>
          <tr>
            <td><input type="password" name="pass" placeholder="Your Password" required /></td>
          </tr>
          <tr>
            <td><button type="submit" name="btn-login">Prihlásiť</button></td>
          </tr>
          
        </table>
      </form>
    </div>
  </section>
  <footer>
    <p><small>Copyright 2015 Kristián Kačinetz</small></p>
  </footer>
</body>
</html>