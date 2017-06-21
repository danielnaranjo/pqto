<?php
                /*
                    Generate on 12/05/2017 14:17:31
                    Author by Daniel Naranjo
                    www.loultimoenlaweb.com
                */
                class Image_uri extends CI_Controller {
                    public function __construct() {
                        parent::__construct();
                        $this->load->model('Image_uri_model');
                    }
                    public function index($id=FALSE){
                        $data = $this->Image_uri_model->listar($id);
                        echo json_encode($data);
                    }
                    public function view($id){
                        $data = $this->Image_uri_model->obtener($id);
                        echo json_encode($data);
                    }
                    public function add(){
                        $data = $this->Image_uri_model->registrar($this->input->post(NULL, TRUE));
                        if($data){
                            echo json_encode($data);
                        }
                    }
                    public function delete($id){
                        $data = $this->Image_uri_model->deletear($id);
                        echo json_encode($data);
                    }
                    public function update(){
                        $id = $this->input->post("image_uri_id");
                        $data = $this->input->post(NULL, TRUE);
                        $res = $this->Image_uri_model->updatear($id, $data);
                        echo json_encode($res);
                    }
                }//end
                