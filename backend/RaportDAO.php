<?php
    include_once 'backend\RaportDTO.php';
    include_once 'backend\DBConnector.php';
    class RaportDAO
    {
    
     public function pobierzRaporty()
        {
            $connection = new DBConnector();
            $raporty[] = new RaportDTO();
            $index = 0;
            $query="SELECT * FROM `raport`";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            if($result)
            {
                while($row = mysqli_fetch_array($result))
                {
                    $raporty[$index] = new RaportDTO();
                    $raporty[$index]->id = $row['id'];
                    $raporty[$index]->dataUtworzenia = $row['dataUtworzenia'];
                    $index++;
                }
            }
            return $raporty;
        }

        
        public function pobierzRaportyZData($dataUtworzenia)
        {
            $connection = new DBConnector();
            $raporty[] = new RaportDTO();
            $index = 0;
            $query="SELECT * FROM `raport` WHERE dataUtworzenia='$dataUtworzenia'";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            if($result)
            {
                while($row = mysqli_fetch_array($result))
                {
                    #print($row['id']);
                    $raporty[$index] = new RaportDTO();
                    $raporty[$index]->id = $row['id'];
                    $raporty[$index]->dataUtworzenia = $row['dataUtworzenia'];
                    $index++;
                }
            }
            return $raporty;
        }
		
		public function pobierzRaportyZID($id)
        {
            $connection = new DBConnector();
            $raport = new RaportDTO();
            $query="SELECT * FROM `raport` WHERE id='$id' LIMIT 1";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            if($result)
            {
                while($row = mysqli_fetch_array($result))
                {
                    #print($row['id']);
                    $raport = new PrzejazdDTO();
                    $raport->id = $row['id'];
                    $raport->dataUtworzenia = $row['dataUtworzenia'];
                }
            }
            return $raport;
        }


        public function dodajRaport()//tutaj DTO przejazd
        {
            $connection = new DBConnector();
            $query="INSERT INTO `raport` (`id`, `dataUtworzenia`) VALUES (NULL, current_timestamp())";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            return $result;
        }
    }
?>

