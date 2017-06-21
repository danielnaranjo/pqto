<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
                /*
                    Generate on 12/05/2017 14:17:31
                    Author by Daniel Naranjo
                    www.loultimoenlaweb.com

                    [
    {
        "name": "vote_id",
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
        "name": "from_id",
        "type": "bigint",
        "max_length": 20,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "downvotes",
        "type": "varchar",
        "max_length": 50,
        "default": "0",
        "primary_key": 0
    },
    {
        "name": "upvotes",
        "type": "varchar",
        "max_length": 50,
        "default": "0",
        "primary_key": 0
    },
    {
        "name": "createdAt",
        "type": "timestamp",
        "max_length": null,
        "default": "CURRENT_TIMESTAMP",
        "primary_key": 0
    }
]
                */
                    class Vote_model extends CI_Model {
                        public function __construct() {
                            $this->load->database();
                        }
                        public function listar($id = FALSE){
                            if ($id === FALSE) {
                                    $query = $this->db->get('vote');
                                    return $query->result_array();
                            }
                            $query = $this->db->get_where('vote', array('vote_id' => $id));
                            return $query->row_array();
                        }
                        public function columnas(){
                            $query = $this->db->field_data('vote');
                            return $query;
                        }
                        public function obtener($id){
                            $query = $this->db->get_where('vote', array('vote_id' => $id));
                            return $query->result_array();
                        }
                        public function registrar($data){
                            unset($data['Submit']); // <- Remove garbage POST array!
                            $query = $this->db->insert('vote', $data);
                            return $data;
                        }
                        public function updatear($id, $data){
                            $this->db->where('vote_id', $id);
                            $this->db->update('vote', $data);
                        }
                        public function deletear($id){
                            $this->db->where('vote_id', $id);
                            $this->db->delete('vote');
                        }
                        public function votos_resultados($id = FALSE){
                            $user_id = $this->session->userdata('user_id');
                            if ($id === FALSE) {
                                $this->db->select('vote.downvotes,vote.upvotes,CONCAT(user.name, " ",user.lastname) AS user, user.email,vote.createdAt');
                                $this->db->from('vote');
                                $this->db->join('user','vote.user_id=user.user_id','left');
                                $query = $this->db->get();
                                return $query->result_array();
                            }
                            $query = $this->db->get_where('vote', array('vote_id' => $id));
                            return $query->row_array();
                        }
                        public function votos_columnas(){
                            $this->db->select('vote.downvotes,vote.upvotes,CONCAT(user.name, " ",user.lastname) AS user, user.email,vote.createdAt');
                            $this->db->from('vote');
                            $this->db->join('user','vote.user_id=user.user_id','left');
                            $query = $this->db->get();
                            return $query->field_data();
                        }
                    }//end
