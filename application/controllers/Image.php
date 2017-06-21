<?php
                /*
                    Generate on 12/05/2017 14:17:31
                    Author by Daniel Naranjo
                    www.loultimoenlaweb.com
                */
                class Image extends CI_Controller {
                    public function __construct() {
                        parent::__construct();
                        $this->load->model('Image_model');
                    }
                    public function index($id=FALSE){
                        $data = $this->Image_model->listar($id);
                        echo json_encode($data);
                    }
                    public function view($id){
                        $data = $this->Image_model->obtener($id);
                        echo json_encode($data);
                    }
                    public function add(){
                        $data = $this->Image_model->registrar($this->input->post(NULL, TRUE));
                        if($data){
                            echo json_encode($data);
                        }
                    }
                    public function delete($id){
                        $data = $this->Image_model->deletear($id);
                        echo json_encode($data);
                    }
                    public function update(){
                        $id = $this->input->post("image_id");
                        $data = $this->input->post(NULL, TRUE);
                        $res = $this->Image_model->updatear($id, $data);
                        echo json_encode($res);
                    }
                    public function action($action = NULL, $id = NULL){
                        $modelo = ucfirst($this->uri->segment(1))."_model";
                        $data['model'] = $this->uri->segment(1);
                        $data['fields'] = $this->$modelo->columnas();
                        $data['tables'] = ""; // <-- Linea 79 / formulario.php
                        if($action){
                            $data['action']="edit";// acction
                            $data['btn']="Editar registro";// Texto boton
                            $data['result'] = $this->$modelo->listar($id);
                        } else {
                            $data['action']="new";// acction
                            $data['btn']="Agregar nuevo";// Texto boton
                            $data['result'] = "";
                            $data['id'] = $id;
                        }
                        $this->load->view('templates/secure');
                        $this->load->view('templates/header');
                        $this->load->view('templates/menu');
                        $this->load->view('forms/pagina', $data);
                        $this->load->view('templates/footer');
                    }
                }//end
