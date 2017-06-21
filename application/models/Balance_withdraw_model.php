<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
                /*
                    Generate on 12/05/2017 14:17:31
                    Author by Daniel Naranjo
                    www.loultimoenlaweb.com

                    [
    {
        "name": "balance_id",
        "type": "bigint",
        "max_length": 20,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "withdraw_id",
        "type": "bigint",
        "max_length": 20,
        "default": null,
        "primary_key": 0
    }
]
                */
                    class Balance_withdraw_model extends CI_Model {
                        public function __construct() {
                            $this->load->database();
                        }
                        public function listar($id = FALSE){
                            if ($id === FALSE) {
                                    $query = $this->db->get('balance_withdraw');
                                    return $query->result_array();
                            }
                            $query = $this->db->get_where('balance_withdraw', array('balance_withdraw_id' => $id));
                            return $query->row_array();
                        }
                        public function columnas(){
                            $query = $this->db->field_data('balance_withdraw');
                            return $query;
                        }
                        public function obtener($id){
                            $query = $this->db->get_where('balance_withdraw', array('balance_withdraw_id' => $id));
                            return $query->result_array();
                        }
                        public function registrar($data){
                            unset($data['Submit']); // <- Remove garbage POST array!
                            $query = $this->db->insert('balance_withdraw', $data);
                            return $data;
                        }
                        public function updatear($id, $data){
                            $this->db->where('balance_withdraw_id', $id);
                            $this->db->update('balance_withdraw', $data);
                        }
                        public function deletear($id){
                            $this->db->where('balance_withdraw_id', $id);
                            $this->db->delete('balance_withdraw');
                        }
                    }//end
                