<?php
class Controller{
    private $message;

    public function __construct($message){
        if(isset($message)){
            $this->message = $message;
        }elseif(isset($_SESSION['message'])){
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        }      
    }
                      
}
?>