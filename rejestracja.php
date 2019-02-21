<?php
        session_start();
        
        require_once("dao/dao.php");
        require_once("view/view.php");
        require_once("model/model.php");
        require_once("controller/controller.php");
        
        $dao = new Baza('localhost','root','','projekt');
        $model=new Model($dao);
        if(isset($_POST['login']))
        {
            $login=$_POST['login'];
            $email=$_POST['email'];
            $haslo1=$_POST['haslo1'];
            $haslo2=$_POST['haslo2'];
            $captcha=$_POST['g-recaptcha-response'];
        }
        $haslo_hash=password_hash($haslo1, PASSWORD_DEFAULT);
        $model->rejestracja($login, $email, $haslo1, $haslo2, $captcha);
        header('Location: index.php?page=rejestracja');
        
                
       
?>