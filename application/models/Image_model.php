<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
                /*
                    Generate on 12/05/2017 14:17:31
                    Author by Daniel Naranjo
                    www.loultimoenlaweb.com

                    [
    {
        "name": "image_id",
        "type": "bigint",
        "max_length": 20,
        "default": null,
        "primary_key": 1
    },
    {
        "name": "name",
        "type": "varchar",
        "max_length": 254,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "path",
        "type": "varchar",
        "max_length": 254,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "created",
        "type": "timestamp",
        "max_length": null,
        "default": "CURRENT_TIMESTAMP",
        "primary_key": 0
    }
]
                */
                    class Image_model extends CI_Model {
                        public function __construct() {
                            $this->load->database();
                        }
                        public function listar($id = FALSE){
                            if ($id === FALSE) {
                                    $query = $this->db->get('image');
                                    return $query->result_array();
                            }
                            $query = $this->db->get_where('image', array('image_id' => $id));
                            return $query->row_array();
                        }
                        public function columnas(){
                            $query = $this->db->field_data('image');
                            return $query;
                        }
                        public function obtener($id){
                            $query = $this->db->get_where('image', array('image_id' => $id));
                            return $query->result_array();
                        }
                        public function registrar($data){
                            unset($data['Submit']); // <- Remove garbage POST array!
                            $query = $this->db->insert('image', $data);
                            return $data;
                        }
                        public function updatear($id, $data){
                            $this->db->where('image_id', $id);
                            $this->db->update('image', $data);
                        }
                        public function deletear($id){
                            $this->db->where('image_id', $id);
                            $this->db->delete('image');
                        }
                    }//end
                