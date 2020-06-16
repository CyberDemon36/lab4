<?php
session_start();


class user {
    public $name;
    public $surname;
    public $role;
    public $login;
    public $password;
    public $lang;
    function __construct($lang, $role, $name, $surname)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->role = $role;
        $this->lang = $lang;
    }
    
    public function getLang()
    {
        return $this->lang;
    }
    public function isAdmin()
    {
        return $this->role == "Admin";
    }
    public function isManager()
    {
        return $this->role == "Manager";
    }
    public function isClient()
    {
        return $this->role == "Client";
    }
    
    public function introduce()
    {
        $arr_lang = [
            "ru"=> ["start" => "Привет, "],
            "ua" => ["start" => "Привіт, "],
            "it" => ["start" => "Сiao, "],
            "en" => ["start" => "Hello, "]
        ];
        
        return $arr_lang[$this->lang]["start"] . " ". $this->role . " " . $this->name . " " . $this->surname;
    }

    public function cabinetURL ()
    {
        return "roles/". strtolower($this->role) .".php";
    }
};
class admin extends user {

    public function introduce(){
        $arr_lang = [
            "ru"=> ["end" => ", вам разрешено все на данном сайте"],
            "ua" => ["end" => ", вам дозволено усе на даному сайті"],
            "it" => ["end" => ", ti è permesso tutto su questo sito"],
            "en" => ["end" => ", you are allmight at this web-site"]
        ];
        echo parent::introduce() . $arr_lang[$this->lang]["end"];
    }
    
};

class manager extends user {

    public function introduce(){
        $arr_lang = [
            "ru"=> ["end" => ", вам разрешено взаимодействовать с аккаунтами клиентов"],
            "ua" => ["end" => ", вам дозволено взаїмодіяти з аккаунтами клієнтів"],
            "it" => ["end" => ", puoi interagire con gli account dei clienti."],
            "en" => ["end" => ", you can interract with client accounts"]
        ];
        echo parent::introduce() . $arr_lang[$this->lang]["end"];
    }
};
class client extends user {

    public function introduce(){
        $arr_lang = [
            "ru"=> ["end" => ", добро пожаловать на сайт!"],
            "ua" => ["end" => ", ласкаво просимо на сайт!"],
            "it" => ["end" => ", benvenuto nel sito!"],
            "en" => ["end" => ", welcome to the web-site!"]
        ];
        echo parent::introduce() . $arr_lang[$this->lang]["end"];
    }
};


function auth($arr)
{
    if(empty($_SESSION["id"])){
        return null;
    }
    $id = $_SESSION["id"];
   
    if ($arr["role"] == "1"){
        return new admin($arr["lang"],"Admin",$arr["name"],$arr["surname"]); 
    }
    else if ($arr["role"] == "2"){
        return new manager($arr["lang"],"Manager",$arr["name"],$arr["surname"]);
    }
    else if ($arr["role"] == "3"){
        return new client($arr["lang"],"Client",$arr["name"],$arr["surname"]);
    }
}
function changeLang($array, $newLang) 
{
    
    if ($array["role"] == "1"){
        return new admin($newLang, "Admin", $array["name"], $array["surname"]);
    }
    else if ($array["role"] == "2"){
        return new manager($newLang, "Manager", $array["name"], $array["surname"]);
    }
    else if ($array["role"] == "3"){
        return new client($newLang, "Client", $array["name"], $array["surname"]);
    }
}
?>