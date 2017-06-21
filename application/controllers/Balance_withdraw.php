<?php
                /*
                    Generate on 12/05/2017 14:17:31
                    Author by Daniel Naranjo
                    www.loultimoenlaweb.com
                */
                class Balance_withdraw extends CI_Controller {
                    public function __construct() {
                        parent::__construct();
                        $this->load->model('Balance_withdraw_model');
                    }
                    public function index($id=FALSE){
                        $data = $this->Balance_withdraw_model->listar($id);
                        echo json_encode($data);
                    }
                    public function view($id){
                        $data = $this->Balance_withdraw_model->obtener($id);
                        echo json_encode($data);
                    }
                    public function add(){
                        $data = $this->Balance_withdraw_model->registrar($this->input->post(NULL, TRUE));
                        if($data){
                            echo json_encode($data);
                        }
                    }
                    public function delete($id){
                        $data = $this->Balance_withdraw_model->deletear($id);
                        echo json_encode($data);
                    }
                    public function update(){
                        $id = $this->input->post("balance_withdraw_id");
                        $data = $this->input->post(NULL, TRUE);
                        $res = $this->Balance_withdraw_model->updatear($id, $data);
                        echo json_encode($res);
                    }
                }//end
                