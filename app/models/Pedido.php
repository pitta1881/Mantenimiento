<?php

namespace App\Models;

use App\Core\Model;

class Pedido extends Model
{
    protected $table = 'pedido';

    //ESTO ESTA HARDCODEADO PARA MUESTRAR ALGO NOMAS
    public function getSectores() {
        return array("DAC","CONTABILIDAD","DIRECCION","GUARDIA MEDICA","PABELLON 1","PABELLON 2");
    }

    public function getPrioridades() {
        return array("Baja","Media","Alta","Urgente");
    }

    public function getEstados() {
        return array("Iniciado","En Curso","Pendiente","Finalizado");
    }


    public function get()
    {
        return $this->db->selectAll($this->table);
    }

    public function getByIdPedido($id)
    {
        return $this->db->selectNumeroPedido($this->table,$id);
    }

    public function getTareasByIdPedido($id)
    {
        return [];
    }
    

    public function insert(array $turnosFormulario)
    {
        $this->db->insert($this->table, $turnosFormulario);
    }

    
}
