<?php
    include_once 'backend\RezerwacjaDTO.php';
    include_once 'backend\DBConnector.php';
    include_once 'backend\PrzejazdDAO.php';

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
            if($index == 0)
            {
                return null;
            }
            return $rezerwacje;
        }

        public function pobierzRezerwacjeZData($Data)
        {
            $connection = new DBConnector();
            $rezerwacje[] = new RezerwacjaDTO();
            $przejazdyDAO = new PrzejazdDAO();

            $przejazdy = $przejazdyDAO->pobierzPrzejazdyZData($Data);
            $j=0;
            for($i=0;$i<count($przejazdy);$i++)
            {
               $rezerwacjePrzejazdu = $this->pobierzRezerwacjeDlaPrzejazdu($przejazdy[$i]->id);
               for($k=0; $k<count($rezerwacjePrzejazdu); $k++)
               {
                    $rezerwacje[$j] = new RezerwacjaDTO();
                    $rezerwacje[$j]->id = $rezerwacjePrzejazdu[$k]->id;
                    $rezerwacje[$j]->idOsoby = $rezerwacjePrzejazdu[$k]->idOsoby;
                    $rezerwacje[$j]->idPrzejazdu = $rezerwacjePrzejazdu[$k]->idPrzejazdu;
                    $rezerwacje[$j]->potwierdzono = $rezerwacjePrzejazdu[$k]->potwierdzono;
                    $j++;
               }
            }
            return $rezerwacje;
        }

        public function potwierdzRezerwacje($Id)//tutaj DTO przejazd
        {
            $connection = new DBConnector();
            //"UPDATE `przejazd` SET `dataPrzejazdu` = '$przejazdDTO->data'
            $query="UPDATE `rezerwacja` SET potwierdzono = '1' WHERE id = $Id ";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            return $result;
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

