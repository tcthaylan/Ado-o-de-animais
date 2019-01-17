<?php
class FederativeUnit extends Model
{
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