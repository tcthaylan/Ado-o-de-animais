<?php
class UserAddress extends Model
{
    public function getUserAddressById($id_user)
    {
        $sql = 'SELECT * FROM userAddress WHERE id_user = :id_user';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_user', $id_user);
        $sql->execute();

        $array = array();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
            return $array;
        }
        return $array;
    }

    // Cadastra o endereço do usuário.
    public function registerAddress($id_user, $uf, $city)
    {
        $sql = 'INSERT INTO userAddress (id_user, uf, city) VALUES (:id_user, :uf, :city)';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_user', $id_user);
        $sql->bindValue(':uf', $uf);
        $sql->bindValue(':city', $city);
        $sql->execute();
    }

    // Altera o endereço do usuário
    public function alterAddress($id_user, $uf, $city)
    {
        $sql = 'UPDATE userAddress SET uf = :uf, city = :city WHERE id_user = :id_user';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_user', $id_user);
        $sql->bindValue(':uf', $uf);
        $sql->bindValue(':city', $city);
        $sql->execute();
    }
}