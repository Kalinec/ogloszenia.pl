<?php
class Model
{
    protected $dao;
    
    function __construct($dao) 
    {
        $this->dao = $dao;
    }
    
    function logowanie($login,$haslo)
    {
        //$sql = "SELECT * FROM `users` WHERE login='$login' AND haslo='$haslo'";
        $sql = "SELECT * FROM `users` WHERE login='$login'";
        $sql2 = "UPDATE `users` SET `logowanie` = '".time()."', `ip` = '".$_SERVER['REMOTE_ADDR']."' WHERE login = '".$login."'";
        
        if($rezultat = $this->dao->getMysqli($sql))
        {
            $ilu_userow = $rezultat->num_rows;
            if($ilu_userow>0)
            {
                $wiersz = $rezultat->fetch_assoc(); //przynies dane i wloz je do tablicy asocjacyjnej
                
                if(!password_verify($haslo, $wiersz['haslo'])) //sprawdzamy czy podane haslo pasuje do hasla podanego w bazie
                        return $id="";
                
                $id=$wiersz['idUser'];
                $this->dao->getMysqli($sql2); //aktualizujemy dane o ostatnim logowaniu i adresie ip
                $rezultat->free_result();
            }
            else
            {
                $id="";
            }
        }
        
        return $id;
    }
    
    function rejestracja($login,$email,$haslo1,$haslo2,$captcha)
    {
            $wszystko_OK=true;
            
            //obsluga captcha
            $sekret = "6Lcsj0AUAAAAAACPoyDfNF5HfVpf6sRnCcrNyudn";
            
            $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$captcha);
            
            $odpowiedz = json_decode($sprawdz);
            
            if ($odpowiedz->success==false)
            {
		$wszystko_OK=false;
		$_SESSION['komunikat_rejestracji']="Potwierdź, że nie jesteś botem!";
            }
            
            //sprawdz poprawnosc hasla
            if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
            {
                $wszystko_OK=false;
		$_SESSION['komunikat_rejestracji']="Hasło musi posiadać od 8 do 20 znaków!";
            }
		
            if ($haslo1!=$haslo2)
            {
		$wszystko_OK=false;
		$_SESSION['komunikat_rejestracji']="Podane hasła nie są identyczne!";
            }
            
            // Sprawdź poprawność adresu email
            $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
            if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
            {
		$wszystko_OK=false;
		$_SESSION['komunikat_rejestracji']="Podaj poprawny adres e-mail!";
            }
            
            //sprawdzenie czy w nicku znajduja się polskie znaki
            if(ctype_alnum($login)==false)
            {
                $wszystko_OK=FALSE;
                $_SESSION['komunikat_rejestracji']="Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
            }
            
            //sprawdzanie dlugosci nicka
            if((strlen($login)<3) || (strlen($login)>20))
            {
                $wszystko_OK=false;
                $_SESSION['komunikat_rejestracji']="Nick musi posiadać od 3 do 20 znaków!";
            }   

            
            $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
            
            
            //sprawdzenia w bazie
            //
            //
            //
            //Czy email już istnieje?
            $rezultat = $this->dao->getMysqli("SELECT idUser FROM users WHERE email='$email'");
				
		$ile_takich_maili = $rezultat->num_rows;
		if($ile_takich_maili>0)
		{
                    $wszystko_OK=false;
                    $_SESSION['komunikat_rejestracji']="Istnieje już konto przypisane do tego adresu e-mail!";
		}
                
                
            //Czy nick jest już zarezerwowany?
            $rezultat = $this->dao->getMysqli("SELECT idUser FROM users WHERE login='$login'");
				
				
                $ile_takich_nickow = $rezultat->num_rows;
            if($ile_takich_nickow>0)
            {
		$wszystko_OK=false;
		$_SESSION['komunikat_rejestracji']="Istnieje już gracz o takim nicku! Wybierz inny.";
            }
            
            if($wszystko_OK==true)
            {
                if($this->dao->getMysqli("INSERT INTO users VALUES (NULL,'$login','$haslo_hash','$email','".time()."',0,'".$_SERVER['REMOTE_ADDR']."')"))
                {
                    $_SESSION['komunikat_rejestracji']="Rejestracja przebiegła pomyślnie!";
                }
            }
    }
    
    function dodawanie($tytul,$telefon,$tresc,$edycja)
    {
        
            $wszystko_OK=true;
            
            //sprawdzenie dlugosci tytulu
            if((strlen($tytul)<5) || (strlen($tytul)>100))
            {
                $wszystko_OK=false;
                $_SESSION['komunikat_dodawania']="Tytuł musi posiadać od 5 do 100 znaków!";
            }
            
            if((strlen($telefon) != 9))
            {
                $wszystko_OK=false;
                $_SESSION['komunikat_dodawania']="Numer musi się składać z 9 cyfr!";
            }
            
            if(ctype_digit($telefon)==false)
            {
                $wszystko_OK=FALSE;
                $_SESSION['komunikat_dodawania']="Numer telefonu musi posiadać tylko cyfry!";
            }
            
           if((strlen($tresc)<5) || (strlen($tresc)>255))
           {
                $wszystko_OK=false;
                $_SESSION['komunikat_dodawania']="Treść musi posiadać od 5 do 255 znaków!";
           }
                    

            //zapisanie do bazy danych
            if($wszystko_OK==true && $_SESSION['edycja']==false)
            {
                if($this->dao->getMysqli("INSERT INTO `ogloszenia` (`idOgloszenia`, `tytul`, `tresc`, `idUser`, `data`, `telefon`) VALUES (NULL, '".$tytul."', '".$tresc."', '".$_SESSION['id']."', '".date("Y-m-d")."', '".$telefon."')"))
                {
                    unset($_SESSION['edycja']);
                }
            }
            
            else if($wszystko_OK==true && $_SESSION['edycja']==true)
            {
                if($this->dao->getMysqli("UPDATE `ogloszenia` SET `tytul` = '".$tytul."', `tresc`='".$tresc."', `data`='".date("Y-m-d")."', `telefon`='".$telefon."' WHERE `ogloszenia`.`idOgloszenia`=".$_SESSION['id_ogloszenia'].""))
                {
                    unset($_SESSION['edycja']);
                    unset($_SESSION['id_ogloszenia']);
                }
            }
                      
    }
    
    function twoje_ogloszenia()
    {
        $sql = "SELECT * FROM `ogloszenia` WHERE `idUser`='".$_SESSION['id']."' ORDER BY `idOgloszenia` DESC";
        if($rezultat = $this->dao->getMysqli($sql))
        {
            $ilu_userow = $rezultat->num_rows;
            for($i=0; $i<$ilu_userow; $i++)
            {
                $wiersz = $rezultat->fetch_assoc(); //przynies dane i wloz je do tablicy asocjacyjnej
                $tablica[$i]=$wiersz;
            }    
        }
        
        if(!isset($tablica)) $tablica=0;
        $rezultat->free_result();
        return $tablica;
    }
    
    function ogloszenia()
    {
        $sql = "SELECT * FROM `ogloszenia` ORDER BY `idOgloszenia` DESC";
        
        if($rezultat = $this->dao->getMysqli($sql))
        {
            for($i=0; $i<$rezultat->num_rows; $i++)
            {
                $wiersz = $rezultat->fetch_assoc();
                $tablica[$i]=$wiersz;
            }
        }
        if(!isset($tablica)) $tablica=0;
        $rezultat->free_result();
        return $tablica;
    }
    
    function edytuj($id)
    {
        $sql = "SELECT * FROM `ogloszenia` WHERE `idUser`='".$_SESSION['id']."' AND `idOgloszenia`='".$id."'";
        
        if($rezultat = $this->dao->getMysqli($sql))
            $wiersz = $rezultat->fetch_assoc();
            
        $rezultat->free_result();
        return $wiersz;
    }
    
    function usun($id)
    {
        $sql = 'DELETE FROM `ogloszenia` WHERE `ogloszenia`.`idOgloszenia`='.$id;
        
        if($this->dao->getMysqli($sql))
            return true;
        return false;
    }
}
?>

