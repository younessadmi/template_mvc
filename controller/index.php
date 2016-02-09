<?php
class indexController extends baseController {

    public function index(){        
        $this->registry->template->show('index');
    }
    public function test(){        
        $this->registry->template->show('index');
    }
}
?>