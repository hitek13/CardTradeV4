<?php
/**
 * Created by PhpStorm.
 * User: EXTMcaballer
 * Date: 30/05/2017
 * Time: 12:32
 */

class Signup_model  extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        //$this->load->database(); // ¿? necesario
    }

    public function InsertInto($Nick, $email, $Nombre, $Pass, $Apell, $Direc, $Pais, $Ciudad, $DNI, $fecha){

        $query = $this->db->query("INSERT INTO usuarios
                                  (idUsuario, Nick, Email, Pass, Nombre, Apellidos, Direccion, Ciudad, Pais, DNI, fechaNac)
                                  VALUES ('".uniqid()."', '".$Nick."', '".$email."', '".$Nombre."', '".$Pass."',
                                   '".$Apell."', '".$Direc ."', '".$Pais."', '".$Ciudad."', '".$DNI."', '".$fecha ."');");

        return 'Inserción correcta '.$Pass;
    }
    public function LogIn ($Nick, $Pass){
        $query = $this->db->query("SELECT idUsuario FROM usuarios WHERE Nick LIKE '".$Nick."' AND Pass LIKE '".$Pass."';");

        if($query->num_rows() == 1)
            foreach ($query->result_array() as $row)
            {
                return $row['idUsuario'];
            }
        else
            return 'No existe el usuario, o la contraseña es erronea';
    }
    public function userInfo ($Nick, $idUser){

        $query = $this->db->query("SELECT Email, Nombre, Apellidos, DNI, Direccion, Ciudad, Pais, FechaNac, Saldo, Valoracion
                                    FROM usuarios
                                    WHERE idUsuario LIKE '".$idUser."' AND Nick LIKE '".$Nick."'
                                    ;");
        if($query->num_rows() == 1)
            foreach ($query->result_array() as $row)
            {
                return $row['Email'].';'.$row['Nombre'].';'.$row['Apellidos'].';'.$row['DNI'].';'.$row['Direccion'].';'.$row['Ciudad'].';'.$row['Pais'].';'.$row['FechaNac'].';'.$row['Saldo'].';'.$row['Valoracion'];
            }
        else
            return 'No existe el usuario';
    }
    public function userMsg ($idUser){
        
        $resp = '';
        $query = $this->db->query("select Nick, idUsuario 
                                from usuarios 
                                where idUsuario 
                                IN (select distinct idEmisor from mensajes as m where m.idReceptor='".$idUser."') 
                                OR idUsuario IN(select distinct idReceptor from mensajes as m where m.idEmisor='".$idUser."')
                                ;");
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row)
            {
                $resp .= $row['Nick'].';'.$row['idUsuario'].'|';            
                
            }
            return $resp;
        }
        else
            return 'No existe el usuario';
    }
}