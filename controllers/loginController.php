<?php
class loginController extends Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct();
    
        $this->user = new User();   
        $this->user->setLogin(false);
        unset($_SESSION['token']);
        unset($_SESSION['id_user']);    
    }

    public function index()
    {
        $data = array(
            'menu' => $this->user->getLogin(),
            'msg' => ''
        ); 

        if (!empty($_POST['email'])) {
            $email = addslashes($_POST['email']);
            $password = md5($_POST['password']);

            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $user = new User();

                // Verificando se email e senha são válidos.
                if ($user->verifyUser($email, $password)) {
                    $_SESSION['token'] = $user->createToken($email);
                    $_SESSION['id_user'] = $user->getIdByEmail($email);
                    header('Location: ' . BASE_URL);
                    exit;
                } else {
                    $data['msg'] = 'Email e/ou senha incorreto(s)!';
                }
            } else {
                $data['msg'] = 'Preencha todos os campos!';
            }
        }
        $this->loadTemplate('login', $data);
    }

    public function createAccount()
    {
        $data = array(
            'menu' => $this->user->getLogin(),
            'states'    => array(),
            'msg'       => array(
                'success'   => '',
                'warning'   => '',
                'danger'    => ''
            )
        );

        $federativeUnit = new FederativeUnit();
        $data['states'] = $federativeUnit->getFederativeUnits();

        if (!empty($_POST['name'])) {
            $name           = addslashes($_POST['name']);
            $last_name      = addslashes($_POST['last_name']);
            $email          = addslashes($_POST['email']);
            $password       = md5($_POST['password']);
            $uf             = addslashes($_POST['uf']);
            $city           = addslashes($_POST['city']);
            $phone_number   = addslashes($_POST['phone']);
            $cell_phone     = addslashes($_POST['cell_phone']);

            // Verificando se todos os campos foram preenchidos.
            if (
                !empty($_POST['name']) 
                && !empty($_POST['last_name']) 
                && !empty($_POST['email']) 
                && !empty($_POST['password']) 
                && !empty($_POST['uf']) 
                && !empty($_POST['city']) 
                && (!empty($_POST['phone']) || !empty($_POST['cell_phone']))
                ) {

                $user = new User();
                $phone = new Phone();
                $userAddress = new UserAddress();
                $userToken = new UserToken();
                
                // Verificando se o email existe.
                if ($user->emailExists($email) == false) {
                    // Cadastrando usuário, telefone e endereço no banco de dados.
                    $id_user = $user->registerUser($name, $last_name, $email, $password);
                    $userAddress->registerAddress($id_user, $uf, $city);
                    $phone->registerPhone($id_user, $phone_number, $cell_phone);

                    $data['msg']['success'] = 'Conta criada com sucesso, realize o';
                } else {
                    $data['msg']['danger'] = 'Email inválido, já se encontra em uso';
                }
            } else {
                $data['msg']['warning'] = 'Preencha todos os campos!';
            }
        }

        $this->loadTemplate('createAccount', $data);
    }

    public function forgotPassword()
    {
        $data = array(
            'menu' => $this->user->getLogin(),
            'msg'       => array(
                'success'   => '',
                'warning'   => ''
            )
        );

        if (!empty($_POST['email'])) {
            $email = addslashes($_POST['email']);

            $user = new User();
            $userToken = new UserToken();

            // Verifica se o email existe.
            if ($user->emailExists($email)) {
                // Cria um token e envia um email para a recuperação da senha.
                $id_user = $user->getIdByEmail($email);
                $token = $userToken->createUserToken($id_user);
                $link_recuperacao = $user->sendRecoveryEmail($email, $token);

                $data['msg']['success'] = $link_recuperacao;
            } else {
                $data['msg']['warning'] = 'Este email não existe!';
            }
        }

        $this->loadTemplate('forgotPassword', $data);
    }

    public function recoverPassword()
    {   
        $data = array(
            'menu' => $this->user->getLogin(),
            'msg' => array(
                'success' => '',
                'danger' => ''
            )
        );

        if (empty($_GET['email']) || empty($_GET['token'])) {
            header('Location: '.BASE_URL);
            exit;
        }

        $user = new User();
        $userToken = new UserToken();

        if (!empty($_POST['password'])) {
            $email      = addslashes($_GET['email']);
            $token      = addslashes($_GET['token']);
            $password   = md5($_POST['password']);

            if ($userToken->verifyUserToken($token)) {
                // Altera a senha e disabilita o token de recuperação.
                $user->alterPassword($email, $password);
                $userToken->disableUserToken($token);

                $data['msg']['success'] = 'Senha alterada com sucesso, ';
            } else {
                $data['msg']['danger'] = 'Token usado ou expirado!';
            }
        }
        $this->loadTemplate('recoverPassword', $data);
    }

    public function sair()
    {
        header('Location: '.BASE_URL);
        exit;
    }
}