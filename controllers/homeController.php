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
            'menu' => $this->user->getLogin(),
            'animals' => array(),
            'states' => array()
        );

        $animal = new Animal();
        $animalAddress = new AnimalAddress();
        $animalImage = new AnimalImage();

        // Paginação animais
        $limit = 3;
        $total = $animal->getTotalAnimals();    

        $data['paginas'] = ceil($total/$limit);

        $data['paginaAtual'] = 1;
        if (!empty($_GET['p'])) {
            $data['paginaAtual'] = intval($_GET['p']);
        }

        $offset = ($data['paginaAtual'] * $limit) - $limit;

        $a = $animal->getAnimals($offset, $limit); 

        // Inserindo enredeço e imagens do animal
        for ($i = 0; $i < count($a); $i++) {
            // Endereço
            $aAddress = $animalAddress->getAnimalAddressById($a[$i]['id_animal']);
            $a[$i] = array_merge($a[$i], $aAddress);

            // Imagens
            $aImage = $animalImage->getAnimalImages($a[$i]['id_animal']);
            $a[$i]['images'] = $aImage;
        }

        $data['animals'] = $a;

        $this->loadTemplate('home', $data);
    }

}