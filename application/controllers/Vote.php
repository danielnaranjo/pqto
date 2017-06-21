<?php
                /*
                    Generate on 12/05/2017 14:17:31
                    Author by Daniel Naranjo
                    www.loultimoenlaweb.com
                */
                class Vote extends CI_Controller {
                    public function __construct() {
                        parent::__construct();
                        $this->load->model('Vote_model');
                        $this->load->model('Comment_model');
                    }
                    public function index($id=FALSE){
                        $data = $this->Vote_model->listar($id);
                        echo json_encode($data);
                    }
                    public function view($id){
                        $data = $this->Vote_model->obtener($id);
                        echo json_encode($data);
                    }
                    public function add(){
                        $data = $this->Vote_model->registrar($this->input->post(NULL, TRUE));
                        if($data){
                            echo json_encode($data);
                        }
                    }
                    public function delete($id){
                        $data = $this->Vote_model->deletear($id);
                        echo json_encode($data);
                    }
                    public function update(){
                        $id = $this->input->post("vote_id");
                        $data = $this->input->post(NULL, TRUE);
                        $res = $this->Vote_model->updatear($id, $data);
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
                    public function all(){
                        $data['title'] = 'Mi Ranking';
                        $data['subtitulo'] = 'Here is a subtitle for this table';
                        $data['result'] = $this->Vote_model->listar();
                        $data['fields'] = $this->Vote_model->columnas();
                        $this->load->view('templates/secure');
                        $this->load->view('templates/header');
                        $this->load->view('templates/menu');
                        $this->load->view('tables/pages', $data);
                        $this->load->view('templates/footer');
                    }
                    public function explorer(){
                        $data['title'] = 'Explorar';
                        $data['subtitulo'] = 'Here is a subtitle for this table';
                        $data['result'] = $this->Vote_model->votos_resultados();
                        $data['fields'] = $this->Vote_model->votos_columnas();
                        //$data['comments'] = $this->Comment_model->listar();
                        $this->load->view('templates/secure');
                        $this->load->view('templates/header');
                        $this->load->view('templates/menu');
                        $this->load->view('pages/explorer', $data);
                        $this->load->view('templates/footer');
                    }
                }//end
