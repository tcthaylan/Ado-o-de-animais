<?php
class userController extends Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct();
    
        $this->user = new User();
        if ($this->user->checkLogin()) {
            $this->user->setLogin(true);
        } else {
            header('Location: '.BASE_URL.'login');
            exit;
        }
    }

    public function index()
    {

    }

    public function edit()
    {
        $data = array(
            'menu' => $this->user->getLogin(),
            'user' => array(),
            'states' => array(),
            'msg' => ''
        );

        $user = new User();
        $phone = new Phone();
        $userAddress = new UserAddress();
        $federativeUnit = new FederativeUnit();

        $u = $user->getUserById($_SESSION['id_user']);

        if (!empty($_POST['name'])) {
            $id_user        = $u['id_user'];
            $name           = addslashes($_POST['name']);
            $last_name      = addslashes($_POST['last_name']);
            $email          = $u['email'];
            $password       = md5($_POST['password']);
            $uf             = addslashes($_POST['uf']);
            $city           = addslashes($_POST['city']);
            $phone_number   = addslashes($_POST['phone']);
            $cell_phone     = addslashes($_POST['cell_phone']);

            if (
                !empty($_POST['name']) 
                && !empty($_POST['last_name'])  
                && !empty($_POST['uf']) 
                && !empty($_POST['city']) 
                && (!empty($_POST['phone']) || !empty($_POST['cell_phone']))
                ) {

                $user->alterUser($id_user, $name, $last_name, $email, $password);
                $phone->alterPhone($id_user, $phone_number, $cell_phone);
                $userAddress->alterAddress($id_user, $uf, $city);
                
                $data['msg'] = 'Perfil editado com sucesso';
            } else {
                $data['msg'] = 'Preencha todos os campos!';
            }
        }

        $u = $user->getUserById($_SESSION['id_user']);
        $p = $phone->getPhoneById($_SESSION['id_user']);
        $ua = $userAddress->getUserAddressById($_SESSION['id_user']);
        $fu = $federativeUnit->getFUByUf($ua['uf']);

        $data['user'] = array_merge($u, $p, $ua, $fu);
        $data['states'] = $federativeUnit->getFederativeUnits();

        $this->loadTemplate('edit', $data);
    }
}