<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
                /*
                    Generate on 12/05/2017 14:17:31
                    Author by Daniel Naranjo
                    www.loultimoenlaweb.com

                    [
    {
        "name": "service_id",
        "type": "int",
        "max_length": 11,
        "default": null,
        "primary_key": 1
    },
    {
        "name": "type",
        "type": "varchar",
        "max_length": 50,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "price",
        "type": "int",
        "max_length": 10,
        "default": "0",
        "primary_key": 0
    },
    {
        "name": "rate",
        "type": "int",
        "max_length": 10,
        "default": "0",
        "primary_key": 0
    }
]
                */
                    class Service_model extends CI_Model {
                        public function __construct() {
                            $this->load->database();
                        }
                        public function listar($id = FALSE){
                            if ($id === FALSE) {
                                    $query = $this->db->get('service');
                                    return $query->result_array();
                            }
                            $query = $this->db->get_where('service', array('service_id' => $id));
                            return $query->row_array();
                        }
                        public function columnas(){
                            $query = $this->db->field_data('service');
                            return $query;
                        }
                        public function obtener($id){
                            $query = $this->db->get_where('service', array('service_id' => $id));
                            return $query->result_array();
                        }
                        public function registrar($data){
                            unset($data['Submit']); // <- Remove garbage POST array!
                            $query = $this->db->insert('service', $data);
                            return $data;
                        }
                        public function updatear($id, $data){
                            $this->db->where('service_id', $id);
                            $this->db->update('service', $data);
                        }
                        public function deletear($id){
                            $this->db->where('service_id', $id);
                            $this->db->delete('service');
                        }
                    }//end
                