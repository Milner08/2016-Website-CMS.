<?php
class View {
    private $data = array();

    private $template = FALSE;

    public function __construct($template)
    {
        try {
            $file = './views/' . $template . '.php';

            if (file_exists($file)) {
                $this->template = $file;
            } else {
                throw new Exception('View ' . $template . ' not found!');
            }
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }

        if(isset($_SESSION['user'])){
	        $this->assign('is_loggedin', true);
        }else{
            $this->assign('is_loggedin', false);
        }

        $this->assign('active', 'home');
    }

    public function assign($variable, $value)
    {
        $this->data[$variable] = $value;
    }

    public function render()
    {
        extract($this->data);
        include($this->template);

    }
}
?>
