<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishes extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Wish');
    }

	public function wish_items() {
		$this->load->view('index');
	}

	public function register() {

		// $this->load->model('Wish');
        $this->load->library('form_validation');
        $this->form_validation->set_rules("username", "Username", "trim|required|is_unique[users.username]");
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]'); 
		$this->form_validation->set_rules('confirm', 'Password Confirmation', 'required|matches[password]');

		if ($this->form_validation->run() === FALSE)
		{
			$this->session->set_flashdata('validation', validation_errors());
			redirect('/');
		}
		else
		{
			$this->Wish->registerUser($this->input->post());
			$this->session->set_flashdata('validation', 'Registration successful.');
		}

        redirect('/');
	}

	public function login() {
        // $this->load->model('Wish');
        $user = $this->Wish->loginUser($this->input->post());
        if ($user) {
        	$this->session->set_userdata('currentUser', $user);
        } else {
        	$this->session->set_flashdata('error', 'Invalid email or password.');
        	redirect('/');
        }
        redirect('/Wishes/viewDash');
    }

    public function logout() {
    	$this->session->unset_userdata('currentUser');
    	redirect('/');
    }

    public function viewDash() {
    	$results = $this->Wish->createTables();
    	$results2 = $this->Wish->createTables2();
    	$data['results'] = $results;
    	$data['results2'] = $results2;
    	$this->load->view('dashboard', $data);
    }

    public function createView() {
    	$this->load->view('create');
    }

    public function create() {
    	$this->load->library('form_validation');
        $this->form_validation->set_rules("creation", "Item", "trim|alpha_numeric|required|is_unique[items.name]|min_length[3]");

        if ($this->form_validation->run() === FALSE)
		{
			$this->session->set_flashdata('validation', validation_errors());
			redirect('/Wishes/createView');
		}
		else
		{
			$this->Wish->registerItem($this->input->post());
			$this->session->set_flashdata('validation', 'Item successfully added.');
		}

        redirect('/Wishes/viewDash');
    }

    public function remove($c, $n) {
    	if ($this->session->userdata('currentUser')['name'] == $c) {
    		$this->Wish->deleteItem($n); // delete item from items table
    	} else {
    		$this->Wish->unwishItem($n); // unwishlist item from wishlist table
    	}
    	redirect('/Wishes/viewDash');

    }

    public function addtoWL($n) {
    	$this->Wish->wishItem($n);
    }

    public function products($n) {
 		$results = $this->Wish->grabUsers($n);
 		$data['toyName'] = $n;
 		$data['results'] = $results;
    	$this->load->view('viewProduct', $data);
    }
}