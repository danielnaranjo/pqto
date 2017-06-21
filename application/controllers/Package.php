<?php
                /*
                    Generate on 12/05/2017 14:17:31
                    Author by Daniel Naranjo
                    www.loultimoenlaweb.com
                */
                class Package extends CI_Controller {
                    public function __construct() {
                        parent::__construct();
                        $this->load->model('Package_model');
                    }
                    public function index($id=FALSE){
                        $data = $this->Package_model->listar($id);
                        echo json_encode($data);
                    }
                    public function view($id){
                        $data = $this->Package_model->obtener($id);
                        echo json_encode($data);
                    }
                    public function add(){
                        $data = $this->Package_model->registrar($this->input->post(NULL, TRUE));
                        if($data){
                            // echo json_encode($data);
                            redirect($this->uri->segment(1).'/all');
                        }
                    }
                    public function delete($id){
                        $data = $this->Package_model->deletear($id);
                        // echo json_encode($data);
                        redirect($this->uri->segment(1).'/all');
                    }
                    public function update(){
                        $id = $this->input->post("package_id");
                        $data = $this->input->post(NULL, TRUE);
                        $res = $this->Package_model->updatear($id, $data);
                        // echo json_encode($res);
                        redirect($this->uri->segment(1).'/all');
                    }
                    public function action($action = NULL, $id = NULL){
                        $this->load->library('uuid');
                        $data['uuid'] = $this->uuid->v4();
                        $modelo = ucfirst($this->uri->segment(1))."_model";
                        $data['model'] = $this->uri->segment(1);
                        $data['fields'] = $this->$modelo->columnas();
                        $data['tables']['service'] = $this->Service_model->listar(); // <-- Linea 79 / formulario.php
                        $data['tables']['countries'] = $this->Countries_model->listar(); // <-- Linea 79 / formulario.php
                        //$data['tables'][1] = $this->Package_model->listar(); // <-- Linea 79 / formulario.php
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

                    public function all(){
                        $data['title'] = 'Mis paquetes';
                        $data['subtitulo'] = 'Here is a subtitle for this table';
                        $data['result'] = $this->Package_model->paquetes_resultados();
                        $data['fields'] = $this->Package_model->paquetes_columnas();

                        $this->load->view('templates/secure');
                        $this->load->view('templates/header');
                        $this->load->view('templates/menu');
                        $this->load->view('tables/pages', $data);
                        $this->load->view('templates/footer');
                    }
                    public function explorer(){
                        $data['title'] = 'Explorar';
                        $data['subtitulo'] = 'Here is a subtitle for this table';
                        $data['result'] = $this->Package_model->listapersonalizadas();
                        $data['fields'] = $this->Package_model->columnaspersonalizadas();
                        $this->load->view('templates/secure');
                        $this->load->view('templates/header');
                        $this->load->view('templates/menu');
                        $this->load->view('pages/explorer', $data);
                        $this->load->view('templates/footer');
                    }
                }//end
