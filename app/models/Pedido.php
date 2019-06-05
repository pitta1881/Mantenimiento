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
        $pedido = $this->db->selectAll($this->table);
        $miPedido = json_decode(json_encode($pedido), True);
        foreach ($miPedido as $key => $value) {
            $miPedido[$key]['sector'] = str_replace("_"," ",$value['sector']);
        }        
        return $miPedido;
    }

    public function getByIdPedido($id)
    {
        
        $pedido = $this->db->selectNumeroPedido($this->table,$id);
        $miPedido = json_decode(json_encode($pedido), True);
        $miPedido[0]['sector'] = str_replace("_"," ",$miPedido[0]['sector']);
        return $miPedido;
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
