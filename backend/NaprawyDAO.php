<?php
    include_once 'backend/NaprawyDTO.php';
    include_once 'backend/DBConnector.php';
    class NaprawyDAO
    {

        public function pobierzNaprawy()
        {
            $connection = new DBConnector();
            $naprawy[] = new NaprawyDTO();
            $index = 0;
            $query="SELECT * FROM `naprawy`";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            if($result)
            {
                while($row = mysqli_fetch_array($result))
                {
                    #print($row['id']);
                    $naprawy[$index] = new NaprawyDTO();
                    $naprawy[$index]->id = $row['id'];
                    $naprawy[$index]->dataRozpoczecia = $row['dataRozpoczecia'];
                    $naprawy[$index]->dataZakonczenia = $row['dataZakonczenia'];
                    $naprawy[$index]->stanNaprawy = $row['stanNaprawy'];
                    $naprawy[$index]->idKarta = $row['id_kart'];
                    $naprawy[$index]->idOsoby = $row['id_osoba'];
                    $naprawy[$index]->usterka = $row['usterka'];
                    $index++;
                }
            }
            return $naprawy;
        }


        public function pobierzNaprawepoID($id)
        {
            $connection = new DBConnector();
            $query="SELECT * FROM `naprawy` WHERE id = '$id'";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            if($result)
            {
                while($row = mysqli_fetch_array($result))
                {
                    #print($row['id']);
                    $naprawa = new NaprawyDTO();
                    $naprawa->id = $row['id'];
                    $naprawa->dataRozpoczecia = $row['dataRozpoczecia'];
                    $naprawa->dataZakonczenia = $row['dataZakonczenia'];
                    $naprawa->stanNaprawy = $row['stanNaprawy'];
                    $naprawa->idKarta = $row['id_kart'];
                    $naprawa->idOsoby = $row['id_osoba'];
                    $naprawa->usterka = $row['usterka'];
                }
            }
            return $naprawa;
        }
        public function aktualizacjaNaprawy($id, $status)
        {
            $connection = new DBConnector();
            $query="UPDATE `naprawy` SET `stanNaprawy` = '$status' WHERE `naprawy`.`id` = $id;";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            return 1;
        }


        public function dodajNowa($data, $id_kart, $id_osoba, $usterka)
        {
            $connection = new DBConnector();
            $query="INSERT INTO `naprawy` (`id`, `dataRozpoczecia`, `dataZakonczenia`, `stanNaprawy`, `id_kart`, `id_osoba`, `usterka`) VALUES (NULL, '$data', NULL, 'NOWA', '$id_kart', '$id_osoba', '$usterka');";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            return 1;
        }

    }
?>

