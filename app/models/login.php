<?php

namespace App\Models;

use App\Core\Model;

class login extends Model
{
    protected $table = 'usuarios';

    



    public function get()
    {
        return $this->db->selectAll($this->table);
    }

    

    
}

    