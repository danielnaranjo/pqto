<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
                /*
                    Generate on 12/05/2017 14:17:31
                    Author by Daniel Naranjo
                    www.loultimoenlaweb.com

                    [
    {
        "name": "package_id",
        "type": "bigint",
        "max_length": 20,
        "default": null,
        "primary_key": 1
    },
    {
        "name": "user_id",
        "type": "bigint",
        "max_length": 20,
        "default": "0",
        "primary_key": 0
    },
    {
        "name": "category_id",
        "type": "int",
        "max_length": 11,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "origin_id",
        "type": "int",
        "max_length": 11,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "destination_id",
        "type": "int",
        "max_length": 11,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "service_id",
        "type": "int",
        "max_length": 11,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "tracking",
        "type": "int",
        "max_length": 11,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "title",
        "type": "varchar",
        "max_length": 50,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "description",
        "type": "text",
        "max_length": null,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "created",
        "type": "timestamp",
        "max_length": null,
        "default": "CURRENT_TIMESTAMP",
        "primary_key": 0
    },
    {
        "name": "delivery",
        "type": "datetime",
        "max_length": null,
        "default": null,
        "primary_key": 0
    },
    {
        "name": "auction",
        "type": "enum",
        "max_length": null,
        "default": "N",
        "primary_key": 0
    },
    {
        "name": "status",
        "type": "char",
        "max_length": 1,
        "default": "0",
        "primary_key": 0
    }
]
                */
                    class Package_model extends CI_Model {
                        public function __construct() {
                            $this->load->database();
                        }
                        public function listar($id = FALSE){
                            if ($id === FALSE) {
                                    $query = $this->db->get('package');
                                    return $query->result_array();
                            }
                            $query = $this->db->get_where('package', array('package_id' => $id));
                            return $query->row_array();
                        }
                        public function columnas(){
                            $query = $this->db->field_data('package');
                            return $query;
                        }
                        public function obtener($id){
                            //$query = $this->db->get_where('package', array('package_id' => $id));
                            $this->db->select('package.*, countries.name as destination, service.type as service_id');
                            $this->db->from('package');
                            $this->db->join('countries','package.destination=countries.code','left');
                            $this->db->join('service','package.service_id=service.service_id','left');
                            $this->db->where('package.package_id', $id);
                            $query = $this->db->get();
                            return $query->row_array();
                        }
                        public function registrar($data){
                            $data['user_id'] = $this->session->userdata('user_id');;
                            $data['status'] = 0;
                            $data['created'] = date("Y-m-d H:m:s");
                            unset($data['Submit']); // <- Remove garbage POST array!
                            $query = $this->db->insert('package', $data);
                            return $data;
                        }
                        public function updatear($id, $data){
                            $this->db->where('package_id', $id);
                            $this->db->update('package', $data);
                        }
                        public function deletear($id){
                            $this->db->where('package_id', $id);
                            $this->db->delete('package');
                        }
                        public function listapersonalizadas($id = FALSE){
                            if ($id === FALSE) {
                                $this->db->select('package.package_id,package.origin,package.title,package.description,package.created,package.auction,package.price,countries.name, user.name AS user,service.type');
                                $this->db->from('package');
                                $this->db->join('countries','package.destination=countries.code','left');
                                $this->db->join('user','package.user_id=user.user_id','left');
                                $this->db->join('service','package.service_id=service.service_id','left');
                                $query = $this->db->get();
                                return $query->result_array(); //$this->db->last_query();
                            }
                            $this->db->select('package.package_id,package.origin,package.title,package.description,package.created,package.auction,package.price,countries.name, user.name AS user,service.type');
                            $this->db->from('package');
                            $this->db->join('countries','package.destination=countries.code','left');
                            $this->db->join('user','package.user_id=user.user_id','left');
                            $this->db->join('service','package.service_id=service.service_id','left');
                            $this->db->where('package.package_id',$id);
                            $query = $this->db->get();
                            return $query->row_array();
                        }
                        public function columnaspersonalizadas(){
                            $this->db->select('package.package_id,package.origin,package.title,package.description,package.created,package.auction,package.price,countries.name,user.name AS user,service.type');
                            $this->db->from('package');
                            $this->db->join('countries','package.destination=countries.code','left');
                            $this->db->join('user','package.user_id=user.user_id','left');
                            $this->db->join('service','package.service_id=service.service_id','left');
                            $query = $this->db->get();
                            //$this->db->field_data('package');
                            return $query->list_fields();
                        }
                        public function paquetes_resultados($id = FALSE){
                            $user_id = $this->session->userdata('user_id');
                            if ($id === FALSE) {
                                $this->db->select('package.package_id, package.title, countries.name as destination, service.type as service_id, package.status');
                                $this->db->from('package');
                                $this->db->join('countries','package.destination=countries.code','left');
                                $this->db->join('service','package.service_id=service.service_id','left');
                                $this->db->where('package.user_id', $user_id);
                                $query = $this->db->get();
                                return $query->result_array();
                            }
                            $query = $this->db->get_where('package', array('package_id' => $id, 'user_id' => $user_id));
                            return $query->row_array();
                        }
                        public function paquetes_columnas(){
                            $this->db->select('package.package_id, package.title, countries.name as destination, service.type as service_id, package.status');
                            $this->db->from('package');
                            $this->db->join('countries','package.destination=countries.code','left');
                            $this->db->join('service','package.service_id=service.service_id','left');
                            $query = $this->db->get();
                            return $query->field_data();
                        }
                    }//end
