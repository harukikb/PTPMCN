<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tour extends CI_Controller {

    public function __construct(){
        parent::__construct();         
    } 

   function index()
   {
        $data['temp'] = "admin/tour/tour";
        $data['title'] = "Quản lý tour";
        $this->load->model('tours_model');
        $data['list_tour']=$this->tours_model->getList();
        $this->load->view("admin/template",$data);
   }
   
   function add()
   {
        $data['temp'] = "admin/tour/add_tour";
        $data['title'] = "Thêm mới tour";
        $this->load->view("admin/template",$data);
        
   }
   function edit(){
        if ($this->uri->segment(4) === FALSE)
        {
                redirect(base_url()."admin/tour");
        }
        else
        {
                $tour_id = $this->uri->segment(4);
        }
        $data['temp'] = "admin/tour/edit_tour";
        $data['title'] = "Chỉnh sửa thông tin tour";
        $this->load->model('tours_model');
        $tour=$this->tours_model->get_tour_info($tour_id);
        if(empty($tour)){
            redirect(base_url()."admin/tour");
        }
        else {
            $data['tour_info']=$tour;
            $data['list_cate']=$this->tours_model->getListCate();
            $this->load->view("admin/template",$data);
        }
        
        
   }
   function category()
   {
        $data['temp'] = "admin/tour/cate_tour";
        $data['title'] = "Danh mục tour";
        $this->load->view("admin/template",$data);
        
   }
   function get_list_cate_tour()
   {
        $this->load->model('tours_model');
        echo json_encode($this->tours_model->getListCate());
   }
   function submit_add_tour()
   {
        $result = array();
        $tour_title=$this->input->post('tour_title');
        $category_tour_id=$this->input->post('category_tour_id');
        $category_tour_id = implode(',', $category_tour_id);
        $tour_from=$this->input->post('tour_from');
        $tour_destination=$this->input->post('tour_destination');
        $tour_duration=$this->input->post('tour_duration');
        $tour_price=$this->input->post('tour_price');
        $tour_saving_price=$this->input->post('tour_saving_price');
        $tour_thumnail=$this->upload_single_image('tour_thumnail');
        $album_tour=$this->upload_multi_image('album_tour');
        $tour_except=$this->input->post('tour_except');
        $tour_info_contact=$this->input->post('tour_info_contact');
        $tour_keywords=$this->input->post('tour_keywords');
        $tour_description=$this->input->post('tour_description');
        $tour_schedule=$this->input->post('tour_schedule');
        if (empty($tour_title)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $this->load->model('tours_model');
            $this->load->helper(array('string', "text"));
            $tour_slug=convert_accented_characters(url_title($tour_title, 'underscore', TRUE));
            if($this->tours_model->check_tour_slug($tour_slug)){
                $tour_slug=$tour_slug.random_string('alnum', 8);
            }
            
            $add=$this->tours_model->add_tour($tour_title,$category_tour_id,$tour_from,$tour_destination,$tour_duration,$tour_price,$tour_saving_price,$tour_thumnail,$album_tour,$tour_except,$tour_info_contact,$tour_keywords,$tour_description,$tour_schedule,$tour_slug);
            
            if ($add) {
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! Vui lòng thử lại!";
                $return['status'] = 0;
            }
        }
        echo json_encode($result);
    }

    function submit_edit_tour()
   {
        $result = array();
        $tour_id=$this->input->post('tour_id');
        $tour_title=$this->input->post('tour_title');
        $category_tour_id=$this->input->post('category_tour_id');
        $category_tour_id = implode(',', $category_tour_id);
        $tour_from=$this->input->post('tour_from');
        $tour_destination=$this->input->post('tour_destination');
        $tour_duration=$this->input->post('tour_duration');
        $tour_price=$this->input->post('tour_price');
        $tour_saving_price=$this->input->post('tour_saving_price');
        $tour_thumnail=$this->upload_single_image('tour_thumnail');
        $album_tour=$this->upload_multi_image('album_tour');
        $tour_except=$this->input->post('tour_except');
        $tour_info_contact=$this->input->post('tour_info_contact');
        $tour_keywords=$this->input->post('tour_keywords');
        $tour_description=$this->input->post('tour_description');
        $tour_schedule=$this->input->post('tour_schedule');
        $tour_status=$this->input->post('tour_status');
        if (empty($tour_title)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $this->load->model('tours_model');

            if(empty($tour_thumnail)&&empty($album_tour)){
                $add=$this->tours_model->update_tour_no_images($tour_id,$tour_title,$category_tour_id,$tour_from,$tour_destination,$tour_duration,$tour_price,$tour_saving_price,$tour_except,$tour_info_contact,$tour_keywords,$tour_description,$tour_schedule,$tour_status);
            }
            else if(empty($tour_thumnail)){
                $add=$this->tours_model->update_tour_no_thumnail($tour_id,$tour_title,$category_tour_id,$tour_from,$tour_destination,$tour_duration,$tour_price,$tour_saving_price,$album_tour,$tour_except,$tour_info_contact,$tour_keywords,$tour_description,$tour_schedule,$tour_status);
            }
            else if(empty($album_tour)){
                $add=$this->tours_model->update_tour_no_album($tour_id,$tour_title,$category_tour_id,$tour_from,$tour_destination,$tour_duration,$tour_price,$tour_saving_price,$tour_thumnail,$tour_except,$tour_info_contact,$tour_keywords,$tour_description,$tour_schedule,$tour_status);
            }
            else{
                $add=$this->tours_model->update_tour($tour_id,$tour_title,$category_tour_id,$tour_from,$tour_destination,$tour_duration,$tour_price,$tour_saving_price,$tour_thumnail,$album_tour,$tour_except,$tour_info_contact,$tour_keywords,$tour_description,$tour_schedule,$tour_status);
            }
                
            
            if ($add) {
                $result['status_value'] = "Sửa thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! Vui lòng thử lại!";
                $return['status'] = 0;
            }
        }
        echo json_encode($result);
    }

   function submit_add_category()
   {
        $result = array();
        $cate_name = $this->input->post('cate_name');
        $cate_slug = $this->input->post('cate_slug');
        if (empty($cate_name)||empty($cate_slug)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        }elseif ($this->check_space($cate_slug)) {
            $result['status_value'] = "Slug không được có khoảng trắng!";
            $result['status'] = 0;
        } else {
            $this->load->model('tours_model');
            $add = $this->tours_model->add_category($cate_name,$cate_slug);
            if ($add) {
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! Category slug đã tồn tại!";
                $return['status'] = 0;
            }
        }
        echo json_encode($result);
   }
   //trả về true nếu có khoảng trắng
   function check_space($str){
       if(!strpos($str, " " )){
           return FALSE;
       }
       return TRUE;
   }
   function check_del_tour()
   {
        $result = array();
        $tour_id = $this->input->post('tour_id');
        $this->load->model('tours_model');
        $del = $this->tours_model->del_tour($tour_id);
        if ($del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
        } else {
            $result['status_value'] = "Lỗi! Vui lòng thử lại sau!";
            $return['status'] = 0;
        }
        echo json_encode($result);
   }
   function check_del_category()
   {
        $result = array();
        $cate_id = $this->input->post('cate_id');
        $this->load->model('tours_model');
        $del = $this->tours_model->del_category($cate_id);
        if ($del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
        } else {
            $result['status_value'] = "Lỗi! Vui lòng thử lại sau!";
            $return['status'] = 0;
        }
        echo json_encode($result);
   }

   function check_edit_category()
   {
        $result = array();
        $cate_id = $this->input->post('cate_id');
        $cate_name = $this->input->post('cate_name');
        $cate_slug = $this->input->post('cate_slug');
        if (empty($cate_name)||empty($cate_slug)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        }elseif ($this->check_space($cate_slug)) {
            $result['status_value'] = "Slug không được có khoảng trắng!";
            $result['status'] = 0;
        } else {
            $this->load->model('tours_model');
            $add = $this->tours_model->edit_category($cate_id,$cate_name,$cate_slug);
            if ($add) {
                $result['status_value'] = "Sửa thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! Category slug đã tồn tại!";
                $return['status'] = 0;
            }
        }
        echo json_encode($result);
   }

   //phuong thuc upload nhieu anh: ket qua tra ve la 1 chuoi chua ten cac anh duoc chon
    public function upload_multi_image($img_post_name){
        $image = "";
        if(!empty($_FILES[$img_post_name]['name'])){
            $filesCount = count($_FILES[$img_post_name]['name']);
            $hinh=array();
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['file']['name']     = $_FILES[$img_post_name]['name'][$i];
                $_FILES['file']['type']     = $_FILES[$img_post_name]['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES[$img_post_name]['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES[$img_post_name]['error'][$i];
                $_FILES['file']['size']     = $_FILES[$img_post_name]['size'][$i];
                
                // File upload configuration
                $uploadPath = './uploads/images/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '30000';
                $config['remove_spaces'] = true;

                $path = realpath($uploadPath);
                if($path === false && !is_dir($path)) 
                    mkdir($uploadPath);
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $uploadData=array();
                // Upload file to server
                if($this->upload->do_upload('file')){
                    // Uploaded file data
                    $uploadData = $this->upload->data();
                    
                }
                if(!empty($uploadData)){
                    $resize_conf = array(
                        // it's something like "/full/path/to/the/image.jpg" maybe
                        'source_image'  => $uploadData['full_path'],
                        // and it's "/full/path/to/the/" + "thumb_" + "image.jpg
                        // or you can use 'create_thumbs' => true option instead
                        'new_image'     => $uploadData['file_path'].'thumb_'.$uploadData['file_name'],
                        'width'         => 200,
                        'height'        => 160
                        );
    
                    // initializing
                    $this->load->library('image_lib',$resize_conf);
    
                    // do it!
                    if ( ! $this->image_lib->resize())
                    {
                        // if got fail.
                        $error['resize'][] = $this->image_lib->display_errors();
                    }
                    else
                    {
                        // otherwise, put each upload data to an array.
                        array_push($hinh,$uploadData['file_name']);
                    }
    
                }
            }
            $image = implode(',',$hinh);
        }
        
        return $image;
    }

    //Phuong thuc upload 1 anh: ket qua tra ve la ten anh trong host
    public function upload_single_image($img_post_name){
        $image = "";
        if(!empty($_FILES[$img_post_name]['name'])){
            $uploadPath = './uploads/images/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = '30000';
            $config['remove_spaces'] = true;
            $path = realpath($uploadPath);
            if($path === false && !is_dir($path)) 
                mkdir($uploadPath);
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload($img_post_name))
            {
                $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $uploadData =  $this->upload->data();
                $resize_conf = array(
                    // it's something like "/full/path/to/the/image.jpg" maybe
                    'source_image'  => $uploadData['full_path'],
                    // and it's "/full/path/to/the/" + "thumb_" + "image.jpg
                    // or you can use 'create_thumbs' => true option instead
                    'new_image'     => $uploadData['file_path'].'thumb_'.$uploadData['file_name'],
                    'width'         => 200,
                    'height'        => 160
                    );

                // initializing
                $this->load->library('image_lib',$resize_conf);

                // do it!
                if ( ! $this->image_lib->resize())
                {
                    // if got fail.
                    $error['resize'][] = $this->image_lib->display_errors();
                }
                else
                {
                    // otherwise, put each upload data to an array.
                    $image=$uploadData['file_name'];
                }
                
            }
        }
        return $image;
    }
}