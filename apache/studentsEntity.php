<?php


class Students {
    private $mysqli;
    //$result = $mysqli->query("SELECT * FROM students");

    private $data;

    public function __construct($data) {
        $this->data = $data;
        $this->mysqli = new mysqli("db", "user", "password", "appDB");
    }

    

    public function createStudent(){

        if(isset($this->data))
        {
            $name = $this->data["name"];
            $averageMark = $this->data["averageMark"];
            $tutorId = $this->data["tutorId"];
            $result = $this->mysqli->query("INSERT INTO students (namee, averageMark, tutorId) VALUES ('$name', $averageMark, $tutorId)");
            if(isset($result) and $result != false){
            header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
            return json_encode(array(
            'name' => $name,
            'averageMark' => $averageMark,
            'tutorId' => $tutorId,
            'id' => $this->mysqli->insert_id));
            } else{
            header("{$_SERVER['SERVER_PROTOCOL']} 400 Bad Request");
            return json_encode(array(
            'error' => 'Bad Request',
            'description: ' => mysqli_error($this->mysqli)
            ));
            }

        }
        else{
        
            header("{$_SERVER['SERVER_PROTOCOL']} 400 Bad Request");
            return json_encode(array(
            'error' => 'Bad Request'
            ));
            
        }
        
    }

    public function getStudent(){
        
        if(isset($this->data)){
            $id = $this->data["id"];
            $result = $this->mysqli->query("SELECT * FROM students WHERE ID=$id");
        }
        else{
            $result = $this->mysqli->query("SELECT * FROM students");
        }
        
        if(isset($result) and $result != false){
            header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
            $res = array();
            while($row = $result->fetch_assoc())// получаем все строки в цикле по одной
            {
                $res[] = array(
                'name' => $row['namee'],
                'averageMark' => $row['averageMark'],
                'tutorId' => $row['tutorId'],
                'id' => $row['ID']);
            }
            return json_encode($res);
        
        } 
        else{
            header("{$_SERVER['SERVER_PROTOCOL']} 400 Bad Request");
            return json_encode(array(
            'error' => 'Bad Request',
            'description: ' => mysqli_error($this->mysqli)
            ));
        }
    }

    public function updateStudent(){
        
        if(isset($this->data))
        {
            if(array_key_exists("id", $this->data) and array_key_exists("name", $this->data) and array_key_exists("averageMark", $this->data) and array_key_exists("tutorId", $this->data)){

                $id = $this->data["id"];
                $name = $this->data["name"];
                $averageMark = $this->data["averageMark"];
                $tutorId = $this->data["tutorId"];
                $result = $this->mysqli->query("UPDATE students SET namee='$name', averageMark=$averageMark, tutorId=$tutorId WHERE ID=$id");

                if(isset($result) and $result != false){
                header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
                return json_encode(array(
                'name' => $name,
                'averageMark' => $averageMark,
                'tutorId' => $tutorId,
                'id' => $id));
                } 
                else{
                    header("{$_SERVER['SERVER_PROTOCOL']} 400 Bad Request");
                    return json_encode(array(
                    'error' => 'Bad Request',
                    'description: ' => mysqli_error($this->mysqli)
                    ));
                }
            }
            else{
                header("{$_SERVER['SERVER_PROTOCOL']} 400 Bad Request");
                return json_encode(array(
                'error' => 'Bad Request',
                'description: ' => 'Not enough arguments'
                ));
            }
            
        }
        else{
        
            header("{$_SERVER['SERVER_PROTOCOL']} 400 Bad Request");
            return json_encode(array(
            'error' => 'Bad Request'
            ));
            
        }
        
    }

    public function deleteStudent(){
        
        if(isset($this->data))
        {
            if(array_key_exists("id", $this->data)){
                $id = $this->data["id"];
                $result = $this->mysqli->query("DELETE FROM students WHERE ID=$id");
            }
            elseif(array_key_exists("averageMark", $this->data)){
                $averageMark = $this->data["averageMark"];
                $result = $this->mysqli->query("DELETE FROM students WHERE averageMark=$averageMark");
            }
            elseif (array_key_exists("name", $this->data)) {
                $name = $this->data["name"];
                $result = $this->mysqli->query("DELETE FROM students WHERE namee='$name'");
            }
            elseif (array_key_exists("tutorId", $this->data)) {
                $tutorId = $this->data["tutorId"];
                $result = $this->mysqli->query("DELETE FROM students WHERE tutorId=$tutorId");
            }
            
            if(isset($result)){
                header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
                
                return json_encode(array(
                'count' => $this->mysqli->affected_rows));
                
                
            } else{
            header("{$_SERVER['SERVER_PROTOCOL']} 400 Bad Request");
            return json_encode(array(
            'error' => 'Bad Request',
            'description: ' => mysqli_error($this->mysqli)
            ));
            }

        }
        else{
        
            header("{$_SERVER['SERVER_PROTOCOL']} 400 Bad Request");
            return json_encode(array(
            'error' => 'Bad Request'
            ));
            
        }
        
    }
}
