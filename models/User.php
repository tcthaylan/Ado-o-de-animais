<?php
class User extends Model
{   
    private $login;

    // Retorna um usuário com base no id
    public function getUserById($id_user)
    {
        $sql = 'SELECT * FROM user WHERE id_user = :id_user';
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

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getLogin()
    {
        return $this->login;
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
        }
        // Login inválido.
        return false;
    }

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

    // Verifica se um email existe.
    public function emailExists($email)
    {
        $sql = 'SELECT * FROM user WHERE email = :email';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':email', $email);
        $sql->execute();

        // Email existe.
        if ($sql->rowCount() > 0) {
            return true;
        }
        // Email não existe.
        return false;
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

    // Altera os dados de um usuário.
    public function alterUser($id_user, $name, $last_name, $email, $password)
    {
        // Verificando se a senha precisa ser alterada.
        if (!empty($password)) {
            $this->alterPassword($email, $password);
        }

        $sql = 'UPDATE user SET name = :name, last_name = :last_name WHERE id_user = :id_user';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_user', $id_user);
        $sql->bindValue(':name', $name);
        $sql->bindValue(':last_name', $last_name);
        $sql->execute();
    }
}