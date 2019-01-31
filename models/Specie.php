<?php
class Specie extends Model
{
    public function getSpecies()
    {
        $sql = 'SELECT * FROM specie';
        $sql = $this->db->query($sql);
        
        $array = array();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
    }
}