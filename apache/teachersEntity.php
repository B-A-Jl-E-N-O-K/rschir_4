<?php
class Teachers {
    private $mysqli;
    //$result = $mysqli->query("SELECT * FROM students");

    private $data;

    public function __construct($data) {
        $this->data = $data;
        $this->mysqli = new mysqli("db", "user", "password", "appDB");
    }


    public function createTeacher(){

        if(isset($this->data))
        {
            $name = $this->data["name"];
            $experience = $this->data["experience"];
            $result = $this->mysqli->query("INSERT INTO teachers (namee, experience) VALUES ('$name', $experience)");
            if(isset($result) and $result != false){
            header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
            echo json_encode(array(
            'name' => $name,
            'experience' => $experience,
            'id' => $this->mysqli->insert_id));
            } else{
            header("{$_SERVER['SERVER_PROTOCOL']} 400 Bad Request");
            echo json_encode(array(
                'error' => 'Bad Request',
                'description: ' => mysqli_error($this->mysqli)
            ));
            }

        }
        else{
        
            header("{$_SERVER['SERVER_PROTOCOL']} 400 Bad Request");
            echo json_encode(array(
            'error' => 'Bad Request'
            ));
            
        }
        
    }

    public function getTeacher(){
        
        if(isset($this->data)){
            $id = $this->data["id"];
            $result = $this->mysqli->query("SELECT * FROM teachers WHERE id=$id");
        }
        else{
            $result = $this->mysqli->query("SELECT * FROM teachers");
        }
        
        if(isset($result) and $result != false){
            header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
            $res = array();
            while($row = $result->fetch_assoc())// получаем все строки в цикле по одной
            {
                $res[] = array(
                'name' => $row['namee'],
                'experience' => $row['experience'],
                'id' => $row['ID']);
            }
            echo json_encode($res);
        
        } 
        else{
            header("{$_SERVER['SERVER_PROTOCOL']} 400 Bad Request");
            echo json_encode(array(
                'error' => 'Bad Request',
                'description: ' => mysqli_error($this->mysqli)
            ));
        }
    }

    public function updateTeacher(){
        
        if(isset($this->data))
        {
            if(array_key_exists("id", $this->data) and array_key_exists("name", $this->data) and array_key_exists("experience", $this->data)){

                $id = $this->data["id"];
                $name = $this->data["name"];
                $experience = $this->data["experience"];
                $result = $this->mysqli->query("UPDATE teachers SET namee='$name', experience=$experience WHERE id=$id");

                if(isset($result) and $result != false){
                header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
                echo json_encode(array(
                'name' => $name,
                'experience' => $experience,
                'id' => $id));
                } 
                else{
                    header("{$_SERVER['SERVER_PROTOCOL']} 400 Bad Request");
                    echo json_encode(array(
                        'error' => 'Bad Request',
                        'description: ' => mysqli_error($this->mysqli)
                    ));
                }
            }
            else{
                header("{$_SERVER['SERVER_PROTOCOL']} 400 Bad Request");
                echo json_encode(array(
                'error' => 'Bad Request',
                'description: ' => 'Not enough arguments'
                ));
            }
            
        }
        else{
        
            header("{$_SERVER['SERVER_PROTOCOL']} 400 Bad Request");
            echo json_encode(array(
            'error' => 'Bad Request'
            ));
            
        }
        
    }

    public function deleteTeacher(){
        
        if(isset($this->data))
        {
            if(array_key_exists("id", $this->data)){
                $id = $this->data["id"];
                $result = $this->mysqli->query("DELETE FROM teachers WHERE id=$id");
            }
            elseif(array_key_exists("experience", $this->data)){
                $experience = $this->data["experience"];
                $result = $this->mysqli->query("DELETE FROM teachers WHERE experience=$experience");
            }
            elseif (array_key_exists("name", $this->data)) {
                $name = $this->data["name"];
                $result = $this->mysqli->query("DELETE FROM teachers WHERE namee='$name'");
            }
            
            if(isset($result) and $result != false){
                header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
                
                echo json_encode(array(
                'count' => $this->mysqli->affected_rows));
                
                
            } else{
            header("{$_SERVER['SERVER_PROTOCOL']} 400 Bad Request");
            echo json_encode(array(
                'error' => 'Bad Request',
                'description: ' => mysqli_error($this->mysqli)
            ));
            }

        }
        else{
        
            header("{$_SERVER['SERVER_PROTOCOL']} 400 Bad Request");
            echo json_encode(array(
            'error' => 'Bad Request'
            ));
            
        }
        
    }

        
}