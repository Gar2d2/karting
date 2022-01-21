<!DOCTYPE html>
<html lang="pl">
  <head>
    <title>Tor karingowy</title>
    <meta charset="UTF-8">
    <meta name="Generator" content="JTHTML 8.6">
    <meta name="Robots" content="index">
    <link rel="Stylesheet" href="css/css.css" type="text/css">
  </head>
  <body>
    <div id="box">
         <header>
                  <div style="width: 60%; height:100%; float:left; font-size: 40px; text-align: center">Strona główna</div>

                  <div id="user" style="width: 30%; height:50%; float: left; text-align: center">Użytkownik: </div>
<div id="uprawnienia" style="width: 10%; height:100%; float: right; text-align: center"><img src="https://www.wykop.pl/cdn/c3201142/comment_159770217020SffhYpG1fscWoH5V1chw.jpg" style="border: 0" width="100%" height="100%" alt=""></div> 
    
                   <div id="uprawnienia" style="width: 30%; height:50%; float: left; text-align: center">
                   Uprawienia:
                   <?php
                   include_once "loginForm/DBConnection.php";
                   include_once('loginForm/login.php');
                     if(isset($_SESSION['role']))
                     {                           
                     getRole();
                     }
                   ?>
                   </div>  
                    
	        </header>
         <div id="menu">
              <table border="0" class="menu">
                <tbody>
                  <tr style="height: 50px">
                    <td></td>
                  </tr>
                  <tr>
                    <td>Menu</td>
                  </tr>
                  <tr>
                    <td>Przejdź do sekcji:</td>
                  </tr>
                  <tr>
                    <td>
                    <a href="index.php">  
                    <input type="submit" value="Strona główna" style="width: 100%; height: 64px; background-color: lightblue">  
                    </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                    <a href="index.php?s=raporty">  
                    <input type="submit" value="Raporty" style="width: 100%; height: 64px; background-color: lightblue">  
                    </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                    <a href="index.php?s=przejazdy">  
                    <input type="submit" value="Przejazdy" style="width: 100%; height: 64px; background-color: lightblue">  
                    </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                    <a href="index.php?s=systemUsers">  
                    <input type="submit" value="Użytkownicy Systemu" style="width: 100%; height: 64px; background-color: lightblue">  
                    </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                    <a href="index.php?s=warsztat">  
                    <input type="submit" value="Warsztat" style="width: 100%; height: 64px; background-color: lightblue">  
                    </a>
                    </td>
                  </tr>
                </tbody>
              </table>
         </div>
         <div id="main">
              <?php
              if(isset($_GET['s']))
              {
              switch($_GET['s'])
                {
                 case "raporty":
                      include_once "raporty.php";
                      raport();
                      break;
                 case "przejazdy":
                      include_once "przejazdy.php";
                      przejazd();
                      break;
                 case "systemUsers":
                      include_once "systemUsers.php";
                      systemUsers();
                      break;
                 case "warsztat":
                      include_once "warsztat.php";
                      warsztat();
                      break;
                }
              } else
              {
                if(!isset($_SESSION['role']))
                {
                print('
                <form action="" method="post">
                  <table border="0">
                    <tbody>
                      <tr>
                        <td><input name="log" type="submit" value="Zaloguj"></td>
                      </tr>
                      <tr>
                        <td><input name="new" type="submit" value="Zarejestruj"></td>
                      </tr>
                    </tbody>
                  </table>
                </form>
                ');
                if(isset($_POST['log']))
                {
                print(loginForm());
                }
                if(isset($_POST['new']))
                {
                print(registerForm());
                }
                } else
                {
                print(logoutForm());
                }
                
              }
              ?>
              </form>
         </div> 
    </div>
  </body>
</html>
