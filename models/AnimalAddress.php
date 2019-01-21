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
}