<?php
class UserAdress extends Model
{
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
}