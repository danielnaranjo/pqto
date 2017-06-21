<?php
                /*
                    Generate on 12/05/2017 14:17:31
                    Author by Daniel Naranjo
                    www.loultimoenlaweb.com
                */
                class User_image extends CI_Controller {
                    public function __construct() {
                        parent::__construct();
                        $this->load->model('User_image_model');
                    }
                    public function index($id=FALSE){
                        $data = $this->User_image_model->listar($id);
                        echo json_encode($data);
                    }
                    public function view($id){
                        $data = $this->User_image_model->obtener($id);
                        echo json_encode($data);
                    }
                    public function add(){
                        $data = $this->User_image_model->registrar($this->input->post(NULL, TRUE));
                        if($data){
                            echo json_encode($data);
                        }
                    }
                    public function delete($id){
                        $data = $this->User_image_model->deletear($id);
                        echo json_encode($data);
                    }
                    public function update(){
                        $id = $this->input->post("user_image_id");
                        $data = $this->input->post(NULL, TRUE);
                        $res = $this->User_image_model->updatear($id, $data);
                        echo json_encode($res);
                    }
                }//end
                