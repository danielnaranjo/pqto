<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
                /*
                    Generate on 12/05/2017 14:17:31
                    Author by Daniel Naranjo
                    www.loultimoenlaweb.com

                    [
    {
        "name": "user_id",
        "type": "bigint",
        "max_length": 20,
        "default": null,
        "primary_key": 1
    },
    {
        "name": "name",
        "type": "varchar",
        "max_length": 50,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "lastname",
        "type": "varchar",
        "max_length": 50,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "email",
        "type": "varchar",
        "max_length": 100,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "password",
        "type": "varchar",
        "max_length": 255,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "phone",
        "type": "varchar",
        "max_length": 50,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "address",
        "type": "varchar",
        "max_length": 100,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "token",
        "type": "varchar",
        "max_length": 36,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "registered",
        "type": "timestamp",
        "max_length": null,
        "default": "CURRENT_TIMESTAMP",
        "primary_key": 0
    },
    {
        "name": "type",
        "type": "int",
        "max_length": 1,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "verified",
        "type": "char",
        "max_length": 1,
        "default": "0",
        "primary_key": 0
    }
]
                */
                    class User_model extends CI_Model {
                        public function __construct() {
                            $this->load->database();
                        }
                        public function listar($id = FALSE){
                            if ($id === FALSE) {
                                    $query = $this->db->get('user');
                                    return $query->result_array();
                            }
                            $query = $this->db->get_where('user', array('user_id' => $id));
                            return $query->row_array();
                        }
                        public function columnas(){
                            $query = $this->db->field_data('user');
                            return $query;
                        }
                        public function obtener($id){
                            $query = $this->db->get_where('user', array('user_id' => $id));
                            return $query->result_array();
                        }
                        public function registrar($data){
                            unset($data['Submit']); // <- Remove garbage POST array!
                            $query = $this->db->insert('user', $data);
                            return $data;
                        }
                        public function updatear($id, $data){
                            $this->db->where('user_id', $id);
                            $this->db->update('user', $data);
                        }
                        public function deletear($id){
                            $this->db->where('user_id', $id);
                            $this->db->delete('user');
                        }
                        public function logeo($password, $login){
                            $query = $this->db->get_where('user', array('email' => $login, 'password' => md5($password) ));
                            return $query->row_array();
                        }
                    }//end
