<?php
include_once 'backend/DBConnector.php';
function loguj($login, $haslo)
{
    $connection = new DBConnector();
    $query="SELECT * FROM `osoba` WHERE pseudonim='$login' and haslo='$haslo'";
    $result = mysqli_query($connection->GetBazaConnection(), $query);
    if($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        if($row['haslo'] == $haslo)
        {
            return $row['uprawnienia'];
        }
    }
    return -1;
}
function rejestruj($imie, $nazwisko, $pseudonim, $haslo, $uprawnienia, $zdjecie)
{
    $connection = new DBConnector();
    $query="SELECT * FROM `osoba` WHERE pseudonim='$pseudonim'";
    $result = mysqli_query($connection->GetBazaConnection(), $query);
    //sprawdzenie czy nie ma juz kogos w bazie z takim pseudonimem 
    if(!$row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        $query="INSERT INTO `osoba` (`id`, `pseudonim`, `haslo`, `imie`, `nazwisko`, `uprawnienia`, `zdjecie`) VALUES (NULL, '$pseudonim', '$haslo', '$imie', '$nazwisko', '$uprawnienia', '$zdjecie')";
        $result = mysqli_query($connection->GetBazaConnection(), $query);
        return 1;
    }  
    return 0;
}
?>
