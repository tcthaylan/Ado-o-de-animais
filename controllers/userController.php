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
        $data = array(
            'menu' => $this->user->getLogin(),
            'user' => array(),
            'states' => array(),
            'animals' => array()
        );

        $user = new User();
        $phone = new Phone();
        $userAddress = new UserAddress();
        $federativeUnit = new FederativeUnit();
        $animal = new Animal();
        $animalAddress = new AnimalAddress();

        // Paginação animais
        $limit = 3;
        $total = $animal->getTotalAnimals();    

        $data['paginas'] = ceil($total/$limit);

        $data['paginaAtual'] = 1;
        if (!empty($_GET['p'])) {
            $data['paginaAtual'] = intval($_GET['p']);
        }

        $offset = ($data['paginaAtual'] * $limit) - $limit;

        // Dados do animal
        $a = $animal->getUserAnimalsById($_SESSION['id_user'], $offset, $limit);
        
        // Inserindo enredeço do animal
        for ($i = 0; $i < count($a); $i++) {
            $aAddress = $animalAddress->getAnimalAddressById($a[$i]['id_animal']);
            $a[$i] = array_merge($a[$i], $aAddress);
        }

        // Dados do usuário
        $u = $user->getUserById($_SESSION['id_user']);
        $p = $phone->getPhoneById($_SESSION['id_user']);
        $uAddress = $userAddress->getUserAddressById($_SESSION['id_user']);
        $fu = $federativeUnit->getFUByUf($uAddress['uf']);

        // Armazenando dados para a view
        $data['user'] = array_merge($u, $p, $uAddress, $fu);
        $data['states'] = $federativeUnit->getFederativeUnits();
        $data['animals'] = $a;

        $this->loadTemplate('user', $data);
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
        $uAddress = $userAddress->getUserAddressById($_SESSION['id_user']);
        $fu = $federativeUnit->getFUByUf($uAddress['uf']);

        $data['user'] = array_merge($u, $p, $uAddress, $fu);
        $data['states'] = $federativeUnit->getFederativeUnits();

        $this->loadTemplate('editUser', $data);
    }
}