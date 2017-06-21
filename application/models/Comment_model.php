<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
                /*
                    Generate on 12/05/2017 14:17:31
                    Author by Daniel Naranjo
                    www.loultimoenlaweb.com

                    [
    {
        "name": "comment_id",
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
        "name": "comment",
        "type": "text",
        "max_length": null,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "createdAt",
        "type": "timestamp",
        "max_length": null,
        "default": "CURRENT_TIMESTAMP",
        "primary_key": 0
    },
    {
        "name": "status",
        "type": "char",
        "max_length": 1,
        "default": "1",
        "primary_key": 0
    }
]
                */
                    class Comment_model extends CI_Model {
                        public function __construct() {
                            $this->load->database();
                        }
                        public function listar($id = FALSE){
                            $user_id = $this->session->userdata('user_id');
                            if ($id === FALSE) {
                                    /*
                                    SELECT
                                    	comment.comment,
                                    	CONCAT(user.name,' ',user.lastname) AS user,
                                    	user.email,
                                    	comment.createdAt
                                    FROM comment
                                    LEFT JOIN user ON comment.from_id=user.user_id
                                    WHERE user.user_id = '91'
                                    */
                                    $this->db->select('comment.comment_id, comment.comment,CONCAT(user.name," ",user.lastname) AS user,user.email,comment.createdAt');
                                    $this->db->from('comment');
                                    $this->db->join('user','comment.from_id=user.user_id','left');
                                    $this->db->where('user.user_id', $user_id);
                                    $query = $this->db->get();
                                    return $query->result_array();
                            }
                            // $query = $this->db->get_where('comment', array('comment_id' => $id));
                            $this->db->select('comment.comment_id, comment.comment,CONCAT(user.name," ",user.lastname) AS user,user.email,comment.createdAt');
                            $this->db->from('comment');
                            $this->db->join('user','comment.from_id=user.user_id','left');
                            $this->db->where('user.user_id', $user_id);
                            $query = $this->db->get();
                            return $query->row_array();
                        }
                        public function columnas(){
                            $this->db->select('comment.comment_id, comment.comment,CONCAT(user.name," ",user.lastname) AS user,user.email,comment.createdAt');
                            $this->db->from('comment');
                            $this->db->join('user','comment.from_id=user.user_id','left');
                            $query = $this->db->get();
                            return $query->field_data();
                        }
                        public function obtener($id){
                            $query = $this->db->get_where('comment', array('comment_id' => $id));
                            return $query->result_array();
                        }
                        public function registrar($data){
                            unset($data['Submit']); // <- Remove garbage POST array!
                            $query = $this->db->insert('comment', $data);
                            return $data;
                        }
                        public function updatear($id, $data){
                            $this->db->where('comment_id', $id);
                            $this->db->update('comment', $data);
                        }
                        public function deletear($id){
                            $this->db->where('comment_id', $id);
                            $this->db->delete('comment');
                        }
                    }//end
