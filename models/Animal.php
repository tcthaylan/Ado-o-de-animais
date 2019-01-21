<?php
class Animal extends Model
{
    public function registerAnimal($id_specie, $id_user, $name, $gender, $description, $size)
    {
        $sql = 'INSERT INTO animal (id_specie, id_user, name, gender, description, size) VALUES (:id_specie, :id_user, :name, :gender, :description, :size)';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_specie', $id_specie);
        $sql->bindValue(':id_user', $id_user);
        $sql->bindValue(':name', $name);
        $sql->bindValue(':gender', $gender);
        $sql->bindValue(':description', $description);
        $sql->bindValue(':size', $size);
        $sql->execute();

        return $this->db->lastInsertId();   
    }
}