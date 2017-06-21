<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
                /*
                    Generate on 12/05/2017 14:17:31
                    Author by Daniel Naranjo
                    www.loultimoenlaweb.com

                    [
    {
        "name": "code",
        "type": "char",
        "max_length": 50,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "lat",
        "type": "bigint",
        "max_length": 20,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "lng",
        "type": "bigint",
        "max_length": 20,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "name",
        "type": "varchar",
        "max_length": 255,
        "default": null,
        "primary_key": 0
    }
]
                */
                    class Countries_model extends CI_Model {
                        public function __construct() {
                            $this->load->database();
                        }
                        public function listar($id = FALSE){
                            if ($id === FALSE) {
                                    $query = $this->db->get('countries');
                                    return $query->result_array();
                            }
                            $query = $this->db->get_where('countries', array('countries_id' => $id));
                            return $query->row_array();
                        }
                        public function columnas(){
                            $query = $this->db->field_data('countries');
                            return $query;
                        }
                        public function obtener($id){
                            $query = $this->db->get_where('countries', array('countries_id' => $id));
                            return $query->result_array();
                        }
                        public function registrar($data){
                            unset($data['Submit']); // <- Remove garbage POST array!
                            $query = $this->db->insert('countries', $data);
                            return $data;
                        }
                        public function updatear($id, $data){
                            $this->db->where('countries_id', $id);
                            $this->db->update('countries', $data);
                        }
                        public function deletear($id){
                            $this->db->where('countries_id', $id);
                            $this->db->delete('countries');
                        }
                    }//end
                