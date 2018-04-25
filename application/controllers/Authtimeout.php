<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';



class Authtimeout extends REST_Controller
{
    public function token_get()
    {
        $tokenData = array();
        $tokenData['id'] = 1; 

        $tokenData['timestamp'] = now();

        $output['token'] = AUTHORIZATION::generateToken($tokenData);



                $this->load->model('Dep_model');
   
              //  $arr=array('title'=> $this->request->body['title'],'content' => $this->request->body['content']);
                $data =$this->Dep_model->getList();

        $this->set_response($output, REST_Controller::HTTP_OK);
         //print_r($data);
        for($i =0;$i < count($data);$i++) {
          echo " ID : " . $data[$i]->id . " \n" . " Title :" . $data[$i]->title . " \n " . " Content :" . $data[$i]->content . "\n \n";
        }
    }

   
    public function token_post()
    {
         $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
   
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                
                  $this->load->model('Dep_model');
   
              //  $arr=array('title'=> $this->request->body['title'],'content' => $this->request->body['content']);
                if($this->Dep_model->save($this->request->body))
                {
                    print_r('Data Inserted successfully');
                }
       
                $this->set_response($decodedToken, REST_Controller::HTTP_OK);
               
                return;
            }
            else
            {

            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
       // print_r($this->input);
    }


    public function token_put($id)
    {
         $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                
                  $this->load->model('Dep_model');
   
              //  $arr=array('title'=> $this->request->body['title'],'content' => $this->request->body['content']);
                if($this->Dep_model->save($this->request->body,$id))
                {
                    print_r('Data Updated successfully');
                }
       
                $this->set_response($decodedToken, REST_Controller::HTTP_OK);
               
                return;
            }
            else
            {

            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
       // print_r($this->input);
    }


      public function token_delete($id)
    {

       // print_r($id);
            $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                
                  $this->load->model('Dep_model');
   
              //  $arr=array('title'=> $this->request->body['title'],'content' => $this->request->body['content']);
                if($this->Dep_model->delete($id))
                {
                    print_r('Data Deleted successfully');
                }
       
                $this->set_response($decodedToken, REST_Controller::HTTP_OK);
               
                return;
            }
            else
            {

            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
     
    }
}