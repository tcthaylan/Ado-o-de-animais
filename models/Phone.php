<?php
class Phone extends Model
{
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
}