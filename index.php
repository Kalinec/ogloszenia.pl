<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once("dao/dao.php");
        require_once("view/view.php");
        require_once("model/model.php");
        require_once("controller/controller.php");
        
        $dao = new Baza('localhost','root','','projekt');
        $Model=new Model($dao);
        $productController = new Controller($Model);
        
        $page='';
        if(isset($_GET['page']))
            $page=$_GET['page'];
        
        echo $productController->display($page);
        ?>
    </body>
</html>
