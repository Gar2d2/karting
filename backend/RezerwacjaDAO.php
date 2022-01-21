<?php
    include_once 'backend\RezerwacjaDTO.php';
    class RezerwacjaDAO
    {
        
        public function pobierzRezerwacjeDlaPrzejazdu($przejazdId)
        {
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = '';
            $baza = 'tor_kartingowy';
            
            $link = mysqli_connect($dbhost, $dbuser, $dbpass, $baza);
            $rezerwacje[] = new RezerwacjaDTO();
            $index = 0;
            $query="SELECT * FROM `rezerwacja` WHERE idPrzejazdu='$przejazdId'";
            $result = mysqli_query($link, $query);
            if($result)
            {
                while($row = mysqli_fetch_array($result))
                {
                    $rezerwacje[$index] = new RezerwacjaDTO();
                    $rezerwacje[$index]->id = $row['id'];
                    $rezerwacje[$index]->idOsoby = $row['idOsoby'];
                    $rezerwacje[$index]->idPrzejazdu = $row['idPrzejazdu'];
                    $rezerwacje[$index]->potwierdzono = $row['potwierdzono'];
                    $index++;
                }
            }
            return $rezerwacje;
        }
    }
?>

