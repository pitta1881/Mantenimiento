<?php

namespace App\Models;

use App\Core\Model;

class SectorModel extends Model{

    public function getTipoSector(){
        return array('Hospital','Casa Comunitaria','Casa Particular');
    }
    
}
