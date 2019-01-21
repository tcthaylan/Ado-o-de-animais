<?php
class animalController extends Controller
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

    public function add()
    {
        $data = array(
            'menu' => $this->user->getLogin(),
            'species' => array(),
            'states' => array(),
            'msg' => ''
        );

        $animal = new Animal();
        $specie = new Specie();
        $animalAddress = new AnimalAddress();
        $federativeUnit = new FederativeUnit();

        $data['species'] = $specie->getSpecies();
        $data['states'] = $federativeUnit->getFederativeUnits();

        if (!empty($_POST['name'])) {
            $name           = addslashes($_POST['name']);
            $description    = addslashes($_POST['description']);
            $id_specie      = addslashes($_POST['id_specie']);
            $size           = addslashes($_POST['size']);
            $gender         = addslashes($_POST['gender']);
            $uf             = addslashes($_POST['uf']);
            $city           = addslashes($_POST['city']);

            if (
                !empty($_POST['name']) 
                && !empty($_POST['description']) 
                && !empty($_POST['id_specie']) 
                && !empty($_POST['size']) 
                && !empty($_POST['gender']) 
                && !empty($_POST['uf'])
                && !empty($_POST['city']) 
                ) {
                
                $id_animal = $animal->registerAnimal($id_specie, $_SESSION['id_user'], $name, $gender, $description, $size);
                $animalAddress->registerAddress($id_animal, $uf, $city);
                
                $data['msg'] = 'Animal adicionado com sucesso';
            } else {
                $data['msg'] = 'Preencha todos os campos';
            }
        }

        $this->loadTemplate('addAnimal', $data);
    }

    public function adoption()
    {

    }
}