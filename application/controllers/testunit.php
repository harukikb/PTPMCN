<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestUnit extends CI_Controller {
    public function __construct(){
        parent::__construct();  
        $this->load->library("unit_test");
    }

    public function test_tour_count()
    {
        $a="";
        $this->load->model('tours_model');
        $b=$this->tours_model->tours_count($a,$a,$a,$a);
        return $b;

    }

    public function test_getlisthavekey(){
        $this->load->model('tours_model');
        $b=$this->tours_model->getListHaveKey('xanh',1,6);
        return count($b);
    }

    public function test_gettourbyslug(){
        $this->load->model('tours_model');
        $b=$this->tours_model->get_tour_info_by_slug('bf');
        $c=$b->tour_name;
        return $c;
    }

    public function test_getListHaveFilter(){
        $category="";
        $rating=null;
        $minprice=1700000;
        $maxprice=3000000;
        $orderby="";
        $page=1;
        $page_size=6;
        $this->load->model('tours_model');
        $b=$this->tours_model->getListHaveFilter($category,$rating,$minprice,$maxprice,$orderby,$page,$page_size);
        return count($b);
    }

    public function test_get_list_convenient_tour(){
        $this->load->model('tours_model');
        $b=$this->tours_model->get_list_convenient_tour(3);
        return count($b);

    }

    public function index(){

        $test2= $this->test_tour_count();
        $expected2=4;
        $text_name2="test count tour";
        echo $this->unit->run($test2,$expected2,$text_name2);

        $test3= $this->test_getlisthavekey();
        $expected3=2;
        $text_name3="test search tour";
        echo $this->unit->run($test3,$expected3,$text_name3);

        $test4= $this->test_gettourbyslug();
        $expected4="Đà Nẵng";
        $text_name4="test get tour by slug";
        echo $this->unit->run($test4,$expected4,$text_name4);
        
        $test5= $this->test_getListHaveFilter();
        $expected5=2;
        $text_name5="test count tour have filter";
        echo $this->unit->run($test5,$expected5,$text_name5);

        $test6= $this->test_get_list_convenient_tour();
        $expected6=5;
        $text_name6="test count convenient tour";
        echo $this->unit->run($test6,$expected6,$text_name6);
    }
}