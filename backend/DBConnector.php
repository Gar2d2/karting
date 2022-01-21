<?php
    class DBConnector
    {
        public $dbhost = 'localhost';
        public $dbuser = 'root';
        public $dbpass = '';
        public $baza = 'tor_kartingowy';
        public $link;

        public function GetBazaConnection()
        {
            $this->link = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->baza);
            return $this->link;
        }
    }
?>
