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
        "primary_key": 0
    },
    {
        "name": "uri",
        "type": "longblob",
        "max_length": null,
        "default": null,
        "primary_key": 0
    }
]
                */
                    class Image_uri_model extends CI_Model {
                        public function __construct() {
                            $this->load->database();
                        }
                        public function listar($id = FALSE){
                            if ($id === FALSE) {
                                    $query = $this->db->get('image_uri');
                                    return $query->result_array();
                            }
                            $query = $this->db->get_where('image_uri', array('image_uri_id' => $id));
                            return $query->row_array();
                        }
                        public function columnas(){
                            $query = $this->db->field_data('image_uri');
                            return $query;
                        }
                        public function obtener($id){
                            $query = $this->db->get_where('image_uri', array('image_uri_id' => $id));
                            return $query->result_array();
                        }
                        public function registrar($data){
                            unset($data['Submit']); // <- Remove garbage POST array!
                            $query = $this->db->insert('image_uri', $data);
                            return $data;
                        }
                        public function updatear($id, $data){
                            $this->db->where('image_uri_id', $id);
                            $this->db->update('image_uri', $data);
                        }
                        public function deletear($id){
                            $this->db->where('image_uri_id', $id);
                            $this->db->delete('image_uri');
                        }
                    }//end
                