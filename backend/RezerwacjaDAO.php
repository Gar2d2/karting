<?php
    include_once 'backend\RezerwacjaDTO.php';
    include_once 'backend\DBConnector.php';
    class RezerwacjaDAO
    {
        
        public function pobierzRezerwacjeDlaPrzejazdu($przejazdId)
        {
            $connection = new DBConnector();
            $rezerwacje[] = new RezerwacjaDTO();
            $index = 0;
            $query="SELECT * FROM `rezerwacja` WHERE idPrzejazdu='$przejazdId'";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
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

        public function dodajRezerwacje($rezerwacjaDTO)//tutaj DTO przejazd
        {
            $connection = new DBConnector();
            $query="INSERT INTO `rezerwacja` (`id`, `idOsoby`, `idPrzejazdu`, `potwierdzono`) VALUES (NULL, '$rezerwacjaDTO->idOsoby', '$rezerwacjaDTO->idPrzejazdu', '$rezerwacjaDTO->potwierdzono');";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            return $result;
        }
    }
?>

