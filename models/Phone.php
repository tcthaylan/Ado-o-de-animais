<?php
class Phone extends Model
{
    public function getPhoneById($id_user)
    {
        $sql = 'SELECT * FROM phone WHERE id_user = :id_user';
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

    // Cadastra o telefone do usuário.
    public function registerPhone($id_user, $phone_number, $cell_phone)
    {
        $sql = 'INSERT INTO phone (id_user, phone, cell_phone) VALUES (:id_user, :phone, :cell_phone)';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_user', $id_user);
        $sql->bindValue(':phone', $phone_number);
        $sql->bindValue(':cell_phone', $cell_phone);
        $sql->execute();
    }

    // Altera o telefone do usuário.
    public function alterPhone($id_user, $phone_number, $cell_phone)
    {
        $sql = 'UPDATE phone SET phone = :phone, cell_phone = :cell_phone WHERE id_user = :id_user';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_user', $id_user);
        $sql->bindValue(':phone', $phone_number);
        $sql->bindValue(':cell_phone', $cell_phone);
        $sql->execute();
    }
}