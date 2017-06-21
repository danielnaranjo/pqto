<?php
                /*
                    Generate on 12/05/2017 14:17:31
                    Author by Daniel Naranjo
                    www.loultimoenlaweb.com
                */
                class User extends CI_Controller {
                    public function __construct() {
                        parent::__construct();
                        $this->load->model('User_model');
                    }
                    public function index(){
                        $data['title'] = 'Cupones';
                        $data['result'] = $this->User_model->listar();
                        $data['fields'] = $this->User_model->columnas();
                        //
                        $data['title']="Dashboard General";
                        $data['tasks'] = [];
                        //$data['branches'] = $this->Task_model->contador();
                        $data['users'] = [];
                        $data['money'] = [];
                        $data['payments'] = [];//listar()
                        $data['todos'] = [];
                        $data['points'] = [];
                        $data['stats'] = [];
                        $data['branch'] = [];
                        //
                        $this->load->view('templates/secure');
                        $this->load->view('templates/header');
                        $this->load->view('templates/menu');
                        $this->load->view('pages/dashboard', $data);
                        $this->load->view('templates/footer');
                    }
                    public function view($id){
                        $data = $this->User_model->obtener($id);
                        echo json_encode($data);
                    }
                    public function add(){
                        $data = $this->User_model->registrar($this->input->post(NULL, TRUE));
                        if($data){
                            echo json_encode($data);
                        }
                    }
                    public function delete($id){
                        $data = $this->User_model->deletear($id);
                        echo json_encode($data);
                    }
                    public function update(){
                        $id = $this->input->post("user_id");
                        $data = $this->input->post(NULL, TRUE);
                        $res = $this->User_model->updatear($id, $data);
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
                        $data['title'] = 'Cupones';
                        $data['result'] = $this->User_model->listar();
                        $data['fields'] = $this->User_model->columnas();
                        $this->load->view('templates/secure');
                        $this->load->view('templates/header');
                        $this->load->view('templates/menu');
                        $this->load->view('tables/pages', $data);
                        $this->load->view('templates/footer');
                    }
                    public function me(){
                        $data['title'] = 'Cupones';
                        $data['result'] = $this->User_model->listar();
                        $data['fields'] = $this->User_model->columnas();
                        $this->load->view('templates/secure');
                        $this->load->view('templates/header');
                        $this->load->view('templates/menu');
                        $this->load->view('pages/profile', $data);
                        $this->load->view('templates/footer');
                    }
                    public function login(){
                        $this->load->view('site/login');
                    }
                    public function register(){
                        $this->load->view('pages/register');
                    }
                    public function logon(){
                        $login = $this->input->post('email');
                        $password = $this->input->post('password');
                        $data = $this->User_model->logeo($password, $login);
                        if($data!=null){
                            $newdata = array(
                               'user_id'  => $data['user_id'],
                               'username'  => $data['email'],
                               'name'  => $data['name'],
                               'lastname'  => $data['lastname'],
                               'email'     => $data['email'],
                               'logged_in' => TRUE
                            );
                            $this->session->set_userdata($newdata);
                            redirect('user/', 'location', 302);

                        } else {
                            redirect(site_url().'/?msg=Por+favor+verifica+los+datos+de+acceso&login='.time(), 'location');
                        }
                    }
                    public function logout() {
                        $sess_array = array(
                			'user_id'  => '',
                			'username'  => '',
                			'name'  => '',
                            'lastname'  => '',
                			'email'     => '',
                			'level'     => '',
                			'logged_in' => FALSE
                        );
                        $this->session->unset_userdata('logged_in', $sess_array);
                        $data['success'] = 'Has salido correctamente!';
                        $this->output->delete_cache();
                        $this->session->sess_destroy();
                        //$this->load->view('site/login', $data);
                        redirect(site_url().'?nocache=true&logout='.time(), 'location');
                    }
                }//end
