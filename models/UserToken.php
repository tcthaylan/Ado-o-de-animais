<?php
class UserToken extends Model
{
    // Cria um token para recuperação de senha.
    public function createUserToken($id_user)
    {
        $token = md5(rand(0, 99999)*rand(0, 9999)*time());
        $expires_in = date('Y-m-d H:i', strtotime('+2 days'));

        $sql = 'INSERT INTO userToken (id_user, hash, expires_in) VALUES (:id_user, :hash, :expires_in)';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_user', $id_user);
        $sql->bindValue(':hash', $token);
        $sql->bindValue(':expires_in', $expires_in);
        $sql->execute();

        return $token;
    }

    // Verifica se o token de recuparação de senha é válido.
    public function verifyUserToken($token)
    {
        $sql = 'SELECT * FROM userToken WHERE hash = :hash AND expires_in > NOW() AND used = 0';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':hash', $token);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function disableUserToken($token)
    {
        $sql = 'UPDATE userToken SET used = 1 WHERE hash = :hash';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':hash', $token);
        $sql->execute();
    }
}   