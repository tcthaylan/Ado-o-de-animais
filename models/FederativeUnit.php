<?php
class FederativeUnit extends Model
{   
    public function getFUByUf($uf)
    {
        $sql = 'SELECT * FROM federativeUnit WHERE uf = :uf';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':uf', $uf);
        $sql->execute();

        $array = array();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
            return $array;
        }
        return $array;
    }

    // Retorna todas unidades federativas.
    public function getFederativeUnits()
    {
        $sql = 'SELECT * FROM federativeUnit';
        $sql = $this->db->query($sql);
        
        $array = array();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $array;
        }
        return $array;
    }
}