<?php
/**
 * Pages Class
 *
 * @package GoCart
 * @subpackage Models
 * @departments Pages
 * @author Clear Sky Designs
 * @link http://gocartdv.com
 */

Class Dep_model extends CI_Model
{
    public function __construct()
    {

    }
    
     public function save($departments,$id=false)
    {
        if (@$id)
        {
            $this->db->where('id', $id);
            $this->db->update('departments', $departments);
             return $id;

        }
        else
        {
            $this->db->insert('departments', $departments);
            $departments['id'] = $this->db->insert_id();
             return $departments['id'];
        }
               
    }





    public function getList()
    {

                $this->db->select('*');
                return $this->db->get('departments')->result();
    }

    public function find($id = FALSE,$Admin = FALSE)
    {
        if ($Admin == FALSE) {$this->db->select('*,
        url_'.config_item('language').' as url,
        description_'.config_item('language').' as description,
        name_'.config_item('language').' as name');}
    	if ($id == FALSE) {return $this->db->get('departments')->result_array();} 
	    else {return $this->db->get_where('departments', array('id'=>$id))->row();}
    	
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('departments');
        return true;
    }

}