<?php

namespace App\Models;

use App\Core\Model;

class Permisos extends Model{
    protected $table = 'permisos';
    protected $size_pagina=10;
    
     public function getSize(){
        $num_filas= $this->db->getSize($this->table);
        $total_paginas= ceil($num_filas/$this->size_pagina);
        return $total_paginas;
    }    
  
    public function getPaginacion($page){
        $pagina=$page;
        $empezar_desde=($pagina-1)*$this->size_pagina;
        $num_filas= $this->getSize();
        $total_paginas= ceil($num_filas/$this->size_pagina);
        $especializaciones = $this->db->getAllLimit($this->table,$empezar_desde,$this->size_pagina);
        $todasEspecializaciones = json_decode(json_encode($especializaciones), True);
       
        return $todasEspecializaciones;
    }
    


}
