<?php
    
    include_once 'db-connect.php';
    
    class User{
        
        private $db;
        
        private $db_table = "program";   //change here table name
        
        public function __construct(){
            $this->db = new DbConnect();
            
          //  $this->getPrograms();
        }
        
      //create Commands
      
      public function createInterview($interview_type,$interview_question,$interview_answer){
        $query="insert into interview (interview_type,interview_question,interview_answer) values ($interview_type,'$interview_question','$interview_answer');";

        if (mysqli_query($this->db->getDb(), $query)) {
             return json_encode(['interview' => [
                 'status'=>'Data Inserted Successfully'
             ]]);
        } else {
            return json_encode(['interview' => [
             //   'dbCon'=>$this->db->getDb(),
              //  'query'=>$query,
                'status'=>'Error occured'
        ]]);}
    }

        public function createProgram($program_statement,$program_code,$program_output){
            $query="insert into program (program_statement,program_code,program_output) values ('$program_statement','$program_code','$program_output');";
            if (mysqli_query($this->db->getDb(), $query)) {
                return json_encode(['program' => [
                    'status'=>'Data Inserted Successfully'
                ]]);
           } else {
               return json_encode(['program' => [
                   'query'=>$query,
                   'status'=>'Error occured'
           ]]);}

        }

        public function createSection($section_title){
            $query="insert into section (section_title) values ('$section_title');";
            if (mysqli_query($this->db->getDb(), $query)) {
                return json_encode(['Section' => [
                    'status'=>'Data Inserted Successfully'
                ]]);
           } else {
               return json_encode(['Section' => [
                   'query'=>$query,
                   'status'=>'Error occured'
           ]]);}

        }

        public function createSubsection($section_id,$subsection_id,$subsection_title,$subsection_detail){
            $query="insert into subsection values ($section_id,$subsection_id,'$subsection_title','$subsection_detail');";
            if (mysqli_query($this->db->getDb(), $query)) {
                return json_encode(['Sub_Section' => [
                    'status'=>'Data Inserted Successfully'
                ]]);
           } else {
               return json_encode(['Sub_Section' => [
                   'query'=>$query,
                   'status'=>'Error occured'
           ]]);} 
        }

    //update
    public function updateInterview($id,$interview_type,$interview_question,$interview_answer){
        
        $query="update interview set interview_type=$interview_type,interview_question='$interview_question',interview_answer='$interview_answer' where interview_id = $id ;";
        if (mysqli_query($this->db->getDb(), $query)) {
            return json_encode(['Interview' => [
                'status'=>'Data Updated Successfully'
            ]]);
       } else {
           return json_encode(['Interview' => [
               'query'=>$query,
               'status'=>'Error occured'
       ]]);} 
          
    }
    

    public function updateProgram($id,$program_statement,$program_code,$program_output){
        $query="update program set program_statement='$program_statement',program_code='$program_code',program_output='$program_output' where program_id = $id ;";
        if (mysqli_query($this->db->getDb(), $query)) {
            return json_encode(['Program' => [
                'status'=>'Data Updated Successfully'
            ]]);
       } else {
           return json_encode(['Program' => [
               'query'=>$query,
               'status'=>'Error occured'
       ]]);} 
    }


    public function updateSection($id,$section_title){
        $query="update program set section_title='$section_title' where section_id = $id ;";
        if (mysqli_query($this->db->getDb(), $query)) {
            return json_encode(['Section' => [
                'status'=>'Data Updated Successfully'
            ]]);
       } else {
           return json_encode(['Section' => [
               'query'=>$query,
               'status'=>'Error occured'
       ]]);} 
    }


    public function updateSubsection($id,$subsection_title,$subsection_detail){
        $query="update subsection set subsection_title='$subsection_title',subsection_detail='$subsection_detail' where subsection_id = $id ;";
        if (mysqli_query($this->db->getDb(), $query)) {
            return json_encode(['Section' => [
                'status'=>'Data Updated Successfully'
            ]]);
       } else {
           return json_encode(['Section' => [
               'query'=>$query,
               'status'=>'Error occured'
       ]]);} 
    }
    //Delete 
    public function deleteInterview($id){
        
        $query="delete from interview where interview_id = $id ;";
        if (mysqli_query($this->db->getDb(), $query)) {
            return json_encode(['Interview' => [
                'status'=>'Data Deleted Successfully'
            ]]);
       } else {
           return json_encode(['Interview' => [
               'query'=>$query,
               'status'=>'Error occured'
       ]]);} 
          
    }

    public function deleteSection($id){
        
        $query="delete from section where section_id = $id ;";
        if (mysqli_query($this->db->getDb(), $query)) {
            return json_encode(['Section' => [
                'status'=>'Data Deleted Successfully'
            ]]);
       } else {
           return json_encode(['Section' => [
               'query'=>$query,
               'status'=>'Error occured'
       ]]);} 
          
    }

    public function deleteAllSubsection($id){
  
        $query="delete from subsection where section_id = $id ;";
        if (mysqli_query($this->db->getDb(), $query)) {
            return json_encode(['SubSection' => [
                'status'=>'Data Deleted Successfully'
            ]]);
       } else {
           return json_encode(['SubSection' => [
               'query'=>$query,
               'status'=>'Error occured'
       ]]);} 
          
    }

    public function deleteSubsection($id){

        $query="delete from subsection where subsection_id = $id ;";
        if (mysqli_query($this->db->getDb(), $query)) {
            return json_encode(['SubSection' => [
                'status'=>'Data Deleted Successfully'
            ]]);
       } else {
           return json_encode(['SubSection' => [
               'query'=>$query,
               'status'=>'Error occured'
       ]]);} 
          
    }

    public function deleteProgram($id){

        $query="delete from program where program_id = $id ;";
        if (mysqli_query($this->db->getDb(), $query)) {
            return json_encode(['SubSection' => [
                'status'=>'Data Deleted Successfully'
            ]]);
       } else {
           return json_encode(['SubSection' => [
               'query'=>$query,
               'status'=>'Error occured'
       ]]);} 
          
    }
      //Read Commands
        
        public function getPrograms(){
            
            $query = "select * from program";
            $send=array();
           if( $result = mysqli_query($this->db->getDb(), $query)){
               while($row=mysqli_fetch_assoc($result)){
                $send[]=$row;
            }
           }
           return $send;
        }
        public function getTheory(){
        
          $query="select * from section;";
          $json_response=array();
          $row_array=array();
          $subsection_array=array();

           if( $result = mysqli_query($this->db->getDb(), $query)){
               while($row=mysqli_fetch_assoc($result)){
                
                $row_array['section_id']=$row['section_id'];
                $row_array['section_title']=$row['section_title'];
                $row_array['subsections']=array();
                $id=$row['section_id'];
                $subsection_query="select * from subsection where section_id=$id";
                $subsection_result=mysqli_query($this->db->getDb(), $subsection_query);
                while($subsection_row=mysqli_fetch_assoc($subsection_result))
                {
                    $subsection_array['title']=$subsection_row['subsection_title']; 
                    $subsection_array['id']=$subsection_row['subsection_id']; 
                    $subsection_array['detail']=$subsection_row['subsection_detail'];
                    array_push($row_array['subsections'],$subsection_array); 

                }
                array_push($json_response,$row_array);
           }
           //$jsonData=json_encode($json_response,JSON_PRETTY_PRINT);
           return $json_response;
        }

       
    }
    public function getInterview(){
     
        $query = "select * from interview ";
        $send=array();
       if( $result = mysqli_query($this->db->getDb(), $query)){
           while($row=mysqli_fetch_assoc($result)){
            $send[]=$row;
        }
       }
       return $send;
    }

}
    ?>