<?php
    class CrudApp{
        private $conn;

        public function __construct()
        {
            #database host, database user , database password , database name
            $dbhost='localhost';
            $dbuser='root';
            $dbpass='';
            $dbname='crudapp';

            // make connection with databse
            $this->conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

            if(!$this->conn){
                die("Database Connection Error !!");
            }
        }

        public function add_data($data)
        {
            $std_name=$data['std_name'];
            $std_roll=$data['std_roll'];
            $std_img=$_FILES['std_img']['name'];
            $tmp_name=$_FILES['std_img']['tmp_name'];

            
            // break string by '.' sign and return an array
            // generate randow number by time & concatenate image extension (end string of array)
            $temp = explode(".",$std_img);
            // $std_img =round(microtime(true)) . '.' . end($temp);
            $std_img=$std_roll.$std_name.".".end($temp);

            $query="INSERT INTO students(std_name,std_roll,std_img) VALUE('$std_name','$std_roll','$std_img')";

            if(mysqli_query($this->conn,$query)){
                // when data is stored in database move image in upload folder.
                move_uploaded_file($tmp_name,'upload/'.$std_img);

                return "Information Added Successfully.";
            }

        }

        public function display_data(){
            $query="SELECT * FROM students";
            if(mysqli_query($this->conn,$query)){
               $return_data= mysqli_query($this->conn,$query);
               return $return_data;
            }
        }

        public function display_data_by_id($id){
            $query="SELECT * FROM students where id=$id";
            if(mysqli_query($this->conn,$query)){
               $return_data= mysqli_query($this->conn,$query);
               $studentData=mysqli_fetch_assoc($return_data);
               return $studentData;
            }
        }
        public function update_data($data){
            $std_name=$data['std_name'];
            $std_roll=$data['std_roll'];
            $idno=$data['u_id'];
            $std_img=$_FILES['std_img']['name'];
            $tmp_name=$_FILES['std_img']['tmp_name'];

            $temp = explode(".",$std_img);
            // $std_img =round(microtime(true)) . '.' . end($temp);
            $std_img=$std_roll.$std_name.".".end($temp);

            $query="UPDATE students SET std_name='$std_name' ,std_roll=$std_roll, std_img='$std_img' WHERE id=$idno ";

            if(mysqli_query($this->conn,$query)){
                
                // delete previous image
                $previousImg=$data['previmg'];
                unlink('upload/'.$previousImg);
                //move or save new image
                move_uploaded_file($tmp_name,'upload/'.$std_img);

                return "Information Updated Successfully";
            }
        }

        public function delete_data_by_id($id){

            $catch_img="SELECT * FROM students WHERE id=$id";
            $delete_std_info=mysqli_query($this->conn,$catch_img);
            $std_infoDel = mysqli_fetch_assoc($delete_std_info);
            $deleteImg_data=$std_infoDel['std_img'];            

            $query="DELETE FROM students WHERE id=$id";
            if(mysqli_query($this->conn,$query)){
                unlink('upload/'.$deleteImg_data);
                // delete image
                return "Deleted Row Successfully";
            }
        }

    }

?>