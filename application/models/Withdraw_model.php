<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
                /*
                    Generate on 12/05/2017 14:17:31
                    Author by Daniel Naranjo
                    www.loultimoenlaweb.com

                    [
    {
        "name": "withdraw_id",
        "type": "bigint",
        "max_length": 20,
        "default": null,
        "primary_key": 1
    },
    {
        "name": "user_id",
        "type": "bigint",
        "max_length": 20,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "package_id",
        "type": "bigint",
        "max_length": 20,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "amount",
        "type": "varchar",
        "max_length": 10,
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
        "name": "status",
        "type": "int",
        "max_length": 11,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "requested",
        "type": "timestamp",
        "max_length": null,
        "default": "CURRENT_TIMESTAMP",
        "primary_key": 0
    }
]
                */
                    class Withdraw_model extends CI_Model {
                        public function __construct() {
                            $this->load->database();
                        }
                        public function listar($id = FALSE){
                            if ($id === FALSE) {
                                    $query = $this->db->get('withdraw');
                                    return $query->result_array();
                            }
                            $query = $this->db->get_where('withdraw', array('withdraw_id' => $id));
                            return $query->row_array();
                        }
                        public function columnas(){
                            $query = $this->db->field_data('withdraw');
                            return $query;
                        }
                        public function obtener($id){
                            $query = $this->db->get_where('withdraw', array('withdraw_id' => $id));
                            return $query->result_array();
                        }
                        public function registrar($data){
                            unset($data['Submit']); // <- Remove garbage POST array!
                            $query = $this->db->insert('withdraw', $data);
                            return $data;
                        }
                        public function updatear($id, $data){
                            $this->db->where('withdraw_id', $id);
                            $this->db->update('withdraw', $data);
                        }
                        public function deletear($id){
                            $this->db->where('withdraw_id', $id);
                            $this->db->delete('withdraw');
                        }
                    }//end
                