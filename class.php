<?php

class UserInterface{
    private $host;
    private $user;
    private $pass;
    private $db;
    private $mysqli;

    public function __construct(){
        $this->host = 'localhost';
        $this->user = 'root';
        $this->pass = '';
        $this->db = 'accounts';
        $this->mysqli = new mysqly($this->host,$this->user,$this->pass,$this->db) or die($this->mysqli->error);
    }
    public function login(){
        $email= $this->mysqli->escape_string($_POST['email']);
        $result = $this->mysqli->query("SELECT * FROM users WHERE email='$email'");

        if($result->num_rows==0){
            $_SESSION['message']="User with that email doesn't exist";
            header("location: error.php");
        }
        else{
            $user = $result->fetch_assoc();

            if(password_verify($_POST['password'], $user['password'])){
                $_SESSION['email'] = $user['email'];
                $_SESSION['first_name']=$user['first_name'];
                $_SESSION['last-name']=$user['last_name'];
                $_SESSION['active']=$user['active'];

                $_SESSION['logged_in']=true;

                header("location: landing.php");
            }
            else{
                $_SESSION['message']="Pogresan password"
                header("location: error.php")
            }
        }
    }
    public function register(){
        $_SESSION['email']=$_POST['email'];
        $_SESSION['first_name']=$_POST['first_name'];
        $_SESSION['last_name']=$_POST['last_name'];

        $first_name= $this->mysqli->escape_string($_POST['firstname']);
        $last_name= $this->mysqli->escape_string($_POST['lastname']);
        $email= $this->mysqli->escape_string($_POST['email']);
        $password= $this->mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
        $hash= $this->mysqli->escape_string(md5(rand(0,1000)));

        $result=$this->mysqli->query("SELECT * FROM users WHERE email='$email'") or die($myslqi->error());

        if($result->num_rows>0){
            $_SESSION['message']='Korisnik vec postoji!';
            header("location: error.php");
        }
        else{
            $sql="INSERT INTO users (first_name, last_name, email, password, hash)"
                    . "VALUES ('$first_name', '$last_name', '$email', '$password', '$hash'";

            if($this->myslqi->query($sql)){
                $_SESSION['active']=1;
                $_SESSION['logged_in']=true;
                $_SESSION['message']="Uspesno ste se ulogovali";

                header("location: success.php");
            }
            else{
                $_SESSION['message']='Registracija neuspesna!';
                header("location: error.php");
            }

        }
    }

    public function subscribe(){
        $_SESSION['email']=$_POST['email'];
        $_SESSION['first_name']=$_POST['first_name'];
        $_SESSION['last_name']=$_POST['last_name'];

        $first_name= $this->mysqli->escape_string($_POST['firstname']);
        $last_name= $this->mysqli->escape_string($_POST['lastname']);
        $email= $this->mysqli->escape_string($_POST['email']);
        $password= $this->mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
        $hash= $this->mysqli->escape_string(md5(rand(0,1000)));

        $result=$this->mysqli->query("SELECT * FROM subscribers WHERE email='$email'") or die($myslqi->error());

        if($result->num_rows>0){
            $_SESSION['message']='Korisnik vec postoji!';
            header("location: error.php");
        }
        else{
            $sql="INSERT INTO subscribers (first_name, last_name, email, password, hash)"
                    . "VALUES ('$first_name', '$last_name', '$email', '$password', '$hash'";

            if($this->myslqi->query($sql)){
                $_SESSION['logged_in']=true;
                $_SESSION['message']="Uspesno ste se subscribovali";

                header("location: success.php");
            }
            else{
                $_SESSION['message']='Subskripcija neuspesna!';
                header("location: error.php");
            }

        }
    }

    public function unsubscribe(){
        $_SESSION['email']=$_POST['email'];
        $_SESSION['first_name']=$_POST['first_name'];
        $_SESSION['last_name']=$_POST['last_name'];

        $first_name= $this->mysqli->escape_string($_POST['firstname']);
        $last_name= $this->mysqli->escape_string($_POST['lastname']);
        $email= $this->mysqli->escape_string($_POST['email']);
        $password= $this->mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
        $hash= $this->mysqli->escape_string(md5(rand(0,1000)));

        $result=$this->mysqli->query("SELECT * FROM subscribers WHERE email='$email'") or die($myslqi->error());

        if($result->num_rows<=0){
            $_SESSION['message']='Niste se uspesno unsubscribovali';
            header("location: error.php");
        }
        else{
            $sql="DELETE FROM subscribers WHERE email='$email'";

            if($this->myslqi->query($sql)){
                
                $_SESSION['message']="Uspesno ste se unsubscribovali";

                header("location: success.php");
            }
            else{
                $_SESSION['message']='Unsubskripcija neuspesna!';
                header("location: error.php");
            }

        }
    }
}

?>