<?php

namespace App\Models;

use App\Core\Model;

class OrdenDeTrabajo extends Model
{
    protected $tableOT = 'OrdenDeTrabajo';
    protected $tableItem = 'itemOT';

    public function get(){
        $ot = $this->db->selectAllOT($this->tableOT);
        $miOT = json_decode(json_encode($ot), True);
        return $miOT;
    }

}
