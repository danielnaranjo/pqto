<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
                /*
                    Generate on 12/05/2017 14:17:31
                    Author by Daniel Naranjo
                    www.loultimoenlaweb.com

                    [
    {
        "name": "user_info_id",
        "type": "bigint",
        "max_length": 20,
        "default": null,
        "primary_key": 1
    },
    {
        "name": "dni",
        "type": "int",
        "max_length": 11,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "birthdate",
        "type": "date",
        "max_length": null,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "gender",
        "type": "enum",
        "max_length": null,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "city",
        "type": "varchar",
        "max_length": 500,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "province",
        "type": "varchar",
        "max_length": 500,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "country",
        "type": "varchar",
        "max_length": 500,
        "default": null,
        "primary_key": 0
    }
]
                */
                    class User_info_model extends CI_Model {
                        public function __construct() {
                            $this->load->database();
                        }
                        public function listar($id = FALSE){
                            if ($id === FALSE) {
                                    $query = $this->db->get('user_info');
                                    return $query->result_array();
                            }
                            $query = $this->db->get_where('user_info', array('user_info_id' => $id));
                            return $query->row_array();
                        }
                        public function columnas(){
                            $query = $this->db->field_data('user_info');
                            return $query;
                        }
                        public function obtener($id){
                            $query = $this->db->get_where('user_info', array('user_info_id' => $id));
                            return $query->result_array();
                        }
                        public function registrar($data){
                            unset($data['Submit']); // <- Remove garbage POST array!
                            $query = $this->db->insert('user_info', $data);
                            return $data;
                        }
                        public function updatear($id, $data){
                            $this->db->where('user_info_id', $id);
                            $this->db->update('user_info', $data);
                        }
                        public function deletear($id){
                            $this->db->where('user_info_id', $id);
                            $this->db->delete('user_info');
                        }
                    }//end
                