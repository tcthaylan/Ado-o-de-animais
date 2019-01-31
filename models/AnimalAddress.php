<?php
class AnimalAddress extends Model
{
    // Cadastra o endereço de um animal.
    public function registerAddress($id_animal, $uf, $city)
    {
        $sql = 'INSERT INTO animalAddress (id_animal, uf, city) VALUES (:id_animal, :uf, :city)';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_animal', $id_animal);
        $sql->bindValue(':uf', $uf);
        $sql->bindValue(':city', $city);
        $sql->execute();
    }

    public function getAnimalAddressById($id_animal)
    {
        $sql = 'SELECT * FROM animalAddress WHERE id_animal = :id_animal';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_animal', $id_animal);
        $sql->execute();

        $array = array();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function alterAnimalAddress($id_animal, $uf, $city)
    {
        $sql = 'UPDATE animalAddress SET uf = :uf, city = :city WHERE id_animal = :id_animal';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_animal', $id_animal);
        $sql->bindValue(':uf', $uf);
        $sql->bindValue(':city', $city);
        $sql->execute();
    }
}