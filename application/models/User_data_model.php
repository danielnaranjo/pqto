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
        "primary_key": 0
    },
    {
        "name": "user_info_id",
        "type": "bigint",
        "max_length": 20,
        "default": null,
        "primary_key": 0
    }
]
                */
                    class User_data_model extends CI_Model {
                        public function __construct() {
                            $this->load->database();
                        }
                        public function listar($id = FALSE){
                            if ($id === FALSE) {
                                    $query = $this->db->get('user_data');
                                    return $query->result_array();
                            }
                            $query = $this->db->get_where('user_data', array('user_data_id' => $id));
                            return $query->row_array();
                        }
                        public function columnas(){
                            $query = $this->db->field_data('user_data');
                            return $query;
                        }
                        public function obtener($id){
                            $query = $this->db->get_where('user_data', array('user_data_id' => $id));
                            return $query->result_array();
                        }
                        public function registrar($data){
                            unset($data['Submit']); // <- Remove garbage POST array!
                            $query = $this->db->insert('user_data', $data);
                            return $data;
                        }
                        public function updatear($id, $data){
                            $this->db->where('user_data_id', $id);
                            $this->db->update('user_data', $data);
                        }
                        public function deletear($id){
                            $this->db->where('user_data_id', $id);
                            $this->db->delete('user_data');
                        }
                    }//end
                