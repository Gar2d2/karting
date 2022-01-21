<?php
    include_once 'backend\OsobaDTO.php';
    include_once 'backend\DBConnector.php';
    class OsobaDAO
    {
        
        public function pobierzOsobePoID($osobaID)
        {
            $connection = new DBConnector();
            $osoba = new OsobaDTO();
            $query="SELECT * FROM `osoba` WHERE id = '$osobaID'";
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
            }
            return $osoba;
        }
    }
?>

