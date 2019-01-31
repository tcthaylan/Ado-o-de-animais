<?php
class Animal extends Model
{   
    // Cadastra um animal
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
    
    public function getUserAnimalsById($id_user, $offset, $limit)
    {
        $sql = "SELECT * FROM animal WHERE id_user = :id_user AND status = 0 LIMIT $offset, $limit";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_user', $id_user);
        $sql->execute();

        $array = array();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    // Retorna o total de animais cadastrados
    public function getTotalAnimals()
    {
        $sql = 'SELECT COUNT(*) AS c FROM animal';
        $sql = $this->db->query($sql);
        
        if ($sql->rowCount() > 0) {
            $info = $sql->fetch();
            return $info['c'];
        }
        return false;
    }

    public function getAnimalById($id_animal)
    {
        $sql = 'SELECT * FROM animal WHERE id_animal = :id_animal';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_animal', $id_animal);
        $sql->execute();

        $array = array();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function alterAnimal($id_animal, $name, $description, $id_specie, $size, $gender)
    {
        $sql = 'UPDATE animal SET name = :name, description = :description, id_specie = :id_specie, size = :size, gender = :gender WHERE id_animal = :id_animal';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_animal', $id_animal);
        $sql->bindValue(':name', $name);
        $sql->bindValue(':description', $description);
        $sql->bindValue(':id_specie', $id_specie);
        $sql->bindValue(':size', $size);
        $sql->bindValue(':gender', $gender);
        $sql->execute();
    }

    // Desativa um animal
    public function disableAnimal($id_animal)
    {
        $sql = 'UPDATE animal SET status = 1 WHERE id_animal = :id_animal';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_animal', $id_animal);
        $sql->execute();
    }
}