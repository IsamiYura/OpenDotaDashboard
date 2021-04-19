<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fetch extends CI_Controller {

    public $final_1, $final_2, $final_3;

    public function compareRate($pick,$win){
        $rate = $win/$pick;
        return $rate;
    }

	public function index()
	{
        $this->load->library('table');
        //get data api
        $json = json_decode(file_get_contents("https://api.opendota.com/api/herostats"), true);
        // format echo object[urutan data hero][jenis data]
        
        $data['json']=$json;
        
        $data['dataCount']=count($json);

        // echo print_r($final_1);
        $this->load->view("v_fetch",$data);
        // echo print_r($json);



	}

    public function get_by_id(){
        $id = $this->input->post('id');
        $json = json_decode(file_get_contents("https://api.opendota.com/api/herostats"), true);
        for ($x = 0; $x < count($json); $x++) {
        foreach($json[$x] as $key => $value) {
            if($key=='id'){
                if($value==$id){
                    $data = $json[$x];
                }
                break;
            }
        }
    }
    echo json_encode($data);
}


    public function meta1(){
        $this->load->library('table');
        //get data api
        $json = json_decode(file_get_contents("https://api.opendota.com/api/herostats"), true);
        // format echo object[urutan data hero][jenis data]
        
        $data['json']=$json;

        
            for ($x = 0; $x < count($json); $x++) {
                foreach($json[$x] as $key => $value) {
                    if($key=='localized_name'){
                        $data[$key] = array($value);
                        $name = $value;
                    }
                    else if($key=='1_pick'){
                        $data[$key] = array($value);
                        $compare_1[$x]=array(
                            'index' =>$json[$x]['id'],
                            '1pick' =>$value
                        );
                    } else if($key=='1_win'){
                        $data[$key] = array($value);
                        $final_1[$x]=array_merge($compare_1[$x],array('1win'=>$value));
                        $percentage=$this->compareRate($final_1[$x]['1pick'],$final_1[$x]['1win']);
                        $final_1[$x]=array_merge($final_1[$x],array(
                            'percentage'=>$percentage,
                            'localized_name'=>$name
                        ));                    
                    } else {
                        $data[$key] = array($value);
                    }
                    
                }
            
            }
            $percentage = array_column($final_1, 'percentage');
    
            array_multisort($this->sortRatePercentage($final_1), SORT_DESC, $final_1);
    
            $data['dataCount']=count($json);
            $data['winner1']=$final_1;
            
            $this->load->view("v_meta1",$data);
        
        
    }

    public function sortRatePercentage($array){
        $percentage = array_column($array, 'percentage');
        return $percentage;
    }

    public function setTier(){
        if($this->input->is_ajax_request()){
            $tier = $this->input->post('id');
        
        //get data api
        $json = json_decode(file_get_contents("https://api.opendota.com/api/herostats"), true);
        // format echo object[urutan data hero][jenis data]

            for ($x = 0; $x < count($json); $x++) {
                foreach($json[$x] as $key => $value) {
                    if($key=='1_pick'){
                        $compare_1[$x]=array(
                            'index' =>$json[$x]['id'],
                            'localized_name'=>$json[$x]['localized_name']
                        );
                        $get_pick = $json[$x]['1_pick'];
                    } else if($key=='1_win'){
                        $final_1[$x]=array_merge($compare_1[$x],array('1win'=>$value));
                        $percentage=$this->compareRate($get_pick,$final_1[$x]['1win']);
                        $final_1[$x]=array_merge($final_1[$x],array(
                            '1pick'=>$get_pick,
                            'percentage'=>$percentage 
                        ));
                                        
                    } else if($key=='2_pick'){
                        $compare_2[$x]=array(
                            'index' =>$json[$x]['id'],
                            'localized_name'=>$json[$x]['localized_name']
                        );
                        $get_pick = $json[$x]['2_pick'];
                    } else if($key=='2_win'){
                        $final_2[$x]=array_merge($compare_2[$x],array('2win'=>$value));
                        $percentage=$this->compareRate($get_pick,$final_2[$x]['2win']);
                        $final_2[$x]=array_merge($final_2[$x],array(
                            '2pick'=>$get_pick,
                            'percentage'=>$percentage 
                        ));
                                        
                    } else if($key=='3_pick'){
                        $compare_3[$x]=array(
                            'index' =>$json[$x]['id'],
                            'localized_name'=>$json[$x]['localized_name']
                        );
                        $get_pick = $json[$x]['3_pick'];
                    } else if($key=='3_win'){
                        $final_3[$x]=array_merge($compare_3[$x],array('3win'=>$value));
                        $percentage=$this->compareRate($get_pick,$final_3[$x]['3win']);
                        $final_3[$x]=array_merge($final_3[$x],array(
                            '3pick'=>$get_pick,
                            'percentage'=>$percentage 
                        ));
                                        
                    } else if($key=='4_pick'){
                        $compare_4[$x]=array(
                            'index' =>$json[$x]['id'],
                            'localized_name'=>$json[$x]['localized_name']
                        );
                        $get_pick = $json[$x]['4_pick'];
                    } else if($key=='4_win'){
                        $final_4[$x]=array_merge($compare_4[$x],array('4win'=>$value));
                        $percentage=$this->compareRate($get_pick,$final_4[$x]['4win']);
                        $final_4[$x]=array_merge($final_4[$x],array(
                            '4pick'=>$get_pick,
                            'percentage'=>$percentage 
                        ));
                                        
                    } else if($key=='5_pick'){
                        $compare_5[$x]=array(
                            'index' =>$json[$x]['id'],
                            'localized_name'=>$json[$x]['localized_name']
                        );
                        $get_pick = $json[$x]['5_pick'];
                    } else if($key=='5_win'){
                        $final_5[$x]=array_merge($compare_5[$x],array('5win'=>$value));
                        $percentage=$this->compareRate($get_pick,$final_5[$x]['5win']);
                        $final_5[$x]=array_merge($final_5[$x],array(
                            '5pick'=>$get_pick,
                            'percentage'=>$percentage 
                        ));
                                        
                    } else if($key=='6_pick'){
                        $compare_6[$x]=array(
                            'index' =>$json[$x]['id'],
                            'localized_name'=>$json[$x]['localized_name']
                        );
                        $get_pick = $json[$x]['6_pick'];
                    } else if($key=='6_win'){
                        $final_6[$x]=array_merge($compare_6[$x],array('6win'=>$value));
                        $percentage=$this->compareRate($get_pick,$final_6[$x]['6win']);
                        $final_6[$x]=array_merge($final_6[$x],array(    
                            '6pick'=>$get_pick,
                            'percentage'=>$percentage 
                        ));
                                        
                    } else if($key=='7_pick'){
                        $compare_7[$x]=array(
                            'index' =>$json[$x]['id'],
                            'localized_name'=>$json[$x]['localized_name']
                        );
                        $get_pick = $json[$x]['1_pick'];
                    } else if($key=='7_win'){
                        $final_7[$x]=array_merge($compare_7[$x],array('7win'=>$value));
                        $percentage=$this->compareRate($get_pick,$final_7[$x]['7win']);
                        $final_7[$x]=array_merge($final_7[$x],array(
                            '7pick'=>$get_pick,
                            'percentage'=>$percentage 
                        ));
                                        
                    } else if($key=='8_pick'){
                        $compare_8[$x]=array(
                            'index' =>$json[$x]['id'],
                            'localized_name'=>$json[$x]['localized_name']
                        );
                        $get_pick = $json[$x]['8_pick'];
                    } else if($key=='8_win'){
                        $final_8[$x]=array_merge($compare_8[$x],array('8win'=>$value));
                        $percentage=$this->compareRate($get_pick,$final_8[$x]['8win']);
                        $final_8[$x]=array_merge($final_8[$x],array(
                            '8pick'=>$get_pick,
                            'percentage'=>$percentage 
                        ));
                                        
                    }                 
                    
                }
            
            }
            // echo print_r($final_1);
            $percentage = array_column($final_1, 'percentage');
            $percentage2 = array_column($final_2, 'percentage');
            $percentage3 = array_column($final_3, 'percentage');
            $percentage4 = array_column($final_4, 'percentage');
            $percentage5 = array_column($final_5, 'percentage');
            $percentage6 = array_column($final_6, 'percentage');
            $percentage7 = array_column($final_7, 'percentage');
            $percentage8 = array_column($final_8, 'percentage');
    
            array_multisort($this->sortRatePercentage($final_1), SORT_DESC, $final_1);
            array_multisort($this->sortRatePercentage($final_2), SORT_DESC, $final_2);
            array_multisort($this->sortRatePercentage($final_3), SORT_DESC, $final_3);
            array_multisort($this->sortRatePercentage($final_4), SORT_DESC, $final_4);
            array_multisort($this->sortRatePercentage($final_5), SORT_DESC, $final_5);
            array_multisort($this->sortRatePercentage($final_6), SORT_DESC, $final_6);
            array_multisort($this->sortRatePercentage($final_7), SORT_DESC, $final_7);
            array_multisort($this->sortRatePercentage($final_8), SORT_DESC, $final_8);
    

            if($tier==1){
                $data=$final_1;
            } else if($tier==2){
                $data=$final_2;
            } else if($tier==3){
                $data=$final_3;
            } else if($tier==4){
                $data=$final_4;
            } else if($tier==5){
                $data=$final_5;
            } else if($tier==6){
                $data=$final_6;
            } else if($tier==7){
                $data=$final_7;
            }else if($tier==8){
                $data=$final_8;
            }
            
    
            echo json_encode($data);
    }}

    public function meta2(){
        $json = json_decode(file_get_contents("https://api.opendota.com/api/herostats"), true);
        // format echo object[urutan data hero][jenis data]
  
        
        for ($x = 0; $x < count($json); $x++) {
            foreach($json[$x] as $key => $value) {
                if($key=='pro_win'){
                    $meta2[$x] = array (
                        'id'=>$json[$x]['id'],
                        'name'=>$json[$x]['name'],
                        'localized_name'=>$json[$x]['localized_name'],
                        'pro_win'=>$value
                    );
                } else if($key=='pro_pick'){
                    $meta2[$x] = array_merge($meta2[$x],array(
                        'pro_pick'=>$value
                    ));
                } else if($key=='pro_ban'){
                    $meta2[$x] = array_merge($meta2[$x],array(
                        'pro_ban'=>$value
                    ));
                }
        }
    }
    print_r($meta2[0]);
}






    
}
