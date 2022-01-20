<?php
     function loginForm()
     {
      return ('<form name="logowanie" id="logowanie" action="index.php" method="post">
                <table border="0">
                  <tbody>
                    <tr>
                      <td>Login: </td>
                      <td><input name="login" id="login" type="text" required></td>
                    </tr>
                    <tr>
                      <td>Hasło: </td>
                      <td><input name="password" id="password" type="password" required></td>
                    </tr>
                    <tr>
                      <td><input type="submit" value="Zaloguj się" name="loguj"></td>
                    </tr>
                  </tbody>
                </table>');
     }

     function registerForm()
     {
      return ('<form name="rejestracja" id="rejestracja" action="" method="post">
                <table border="0">
                  <tbody>
                    <tr>
                      <td>Login: </td>
                      <td><input name="loginRegister" id="login" type="text" required></td>
                    </tr>
                    <tr>
                      <td>Hasło: </td>
                      <td><input name="passwordRegister" id="password" type="password" required></td>
                    </tr>
                    <tr>
                      <td>Imię: </td>
                      <td><input name="firstName" id="firstName" type="text"></td>
                    </tr>
                    <tr>
                      <td>Nazwisko: </td>
                      <td><input name="surname" id="surname" type="text"></td>
                    </tr>
                    <tr>
                      <td><input type="submit" value="Zarejestruj się" name="rejestruj"></td>
                    </tr>
                  </tbody>
                </table>');
     }
     
     function logoutForm()
     {
      return('<form name="logout" id="logout" action='."index.php".' method="post">
                <table border="0">
                  <tbody>
                    <tr>
                      <td><input name="logout" type="submit" value="Wyloguj"></td>
                    </tr>
                  </tbody>
                </table>');
     }     
     
     function logout()
     {
      unset($_SESSION['role']);
      $url = 'index.php';
      header( "Location: $url" );
     }

     if(isset($_POST["loguj"]))
     {

       include "autoryzacja.php";
       if(!isset($_SESSION['role']) || $_SESSION['role'] == "Niezalogowano")
       {
       
       $_SESSION['role'] = loguj($_POST["login"], $_POST["password"]);
       }
     }

     if(isset($_POST["rejestruj"]))
     {

       include "autoryzacja.php";
       rejestruj($_POST["firstName"], $_POST["surname"], $_POST["loginRegister"], $_POST["passwordRegister"], "UZYTKOWNIK");
     }


     
     if (isset($_POST['logout'])) {
        logout();
      }

     function getRole()
     {
      print($_SESSION['role']);
     }
?>
