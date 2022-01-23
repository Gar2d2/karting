<?php
    include_once 'backend\OsobaDTO.php';
    include_once 'backend\DBConnector.php';
    class OsobaDAO
    {

        public function usunUprawnienia($id)
        {
            $connection = new DBConnector();
            $query="UPDATE `osoba` SET `uprawnienia` = 'UZYTKOWNIK' WHERE id = '$id'";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            return $result;
        }

        public function edytujOsobe($id, $pseudonim, $imie, $nazwisko, $haslo, $uprawnienia, $zdjecie)
        {
            $connection = new DBConnector();
            $query="UPDATE `osoba` SET `pseudonim` = '$pseudonim', `haslo` = '$haslo',`imie` = '$imie',`nazwisko` = '$nazwisko', `uprawnienia` = '$uprawnienia', `zdjecie`= 'zdjecie' WHERE id = '$id'";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            return $result;
        }
    

        public function pobierzOsoby()
        {
            $connection = new DBConnector();
            $osoby[] = new OsobaDTO();
            $index=0;
            $query="SELECT * FROM `osoba`";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            if($result)
            {
                while($row = mysqli_fetch_array($result))
                {
                $osoby[$index] = new OsobaDTO();
                $osoby[$index]->id = $row['id'];
                $osoby[$index]->pseudonim= $row['pseudonim'];
                $osoby[$index]->haslo= $row['haslo'];
                $osoby[$index]->imie= $row['imie'];
                $osoby[$index]->nazwisko= $row['nazwisko'];
                $osoby[$index]->uprawnienia= $row['uprawnienia'];
                $osoby[$index]->zdjecie= $row['zdjecie'];
                
                $index++;
                }
            }
            return $osoby;
        }
        
        public function pobierzOsobePoID($osobaID)
        {
            $connection = new DBConnector();
            $osoba = new OsobaDTO();
            $query="SELECT * FROM `osoba` WHERE id = '$osobaID'";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            if($result)
            {
                if($row = mysqli_fetch_array($result))
                {
                    $osoba->id = $row['id'];
                    $osoba->pseudonim= $row['pseudonim'];
                    $osoba->haslo= $row['haslo'];
                    $osoba->imie= $row['imie'];
                    $osoba->nazwisko= $row['nazwisko'];
                    $osoba->uprawnienia= $row['uprawnienia'];
                    $osoba->zdjecie= $row['zdjecie'];
                }
            }
            return $osoba;
        }

        public function pobierzOsobePoPseudonimie($pseudonim)
        {
            $connection = new DBConnector();
            $osoba = new OsobaDTO();
            $query="SELECT * FROM `osoba` WHERE pseudonim = '$pseudonim'";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            if($result)
            {
                $row = mysqli_fetch_array($result);
                $osoba->id = $row['id'];
                $osoba->pseudonim= $row['pseudonim'];
                $osoba->haslo= $row['haslo'];
                $osoba->imie= $row['imie'];
                $osoba->nazwisko= $row['nazwisko'];
                $osoba->uprawnienia= $row['uprawnienia'];
                $osoba->zdjecie= $row['zdjecie'];
            }
            return $osoba;
        }
    }
?>

