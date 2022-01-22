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

                  <div id="user" style="width: 30%; height:50%; float: left; text-align: center">Użytkownik: 
				  <?php
				  include_once "loginForm/DBConnection.php";
				  include_once ('loginForm/login.php');
				  if (isset($_SESSION['login']))
					{
						getLogin();
					}
				  ?>
				  
				  </div>
<div id="uprawnienia" style="width: 10%; height:100%; float: right; text-align: center"><img src="https://www.wykop.pl/cdn/c3201142/comment_159770217020SffhYpG1fscWoH5V1chw.jpg" style="border: 0" width="100%" height="100%" alt=""></div> 
    
                   <div id="uprawnienia" style="width: 30%; height:50%; float: left; text-align: center">
                   Uprawienia:
                   <?php

if (isset($_SESSION['role']))
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
				  <?php 
				  if(isset($_SESSION['login']))
				  {
					  print('
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
                    <a href="index.php?s=sysetmUsers">  
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
                  </tr> '); 	
				  }
				  ?>
                </tbody>
              </table>
         </div>
         <div id="main">
              <?php

              #include_once 'backend\OsobaDAO.php';
              #$osobaDAO = new OsobaDAO();
              #$osobaDTO = $osobaDAO->pobierzOsobePoID(1);
              #print($osobaDTO->id);
              #print($osobaDTO->pseudonim);
              #print($osobaDTO->haslo);
              #print($osobaDTO->imie);
              #print($osobaDTO->nazwisko);
              #print($osobaDTO->uprawnienia);

if (isset($_GET['s']))
{
    switch ($_GET['s'])
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
        case "rezerwacja":
            include_once "przejazdy/rezerwacja.php";
        break;
        case "nieukPrzejazdy":
            include_once "przejazdy/nieukPrzejazdy.php";
        break;
		case "acceptRezerwacja":
			include_once "przejazdy/acceptRezerwacja.php";
		break;
		case "zakonczonePrzejazdy":
			include_once "przejazdy/zakonczonePrzejazdy.php";
		break;
    }
}
else
{
    if (isset($_GET['data']))
    {
        include_once "przejazdy/rezerwacjaGodzina.php";
        rezerwuj($_GET['data']);
    }
    else
    {
        if (isset($_GET['startH']))
        {
			include_once "backend\przejazdDTO.php";
			include_once "backend\przejazdDAO.php";
			include_once "backend\RezerwacjaDAO.php";
			include_once "backend\RezerwacjaDTO.php";
			include_once "backend\OsobaDAO.php";
			include_once "backend\OsobaDTO.php";
			$przejazdDTO = new PrzejazdDTO();
			$przejazdDTO->id = NULL;
			$przejazdDTO->data = $_GET['dat'];
			$przejazdDTO->godzinaRozpoczecia = $_GET['startH'];
			$przejazdDTO->godzinaZakonczenia = $_GET['endH'];
			$przejazdDAO = new PrzejazdDAO();
			$przejazdDAO->dodajPrzejazd($przejazdDTO);
            #echo $przejazdDTO->data;
			$osobaDTO = new OsobaDTO();
			$osobaDAO = new OsobaDAO();
		
			$osobaDTO = $osobaDAO->pobierzOsobePoPseudonimie($_SESSION['login']);
			$przejazd2 = $przejazdDAO->pobierzPrzejazdZDataIGodzina($przejazdDTO->data, $przejazdDTO->godzinaRozpoczecia);
			$rezerwacjaDTO = new rezerwacjaDTO();
			$rezerwacjaDTO->id = NULL; 
			$rezerwacjaDTO->idOsoby = $osobaDTO->id;
			$rezerwacjaDTO->idPrzejazdu = $przejazd2->id;
			$rezerwacjaDTO->potwierdzono = 0; #0 - nie, 1 - tak;
			$rezerwacjaDAO = new rezerwacjaDAO();
			$rezerwacjaDAO->dodajRezerwacje($rezerwacjaDTO);
			
			print("<h2> Dziękujemy za zarezerwowanie przejazdu na dzień $przejazdDTO->data na godzinę $przejazdDTO->godzinaRozpoczecia! Pamiętaj aby zjawić się 15 minut przed rozpoczęciem biegu</h2>");

        }
        else
        {
			if(isset($_GET['rez']))
			{
				include_once "backend\RezerwacjaDTO.php";
				include_once "backend\RezerwacjaDAO.php";
				$rezerwacjaDAO = new rezerwacjaDAO();
				$rezerwacjaDAO->potwierdzRezerwacje($_GET['rez']);
				
			} else
			{
       if(isset($_GET['detail']))
       {
        
				include_once "backend\ZakonczoneDAO.php";
				include_once "backend\ZakonczoneDTO.php";
        $zakonczoneDAO = new zakonczoneDAO();
        $zakonczoneDAO->pokazSzczegoly($_GET['detail']);
       } else
       {
       	if (!isset($_SESSION['role']))
            {
                print ('
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
                if (isset($_POST['log']))
                {
                    print (loginForm());
                }
                if (isset($_POST['new']))
                {
                    print (registerForm());
                }
            }
            else
            {
                print (logoutForm());
            }
       }
			
			}
        }

    }

}
if(isset($_GET['uczestnik1']))
{
 echo 'tu zrobić zapisywanie do bazy';
}
?>
              </form>
         </div> 
    </div>
  </body>
</html>

