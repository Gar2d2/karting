<!DOCTYPE html>
<html lang="pl">
  <head>
    <script src="./ScriptJs/timedate.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Tor karingowy</title>
    <meta charset="UTF-8">
    <meta name="Generator" content="JTHTML 8.6">
    <meta name="Robots" content="index">
    <link rel="Stylesheet" href="css/css.css" type="text/css">
  </head>
  <body>
    <div id="box">
      <header>
        <div style="width: 60%; height:100%; float:left; font-size: 40px; text-align: center">Tor karingowy</div>
        <div id="user" style="width: 30%; height:50%; float: left; text-align: center">Użytkownik: <?php
				  include_once "loginForm/DBConnection.php";
				  include_once ('loginForm/login.php');
          include_once "backend\przejazdDTO.php";
			    include_once "backend\przejazdDAO.php";
			    include_once "backend\RezerwacjaDAO.php";
			    include_once "backend\RezerwacjaDTO.php";
			    include_once "backend\OsobaDAO.php";
			    include_once "backend\OsobaDTO.php";
          include_once 'backend\SekcjaDTO.php';
          include_once 'backend\SekcjaDAO.php';
          include_once 'backend\RaportDTO.php';
          include_once 'backend\RaportDAO.php';
				  if (isset($_SESSION['login']))
					{
						getLogin();
					}
				  ?> </div>
        <div id="uprawnienia" style="width: 10%; height:100%; float: right; text-align: center">
		  <?php
		 if (isset($_SESSION['login']))
					{
						
		  $osobaDAO = new OsobaDAO();
		  $zdjecie = $osobaDAO->pobierzZdjeciePoPseudonimie($_SESSION['login']);
		   print("
          <img src='$zdjecie' style='border: 0' width='100%' height='100%'>");
					}
		  ?>
        </div>
        <div id="uprawnienia" style="width: 30%; height:50%; float: left; text-align: center"> Uprawienia: <?php

if (isset($_SESSION['role']))
{
    getRole();
}
?> </div>
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
            </tr> <?php 
			      if(isset($_SESSION['login']))
				  {
					  print('<tr>
														<td>
															<a href="index.php?s=przejazdy">
																<input type="submit" value="Przejazdy" style="width: 100%; height: 64px; background-color: lightblue">
																</a>
															</td>
														</tr>');
				  }
				  if(isset($_SESSION['login']) and $_SESSION['role'] != "UZYTKOWNIK")
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
																</tr> '); 	
				  }
				  ?>
          </tbody>
        </table>
      </div>
      <div id="main"> <?php

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
		case "zarzadzajRaportami":
			include_once "raporty/zarzadzajRaportami.php";
		break;
		case "su":
			include_once "systemUsers/su.php";
		break;
		case "naprawy":
			include_once "warsztat/naprawy.php";
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
			
			print("
														<h2> Dziękujemy za zarezerwowanie przejazdu na dzień $przejazdDTO->data na godzinę $przejazdDTO->godzinaRozpoczecia! Pamiętaj aby zjawić się 15 minut przed rozpoczęciem biegu</h2>");

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
        if(isset($_GET['del']))
        {
         $osobaDAO = new osobaDAO();
         $osobaDAO->usunUprawnienia($_GET['uid']);
		$_GET['su'] = "t";
		header( "Location: index.php?s=su" );
        }
        
        if(isset($_GET['edy']))
        {
				 include_once "systemUsers\Edycja.php";
				 
        }
        if(isset($_GET['uEdit']))
        {
         $osobaDAO = new osobaDAO();
         $osobaDAO->edytujOsobe($_GET['id'], $_GET['pseudonim'], $_GET['imie'], $_GET['nazwisko'], $_GET['haslo'], $_GET['uprawnienia'], $_GET['zdjecie']);
		 
		$_GET['su'] = "t";
		header( "Location: index.php?s=su" );
        }
       	if (!isset($_SESSION['role']))
            {
                print ('
                
														<form action="" method="post">
															<table border="0">
																<tbody>
																	<tr>
																		<td>
																			<input name="log" type="submit" value="Zaloguj">
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<input name="new" type="submit" value="Zarejestruj">
																				</td>
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
                if(isset($_GET['podglad']))
                {
                 $sekcjaDAO = new sekcjaDAO();
                 $raporty = $sekcjaDAO->pobierzSekcjeDlaRaportu($_GET['rid']);
                 $osobaDAO = new osobaDAO();
                 $osoba = $osobaDAO->pobierzOsobePoPseudonimie($_SESSION['login']);
                 $osobaID = $osoba->id;
                 $osobaUprawnienia = $osoba->uprawnienia;
                 if($osobaUprawnienia == "KIEROWNIK")
                 {
                  if(count($raporty) > 0)
                  {
                   $rDAO = new raportDAO();
                   $r = $rDAO->pobierzRaportyZID($_GET['rid']);
                   print("
																<table border='1'>
																	<tbody>
																		<tr>
																			<td colspan='3' style='text-align: center'>$r->dataUtworzenia</td>
																		</tr>
																		<tr>
																			<td>Autor</td>
																			<td>Tytuł</td>
																			<td>Treść</td>
																		</tr>");
                  foreach($raporty as $raport)
                  {
                  $autor = $osobaDAO->pobierzOsobePoID($raport->idOsoby);                
                   print(" 
																		<tr>
																			<td>$autor->imie $autor->nazwisko</td>
																			<td>$raport->tytul</td>
																			<td>$raport->tresc</td>
																		</tr>");
                  }
                   print("
																	</tbody>
																</table");
                  }
                 } else
                 { if(count($raporty) > 0)
                  {
                   $rDAO = new raportDAO();
                   $r = $rDAO->pobierzRaportyZID($_GET['rid']);
                   print("
																<table border='1'>
																	<tbody>
																		<tr>
																			<td colspan='3' style='text-align: center'>$r->dataUtworzenia</td>
																		</tr>
																		<tr>
																			<td>Autor</td>
																			<td>Tytuł</td>
																			<td>Treść</td>
																		</tr>");
                  foreach($raporty as $raport)
                  {
                  
                  if($raport->idOsoby == $osobaID)
                  {
                   $autor = $osobaDAO->pobierzOsobePoID($raport->idOsoby);                
                   print(" 
																		<tr>
																			<td>$autor->imie $autor->nazwisko</td>
																			<td>$raport->tytul</td>
																			<td>$raport->tresc</td>
																		</tr>");
                  }
                  }
                   print("
																	</tbody>
																</table");
                  }
                 }
                } else if(isset($_GET['raportEdit']))
                {
                 include_once("raporty\EditRaport.php");                         
                } 
                if(isset($_GET['saveRaport']))
                {
                 $sekcjaDAO = new sekcjaDAO();
                 $sekcjaDTO = new sekcjaDTO();
                 $sekcjaDTO->id = $_GET['sid'];
                 $sekcjaDTO->tytul = $_GET['tytul'];
                 $sekcjaDTO->tresc = $_GET['tresc'];
                 $sekcjaDAO->modyfikujSkecje($sekcjaDTO);
                } 
                 if(isset($_GET['addRaport']))
                {
                 include_once("raporty\AddRaport.php");   
                }
                if(isset($_GET['ar']))
                {
                 $sekcjaDAO = new sekcjaDAO();
                 $sekcjaDTO = new sekcjaDTO();            
                 $sekcjaDTO->tytul = $_GET['tytul'];
                 $sekcjaDTO->tresc = $_GET['tresc'];
                 $osobaDAO = new osobaDAO();
                 $osoba = $osobaDAO->pobierzOsobePoPseudonimie($_SESSION['login']);
                 $osobaID = $osoba->id;
                 $sekcjaDTO->idOsoby = $osobaID;
                 $raportDAO = new raportDAO();
				 
                 $today = date('Y-m-d', strtotime("now"));
                 $raportID = $raportDAO->pobierzRaportyZData($today)[0]->id;
				 if(empty($raportID))
				 {
				 $raportDAO->dodajRaport();	 
                 $raportID = $raportDAO->pobierzRaportyZData($today)[0]->id;
                 $sekcjaDTO->idRaportu = $raportID;
                 $sekcjaDAO->dodajSekcje($sekcjaDTO);
				 } else
				 {
                 $sekcjaDTO->idRaportu = $raportID;
                 $sekcjaDAO->dodajSekcje($sekcjaDTO);
				 }
				 $_GET['zarzadzajRaportami'] = "t";
			     header( "Location: index.php?s=zarzadzajRaportami" );
                }
                if(isset($_GET['repair']))
                {                         
                 include_once "warsztat\EditNaprawy.php";
                }
                if(isset($_GET['setRepair']))
                {                         
                 include_once "backend\NaprawyDAO.php";
                 include_once "backend\NaprawyDTO.php";
                 $naprawyDAO = new naprawyDAO();
                 $naprawyDAO->aktualizacjaNaprawy($_GET['rid'], $_GET['status']);
                }
                if(isset($_GET['newRepair']))
                {
                
                 include_once "warsztat\NowaNaprawa.php";
                }
                if(isset($_GET['addNewRepair']))
                {
                 include_once "backend\NaprawyDAO.php";
                 include_once "backend\NaprawyDTO.php";
                 $today = date("Y-m-d", strtotime("now"));
                 $naprawyDAO = new naprawyDAO();
                 $osobaDAO = new osobaDAO();
                 $osoba = $osobaDAO->pobierzOsobePoPseudonimie($_SESSION['login']);
                 $osobaID = $osoba->id;
                 $naprawyDAO->dodajNowa($today, $_GET['idKart'], $osobaID, $_GET['usterka']);
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

}
if(isset($_GET['uczestnik1']))
{
 echo 'tu zrobić zapisywanie do bazy';
}
?> </form>
      </div>
    </div>
  </body>
</html>
