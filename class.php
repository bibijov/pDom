<?php

class UserInterface{
    private $host;
    private $user;
    private $pass;
    private $db;
    private $mysqli;

    public function __construct(){
        $this->host = '127.0.0.1:3307';
        $this->user = 'root';
        $this->pass = '';
        $this->db = 'pdom';
        $this->mysqli = new mysqli($this->host,$this->user,$this->pass,$this->db) or die($this->mysqli->error);
    }
    public function login(){
        $email= $this->mysqli->escape_string($_POST['email']);
        $result = $this->mysqli->query("SELECT * FROM korisnici WHERE email='$email'");

        if($result->num_rows==0){
            $_SESSION['message']="User with that email doesn't exist";
            header("location: error.php");
        }
        else{
            $user = $result->fetch_assoc();

            if(password_verify($_POST['password'], $user['password'])){
                $_SESSION['email'] = $user['email'];
                $_SESSION['ime']=$user['ime'];
                $_SESSION['prezime']=$user['prezime'];
                $_SESSION['active']=$user['active'];

                $_SESSION['logged_in']=true;

                header("location: landing.php");
            }
            else{
                $_SESSION['message']="Pogresan password";
                header("location: error.php");
            }
        }
    }
    public function register(){
        $_SESSION['email']=$_POST['email'];
        $_SESSION['ime']=$_POST['ime'];
        $_SESSION['prezime']=$_POST['prezime'];

        $ime= $this->mysqli->escape_string($_POST['ime']);
        $prezime= $this->mysqli->escape_string($_POST['prezime']);
        $email= $this->mysqli->escape_string($_POST['email']);
        $password= $this->mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
        $hash= $this->mysqli->escape_string(md5(rand(0,1000)));

        $result=$this->mysqli->query("SELECT * FROM korisnici WHERE email='$email'") or die($mysqli->error());

        if($result->num_rows>0){
            $_SESSION['message']='Korisnik vec postoji!';
            header("location: error.php");
        }
        else{
            $sql="INSERT INTO korisnici (ime, prezime, email, password, hash)"
                    . "VALUES ('$ime', '$prezime', '$email', '$password', '$hash')";

            if($this->mysqli->query($sql)){
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
      
        $email= $this->mysqli->escape_string($_POST['email']);

        $result=$this->mysqli->query("SELECT * FROM subscribers WHERE email='$email'") or die($mysqli->error());

        if($result->num_rows>0){
            $_SESSION['message']='Korisnik je vec subscribovan.';
            header("location: error.php");
        }
        else{
            $sql="INSERT INTO subscribers (email)"
                    . "VALUES ('$email')";

            if($this->mysqli->query($sql)){
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

        $email= $this->mysqli->escape_string($_POST['email']);

        $result=$this->mysqli->query("SELECT * FROM subscribers WHERE email='$email'") or die($mysqli->error());

        if($result->num_rows<=0){
            $_SESSION['message']='Niste se uspesno unsubscribovali';
            header("location: error.php");
        }
        else{
            $sql="DELETE FROM subscribers WHERE email='$email'";

            if($this->mysqli->query($sql)){
                
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