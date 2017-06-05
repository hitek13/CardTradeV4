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
                                  (idUsuario, Nick, Email, Pass, Nombre, Apellidos, Direccion, Pais, Ciudad, DNI, fechaNac)
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
    public function userTthread ($idUser){
        
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
    public function userMsg ($idUser){
        $i = 0;
        $resp = '';
        $query = $this->db->query("SELECT m.*,u.Nick
                                    FROM `mensajes` as m , usuarios as u
                                    WHERE (m.idEmisor = '".$idUser."' AND m.idReceptor = u.idUsuario) 
                                    OR (m.idReceptor = '".$idUser."' AND m.idEmisor = u.idUsuario) 
                                    ORDER BY m.FecEnvio ASC 
                                ;");
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row)
            {
                $resp[$i] = $row['idEmisor'].'|'.$row['idReceptor'].'|'.$row['FecEnvio'].'|'.$row['Texto'].'|'.$row['Visto'].'|'.$row['Nick'];
                $i++;
            }
            return $resp;
        }
        else
            return 'No existe el usuario';
    }
    public function sendMsg ($idUser, $idReceptor, $fecha, $texto){
        $query = $this->db->query("INSERT INTO mensajes
                                  (idMensaje, idEmisor, idReceptor, FecEnvio, Texto)
                                  VALUES ('".uniqid()."', '".$idUser."', '".$idReceptor."', '".$fecha."', '".$texto."');");
            return $query;
    }
    public function getInfo ($idUser){
        $query = $this->db->query("SELECT Nick, Valoracion
                                    FROM usuarios
                                    WHERE idUsuario = '".$idUser."';");
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row)
            {
                return $row['Nick'].';'.$row['Valoracion'];
            }
        }
        else
            return 'No existe el usuario';
    }
}