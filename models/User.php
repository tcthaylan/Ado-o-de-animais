<?php
class User extends Model
{   
    // Verifica se o email e senha correspondem há algum usuário existente no banco de dados.
    public function verifyUser($email, $password)
    {
        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', $password);
        $sql->execute();

        // Usuário existe.
        if ($sql->rowCount() > 0) {
            return true;
        } 
        // Usuário não existe.
        return false;
    }

    // Cria e atualiza o token do usuário.
    public function createToken($email)
    {
        $token = md5(rand(0, 999) * rand(0, 9999) * time());

        $sql = 'UPDATE user SET token = :token WHERE email = :email';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':token', $token);
        $sql->bindValue(':email', $email);
        $sql->execute();

        return $token;
    }

    // Não permite que dois ou mais usuários usem a mesma conta simultaneamente.
    public function checkLogin()
    {
        if (!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];

            $sql = 'SELECT * FROM user WHERE token = :token';
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':token', $token);
            $sql->execute();

            // Login válido.
            if ($sql->rowCount() > 0) {
                return true;
            }

            // Login inválido.
            return false;
        }
    }

    // Verifica se um email existe no banco de dados.
    public function verifyEmail($email)
    {
        $sql = 'SELECT * FROM user WHERE email = :email';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':email', $email);
        $sql->execute();

        // Email não existe
        if ($sql->rowCount() == 0) {
            return false;
        }
        // Email existe.
        return true;
    }

    // Cadastra um usuário.
    public function registerUser($name, $last_name, $email, $password)
    {
        $sql = 'INSERT INTO user (name, last_name, email, password) VALUES (:name, :last_name, :email, :password)';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':name', $name);
        $sql->bindValue(':last_name', $last_name);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', $password);
        $sql->execute();

        return $this->db->lastInsertId();   
    }

    // Pega um id através do email.
    public function getIdByEmail($email)
    {
        $sql = 'SELECT * FROM user WHERE email = :email';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':email', $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $info = $sql->fetch();
            return $info['id_user'];
        }

        return false;
    }

    // Envia um email de recuparação da senha
    public function sendRecoveryEmail($email, $token)
    {
        $link_recuperacao = BASE_URL.'login/recoverPassword/'.$email.'/'.$token;
        $assunto = 'Recuperar Senha';
        $corpo = 'Para recuperar a senha clique no link abaixo.<br>'.$link_recuperacao;
        $cabecalho = 'From: suporte@tcthaylan.com.br'."\r\n".
        'X-Mailer: PHP/'.phpversion();

        return $corpo;
        //mail($email, $assunto, $corpo, $cabecalho);
    }

    // Altera a senha do usuário
    public function alterPassword($email, $password)
    {
        $sql = 'UPDATE user SET password = :password WHERE email = :email';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', $password);
        $sql->execute();
    }
}