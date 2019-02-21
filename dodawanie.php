   <?php
        session_start();
        
        require_once("dao/dao.php");
        require_once("view/view.php");
        require_once("model/model.php");
        require_once("controller/controller.php");
        
        $dao = new Baza('localhost','root','','projekt');
        $model=new Model($dao);
        $tytul = filtruj($_POST['tytul']);
        $telefon = filtruj($_POST['telefon']);
        $tresc = filtruj($_POST['tresc']);  
      
        if(isset($_POST['tytul']))
        {
            $tytul = filtruj($_POST['tytul']);
            $telefon = filtruj($_POST['telefon']);
            $tresc = filtruj($_POST['tresc']);  
        }
        
        $edycja=$_SESSION['edycja'];
        $model->dodawanie($tytul, $telefon, $tresc,$edycja);
        
        if($edycja && !isset($_SESSION['komunikat_dodawania']))
        {
            header('Location: index.php?page=twoje_ogloszenia');
            exit;
        }
        else if($edycja && isset($_SESSION['komunikat_dodawania']))
        {
            header('Location: index.php?page=edytuj&id='.$_SESSION['id_ogloszenia']);
            exit;
        }
        else
        {
            if(isset($_SESSION['komunikat_dodawania']))
                header("Location: index.php?page=dodaj");
            else
                header("Location: index.php?page=twoje_ogloszenia");
        }
        
        function filtruj($zmienna)
        {   
            if(get_magic_quotes_gpc())
                $zmienna = stripslashes($zmienna); // usuwamy slashe
 
            // usuwamy spacje, tagi html oraz niebezpieczne znaki
            return htmlspecialchars(trim($zmienna));
        }
  ?>