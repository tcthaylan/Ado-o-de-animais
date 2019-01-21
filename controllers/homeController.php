<?php
class homeController extends Controller {

    private $user;

    public function __construct()
    {
        parent::__construct();
    
        $this->user = new User();
        if ($this->user->checkLogin()) {
            $this->user->setLogin(true);
        } else {
            $this->user->setLogin(false);
        }
    }

    public function index() {
        $data = array(
            'menu' => $this->user->getLogin()
        );

        $this->loadTemplate('home', $data);
    }

}