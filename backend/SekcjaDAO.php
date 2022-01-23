<?php
    include_once 'backend\SekcjaDTO.php';
    include_once 'backend\DBConnector.php';
    class SekcjaDAO
    {
    
     public function pobierzSekcjeDlaRaportu($raportID)
        {
            $connection = new DBConnector();
            $sekcje[] = new SekcjaDTO();
            $index = 0;
            $query="SELECT * FROM `sekcja` WHERE idRaportu = '$raportID'";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            if($result)
            {
                while($row = mysqli_fetch_array($result))
                {
                    $sekcje[$index] = new SekcjaDTO();
                    $sekcje[$index]->id = $row['id'];
                    $sekcje[$index]->idRaportu = $row['idRaportu'];
                    $sekcje[$index]->idOsoby = $row['idOsoby'];
                    $sekcje[$index]->tytul = $row['tytul'];
                    $sekcje[$index]->tresc = $row['tresc'];
                    $index++;
                }
            }
            return $sekcje;
        }

        public function dodajSekcje($sekcjaDTO)//tutaj DTO przejazd
        {
            $connection = new DBConnector();
            $query="INSERT INTO `sekcja` (`id`, `idRaportu`, `idOsoby`, `tytul`, `tresc`) VALUES (NULL, '$sekcjaDTO->idRaportu', '$sekcjaDTO->idOsoby', '$sekcjaDTO->tytul', '$sekcjaDTO->tresc')";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            return $result;
        }
    }
?>

