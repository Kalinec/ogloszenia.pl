

<?php
    class View
    {
        protected $model;
        
        function __construct($model)
        {
            $this->model=$model;
        }

 
        function wyswietl_naglowek()
        {
           echo '<!DOCTYPE html>
                <html lang="en" dir="ltr">
                <head>
                <title>Portal ogłoszeń lokalnych</title>
                <meta charset="utf-8">
                <link rel="stylesheet" href="styles/layout.css" type="text/css">
                <script src="https://www.google.com/recaptcha/api.js"></script>
                </head>
                <body>
                <div class="wrapper row1">
                  <header id="header" class="clear">
                    <div id="hgroup">
                      <h1><a href="index.php">ogloszenia.pl</a></h1>
                      <h2>Ogłoszenia lokalne</h2>
                    </div>
                    <nav>
                      <ul>';
                        
                        if(isset($_SESSION['zalogowany']))
                        {   echo "<li>Witaj ".$_SESSION['login']."</li>";
                            echo '<li class="last"><a href="wylogowanie.php">Wyloguj</a></li>';
                        }
                        else
                        {
                            echo'
                        <li><a href="index.php?page=logowanie">Logowanie</a></li>
                        <li class="last"><a href="index.php?page=rejestracja">Rejestracja</a></li>';
                        }
           echo'      </ul>
                    </nav>
                  </header>
                </div>
                <!-- content -->';
        }
        
        function wyswietl_stopka()
        {
            echo '
                <div class="wrapper row3">
                  <footer id="footer" class="clear">
                    <p class="fl_left">Copyright &copy; 2018 - Wszystkie prawa zastrzeżone - <a href="#">ogloszenia.pl</a></p>
                    <p class="fl_right">Template by <a href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
                  </footer>
                </div>
                </body>
                </html>';
        }
        
        function wyswietl_logowanie($error)
        {
            $this->brak_dostepu(true);
            echo'
            <div id="content">
                        <article>
              <h2>Formularz logowania:</h2><br />
              <form method="POST" action="logowanie.php"> 
              <table>
              <tr>
                <td><b>Login:<b/></td> <td><input type="text" name="login"></td>
              </tr>
              <tr>
                <td><b>Hasło:<b/></td><td> <input type="password" name="haslo"></td>
              </tr>
              <tr>
              </table>
                <input type="submit" value="Zaloguj" name="loguj">';
            
            if($error)
            {
                echo'<br/><span style="color:red">Nieprawidłowy login lub hasło!</span>';
            }
                
            echo'  </form>   
                </article>
                </div>
                </div>
                </div>';
        }
        
        function wyswietl_content()
        {
            echo'
                <div class="wrapper row2">
                <div id="container" class="clear">
                <section id="slider"><a href="#"><img src="images/naglowek.png" alt=""></a></section>
                <aside id="left_column">';
        
        if(isset($_SESSION['zalogowany']))
        {
            
        echo'
            <h2 class="title">Menu</h2>
            <nav>
              <ul>
                <li><a href="index.php?page=dodaj">Dodaj ogłoszenie</a></li>
                <li><a href="index.php?page=twoje_ogloszenia">Twoje ogłoszenia</a></li>
                <li class="last"><a href="index.php?page=ogloszenia">Wszystkie ogłoszenia</a></li>
              </ul>
            </nav>';
        }
        echo'
            <h2 class="title">Pozostań w kontakcie</h2>
            <section class="last">
              <address>
              Karol Kozak<br>
              Lublin<br>
              ul. Nadbystrzycka 53/5<br>
              20-501 Lublin<br>
              <br>
              Tel: 609 235 123<br>
              Email: <a href="#">admin@wp.pl</a>
              </address>
            </section>
          </aside>';
        }
        
        function wyswietl_rejestracja()
        {
            $this->brak_dostepu(true);
            echo'
                <div id="content">
                            <article>
                  <h2>Formularz rejestracji:</h2><br />
                  <form method="POST" action="rejestracja.php"> 
                  <table>
                  <tr>
                    <td><b>Login:<b/></td> <td><input type="text" name="login"></td>
                  </tr>
                  <tr>
                    <td><b>E-mail:<b/></td><td> <input type="email" name="email"></td>
                  </tr>
                  <tr>
                    <td><b>Hasło:<b/></td><td> <input type="password" name="haslo1"></td>
                  </tr>
                  <tr>
                    <td><b>Powtórz hasło:</b></td><td> <input type="password" name="haslo2"></td>
                  </tr>
                  <tr>
                  </table>

                    <div class="g-recaptcha" data-sitekey="6Lcsj0AUAAAAABMBjd1DzqQkBUaEiIDPk-vj6g3S"></div><br />
                    <input type="submit" value="Zarejestruj" name="rejestruj">';
            
                if(isset($_SESSION['komunikat_rejestracji']))
                {
                    echo'<br/><span style="color:blue">';
                    echo" ".$_SESSION['komunikat_rejestracji']."</span>";
                    unset($_SESSION['komunikat_rejestracji']);
                }
                
                echo'
                    </form>   
                    </article>
                    </div>
                    </div>
                    </div>';
        }
        
        function wyswietl_dodawanie()
        {
            $this->brak_dostepu(false);
            $_SESSION['edycja']=false;
            echo'
                <div id="content">
                            <article>
                  <h2>Dodaj ogłoszenie:</h2><br />
                  <form method="POST" action="dodawanie.php"> 
                  <table>
                  <tr>
                    <td><b>Tytul:<b/></td> <td><input type="text" name="tytul"></td>
                  </tr>
                  <tr>
                    <td><b>Telefon:<b/></td><td> <input type="text" name="telefon"></td>
                  </tr>
                  <tr>
                    <td><b>Treść:<b/></td><td> <textarea name="tresc" cols="50" rows="7"></textarea></td>
                  </tr>
                  <tr>
                  </table>
                    <input type="submit" value="Dodaj" name="dodaj">';
            
                if(isset($_SESSION['komunikat_dodawania']))
                {
                    echo'<br/><span style="color:blue">';
                    echo" ".$_SESSION['komunikat_dodawania']."</span>";
                    unset($_SESSION['komunikat_dodawania']);
                }
                
                echo'
                    </form>   
                    </article>
                    </div>
                    </div>
            <       /div>';
        }
        
        function wyswietl_content_domyslny()
        {
            echo'
                <div id="content">
                        <article class="last">';
            if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'])
            
                echo'  <h2>Witamy w serwisie!</h2>
              <p>Wybierz w menu co chcesz zrobić</p>';
            
            else
            echo'  <h2>Witamy w serwisie!</h2>
              <p>Serwis umożliwia dodawanie prostych ogłoszeń lokalnych</p>
              <p>Aby korzystać z pełnej funkcjonalności serwisu, należy się zalogować!</p>';
            echo' 
                </div>
                </div>
                </div>';
        }
        
        function wyswietl_twoje_ogloszenia()
        {
            $this->brak_dostepu(false);
            echo'
                <div id="content">';
            
            
            $tablica_ogloszen=$this->model->twoje_ogloszenia();
            
            if($tablica_ogloszen != 0)
            {
                for($i=0; $i<count($tablica_ogloszen); $i++)
                {
                    if(count($tablica_ogloszen)-$i==1)
                        echo'<article class="last"><h2>';
                    
                    else
                        echo'<article><h2>';
                    
                    echo $tablica_ogloszen[$i]['tytul']."</h2>";
                    echo"<p>".$tablica_ogloszen[$i]['tresc']."</p>";
                    echo"<p>Kontakt: ".$tablica_ogloszen[$i]['telefon'].""; 
                    echo'<a href="index.php?page=edytuj&id='.$tablica_ogloszen[$i]['idOgloszenia'].'"> [Edytuj]</a><a href="index.php?page=usun&id='.$tablica_ogloszen[$i]['idOgloszenia'].'"> [Usuń]</a></p></article>';
                }
            }
            
            else 
                echo'<article><h2>Brak ogłoszeń</h2></article>';

            echo'    
                </div>
                </div>
                </div>';
        }
        
        function wyswietl_edycje($id)
        {
            $this->brak_dostepu(false);
            $_SESSION['edycja']=true;
            $_SESSION['id_ogloszenia']=$id;
            $rezultat=$this->model->edytuj($id);
            echo'
                <div id="content">
                            <article>
                  <h2>Edytuj ogłoszenie:</h2><br />
                  <form method="POST" action="dodawanie.php"> 
                  <table>
                  <tr>
                    <td><b>Tytul:<b/></td> <td><input type="text" name="tytul" value="'.$rezultat['tytul'].'"></td>
                  </tr>
                  <tr>
                    <td><b>Telefon:<b/></td><td> <input type="text" name="telefon" value="'.$rezultat['telefon'].'"></td>
                  </tr>
                  <tr>
                    <td><b>Treść:<b/></td><td> <textarea name="tresc" cols="50" rows="7">'.$rezultat['tresc'].'</textarea></td>
                  </tr>
                  <tr>
                  </table>
                    <input type="submit" value="Edytuj" name="edytuj">';
            
                if(isset($_SESSION['komunikat_dodawania']))
                {
                    echo'<br/><span style="color:blue">';
                    echo" ".$_SESSION['komunikat_dodawania']."</span>";
                    unset($_SESSION['komunikat_dodawania']);
                }
                
                echo'
                </form>   
                </article>
                </div>
                </div>
                </div>';
        }
        
        function wyswietl_ogloszenia()
        {
            $this->brak_dostepu(false);
            echo'
                <div id="content">';
            
            
            $tablica_ogloszen=$this->model->ogloszenia();
            
            if($tablica_ogloszen != 0)
            {
                for($i=0; $i<count($tablica_ogloszen); $i++)
                {
                    if(count($tablica_ogloszen)-$i==1)
                        echo'<article class="last"><h2>';
                    
                    else
                        echo'<article><h2>';
                    
                    echo $tablica_ogloszen[$i]['tytul']."</h2>";
                    echo"<p>".$tablica_ogloszen[$i]['tresc']."</p>";
                    echo"<p>Kontakt: ".$tablica_ogloszen[$i]['telefon'].""; 
                    echo'</a></p></article>';
                }
            }
            
            else
                echo'<article><h2>Brak ogłoszeń</h2></article>';

            echo'    
                </div>
                </div>
                </div>';
        }   
        
        //parametr określa czy bronimy dostepu dla zalogowanego(true) czy niezalogowanego(false)
        function brak_dostepu($dla_kogo)
        {
            if(isset($_SESSION['zalogowany']))
            {
                if($dla_kogo)
                {
                    $this->wyswietl_content_domyslny();
                    exit;
                }
            }
            
            else
            {
                if(!$dla_kogo)
                {
                    $this->wyswietl_content_domyslny();
                    exit;
                }
            }
        }
    }
?>