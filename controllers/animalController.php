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
            'msg' => array(
                'success' => '',
                'warning' => ''
            )
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
                
                $data['msg']['success'] = 'Animal adicionado com sucesso';
            } else {
                $data['msg']['warning'] = 'Preencha todos os campos';
            }
        }

        $this->loadTemplate('addAnimal', $data);
    }

    public function edit($id_animal)
    {
        $data = array(
            'menu' => $this->user->getLogin(true),
            'animal' => array(),
            'animalAddress' => array(),
            'animalImages' => array(),
            'species' => array(),
            'states' => array()
        );

        $animal = new Animal();
        $aAddress = new AnimalAddress();
        $animalImage = new AnimalImage();
        $specie = new Specie();
        $federativeUnit = new FederativeUnit();

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
                
                $animal->alterAnimal($id_animal, $name, $description, $id_specie, $size, $gender);
                $aAddress->alterAnimalAddress($id_animal, $uf, $city);

                if (!empty($_FILES['fotos'])) {
                    $animalImage->addAnimalImage($id_animal, $_FILES['fotos']);
                }
                
                $data['msg']['success'] = 'Animal editado com sucesso';
            } else {
                $data['msg']['warning'] = 'Preencha todos os campos';
            }
        }


        $data['animal'] = $animal->getAnimalById($id_animal);
        $data['animalAddress'] = $aAddress->getAnimalAddressById($id_animal);
        $data['animalImages'] = $animalImage->getAnimalImages($id_animal);
        $data['species'] = $specie->getSpecies();
        $data['states'] = $federativeUnit->getFederativeUnits();

        // Verifica se o usuário é dono do animal
        if ($data['animal']['id_user'] != $_SESSION['id_user']) {
            header('Location: '.BASE_URL.'user');
            exit;
        }

        $this->loadTemplate('editAnimal', $data);
    }

    public function delete($id_animal)
    {
        $animal = new Animal();
        $animalImage = new AnimalImage();

        $a = $animal->getAnimalById($id_animal);

        if ($_SESSION['id_user'] != $a['id_user']) {
            header('Location: '.BASE_URL.'user');
            exit;
        }

        $animal->disableAnimal($id_animal);

        header('Location: '.BASE_URL.'user');
        exit;
    }
    
    public function deleteAnimalImage($id_animal, $id_animal_image)
    {   
        $animal = new Animal();
        $animalImage = new AnimalImage();

        $a = $animal->getAnimalById($id_animal);

        if ($_SESSION['id_user'] != $a['id_user']) {
            header('Location: '.BASE_URL.'user');
            exit;
        }

        $animalImage->deleteImage($id_animal_image);
        header('Location: '.BASE_URL.'animal/edit/'.$id_animal);
        exit;
    }
}