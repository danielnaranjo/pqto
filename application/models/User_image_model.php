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
        "name": "image_id",
        "type": "bigint",
        "max_length": 20,
        "default": null,
        "primary_key": 1
    }
]
                */
                    class User_image_model extends CI_Model {
                        public function __construct() {
                            $this->load->database();
                        }
                        public function listar($id = FALSE){
                            if ($id === FALSE) {
                                    $query = $this->db->get('user_image');
                                    return $query->result_array();
                            }
                            $query = $this->db->get_where('user_image', array('user_image_id' => $id));
                            return $query->row_array();
                        }
                        public function columnas(){
                            $query = $this->db->field_data('user_image');
                            return $query;
                        }
                        public function obtener($id){
                            $query = $this->db->get_where('user_image', array('user_image_id' => $id));
                            return $query->result_array();
                        }
                        public function registrar($data){
                            unset($data['Submit']); // <- Remove garbage POST array!
                            $query = $this->db->insert('user_image', $data);
                            return $data;
                        }
                        public function updatear($id, $data){
                            $this->db->where('user_image_id', $id);
                            $this->db->update('user_image', $data);
                        }
                        public function deletear($id){
                            $this->db->where('user_image_id', $id);
                            $this->db->delete('user_image');
                        }
                    }//end
                