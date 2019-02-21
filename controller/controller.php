<?php
class Controller extends View
{
    protected $model; //instancja klasy Model
    
    function __construct($model) 
    {
        parent::__construct($model);
    }
    
    function display($page)
    {
        
        $this->wyswietl_naglowek();
        $this->wyswietl_content();
        
        switch($page)
        {
            case 'logowanie':
                $this->wyswietl_logowanie($error=false);
                break;
            case 'blad_logowania':
                $this->wyswietl_logowanie($error=true);
                break;
            case 'rejestracja':
                $this->wyswietl_rejestracja();
                break;
            case 'dodaj':
                $this->wyswietl_dodawanie();
                break;
            case 'edytuj':
                $this->wyswietl_edycje($_GET['id']);
                break;
            case 'usun':
                $this->model->usun($_GET['id']);
                $this->wyswietl_twoje_ogloszenia();
                break;
            case 'twoje_ogloszenia':
                $this->wyswietl_twoje_ogloszenia();
                break;
            case 'ogloszenia':
                $this->wyswietl_ogloszenia();
                break;
            default:
                $this->wyswietl_content_domyslny();
                break;
        }     
        $this->wyswietl_stopka();
    }
}
?>

