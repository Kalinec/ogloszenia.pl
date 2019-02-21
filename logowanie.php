   <?php
        session_start();
        
        require_once("dao/dao.php");
        require_once("view/view.php");
        require_once("model/model.php");
        require_once("controller/controller.php");
        
        $dao = new Baza('localhost','root','','projekt');
        $model=new Model($dao);
        $login = filtruj($_POST['login']);
        $haslo = filtruj($_POST['haslo']);
        $id=$model->logowanie($login, $haslo);  
      
        if($id!="") //jeżeli użytkownik istnieje w bazie
        {
            $_SESSION['login'] = $login; //zapisanie loginu
            $_SESSION['zalogowany'] = true;
            $_SESSION['id']=$id;
            
            header('Location: index.php'); //przekierowanie do index.php
            exit();
        }
        
        header('Location: index.php?page=blad_logowania');
        
        function filtruj($zmienna)
        {   
            if(get_magic_quotes_gpc())
                $zmienna = stripslashes($zmienna); // usuwamy slashe
 
            // usuwamy spacje, tagi html oraz niebezpieczne znaki
            return htmlspecialchars(trim($zmienna));
        }
  ?>