<?php
class Baza 
{
    private $mysqli; //uchwyt do BD
 
    
    public function __construct($serwer, $user, $pass, $baza) 
    {
        $this->mysqli = new mysqli($serwer, $user, $pass, $baza);
        if($this->mysqli->connect_errno)
        {
            printf("Nie udało się połączenie z serwerem: %s\n".$this->mysqli->connect_error);
            exit();
        }
        if($this->mysqli->set_charset("utf8"))
        {
            //udalo sie zmienic kodowanie
        }
    }
    
    function __destruct() 
    {
        $this->mysqli->close();
    }
    
    function getMysqli($sql) //pobiera wynik zapytania i go zapisuje
    {
        return $this->mysqli->query($sql); 
    }  
}
?>