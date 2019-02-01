<?php
class AnimalImage extends Model
{
    // Adiciona uma ou mais imagens para o animal
    public function addAnimalImage($id_animal, $fotos)
    {  
        if (count($fotos['tmp_name']) > 0) {
            for ($i = 0; $i < count($fotos['tmp_name']); $i++) { 
                $tipo = $fotos['type'][$i];
                // Verificando se a extensão é válida.
                if (in_array($tipo, array('image/jpeg', 'image/jpg', 'image/png'))) {
                    // Nome do arquivo
                    $file = md5(rand(0, 9999)*rand(0,9999)*time()).'.jpg';
                    $filename = 'assets/images/animalImages/'.$file;
                    // Salvando arquivo
                    move_uploaded_file($fotos['tmp_name'][$i], $filename);
                    // Largura e altura máximas
                    $new_width  = 500;
                    $new_height = 200;
                    // Obtendo tamanho original
                    list($old_width, $old_height) = getimagesize($filename);
                    // Calculando proporção
                    $ratio = $old_width / $old_height;
                    if ($new_width / $new_height > $ratio) {
                        $new_width = $new_height * $ratio;
                    } else {
                        $new_height = $new_width / $ratio;
                    }
                    // Gerando uma nova imagem
                    $new_image = imagecreatetruecolor($new_width, $new_height);
                    if ($tipo == 'image/jpeg') {
                        $old_image = imagecreatefromjpeg($filename);
                    } else {
                        $old_image = imagecreatefrompng($filename);
                    }
                    imagecopyresampled($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);
                    // Gerando imagem
                    imagejpeg($new_image, $filename, 80);
                    // Salvando imagem no banco
                    $sql = "INSERT INTO animalImage (id_animal, url) VALUES (:id_animal, :url)";
                    $sql = $this->db->prepare($sql);
                    $sql->bindValue(":id_animal", $id_animal);
                    $sql->bindValue(":url", $file);
                    $sql->execute();
                } 
            }
        }
        return false;
    }

    public function getAnimalImage($id_animal)
    {
        $sql = 'SELECT * FROM animalImage WHERE id_animal = :id_animal';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_animal', $id_animal);
        $sql->execute();

        $array = array();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    // Retorna todas as imagens de um animal
    public function getAnimalImages($id_animal)
    {
        $sql = 'SELECT * FROM animalImage WHERE id_animal = :id_animal';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_animal', $id_animal);
        $sql->execute();

        $array = array();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    // Deleta uma imagem de um animal
    public function deleteImage($id_animal_image)
    {
        $sql = 'SELECT * FROM animalImage WHERE id_animal_image = :id_animal_image';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_animal_image', $id_animal_image);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $info = $sql->fetch();
            // Verifica se o arquivo existe e excluí 
            if (is_file('assets/images/animalImages/'.$info['url'])) {
                unlink('assets/images/animalImages/'.$info['url']);
            } 
        }
        // Deleta a imagem do banco de dados
        $sql = 'DELETE FROM animalImage WHERE id_animal_image = :id_animal_image';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_animal_image', $id_animal_image);
        $sql->execute();
    }

    // Deleta todas as imagens de um animal
    public function deleteImages($id_animal)
    {
        $sql = 'SELECT * FROM animalImage WHERE id_animal = :id_animal';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_animal', $id_animal);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $aImages = $sql->fetchAll(PDO::FETCH_ASSOC);
            for ($i = 0; $i < count($aImages); $i++) { 
                // Verifica se o arquivo existe e excluí 
                if (is_file('assets/images/animalImages/'.$aImages['url'][$i])) {
                    unlink('assets/images/animalImages/'.$aImages['url'][$i]);
                }
            }
        }

        // Deleta a imagem do banco de dados
        $sql = 'DELETE FROM animalImage WHERE id_animaL = :id_animal';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_animal', $id_animal);
        $sql->execute();
    }
}