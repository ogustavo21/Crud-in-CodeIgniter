<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Example extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        
        //load user model
        $this->load->model('user');
    }
    
    public function user_get($id = 0) {
        //returns all rows if the id parameter doesn't exist,
        //otherwise single row will be returned
        $users = $this->user->getRows($id);
        
        //check if the user data exists
        if(!empty($users)){
            //set the response and exit
            $this->response($users, REST_Controller::HTTP_OK);
        }else{
            //set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No user were found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    public function user_post() {
        $userData = array();
        $userData['email'] = $this->post('email');
        $userData['contraseña'] = $this->post('contraseña');
        if(!empty($userData['email']) && !empty($userData['contraseña'])){
            //insert user data
            $insert = $this->user->insert($userData);
            
            //check if the user data inserted
            if($insert){
                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'User has been added successfully.'
                ], REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            //set the response and exit
            $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    
   public function user_put() {
        $userData = array();
        $id = $this->put('id');
        $userData['email'] = $this->put('email');
        $userData['contraseña'] = $this->put('contraseña');
        if(!empty($id) && !empty($userData['email']) && !empty($userData['contraseña']) ){
            //update user data
            $update = $this->user->update($userData, $id);
            
            //check if the user data updated
            if($update){
                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'User has been updated successfully.'
                ], REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            //set the response and exit
            $this->response("Provide complete user information to update.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    
    public function user_delete($id){
        //check whether post id is not empty
        if($id){
            //delete post
            $delete = $this->user->delete($id);
            
            if($delete){
                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'User has been removed successfully.'
                ], REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            //set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No user were found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }  
}

?>