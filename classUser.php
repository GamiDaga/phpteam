<?php
// require_once("./consultsql.php");
// require_once('./sql/connect.php');

/**
 *
 */
class user {
    private $id;
    private $name;
    private $lastname;
    private $userName;
    private $email;
    private $admin;

    public function validate($userName,$password,$link) //valida y construye el obj user
    {
        // $link = mysqli_connect('localhost', 'root', 'root','phpteam') or die ("Error ".mysqli_error($mysqli));
        $query="SELECT *
        FROM usuarios
        WHERE nombreusuario = '$userName' AND password = '$password'";
        //echo "<pre>";var_dump($query);exit();
        // echo "<pre>";var_dump($link);exit();
        $result = mysqli_query($link,$query);
        //echo "<pre>";var_dump(mysqli_error($result));exit();
        //echo "<pre>";var_dump(mysqli_num_rows($result));exit();
        // echo "<pre>";var_dump($result);exit();

        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            // echo "<pre>";var_dump($row);exit();
            $this->id = $row['id'];
            $this->name = $row['nombre'];
            $this->lastname = $row['apellido'];
            $this->userName = $row['nombreusuario'];
            $this->email = $row['email'];
            if ($row['administrador']) {
                $this->admin = true;
            }else {
                $this->admin = false;
            }

        }else {
          throw new Exception("Error Log", 0);
        }
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function setName($value)
    {
        $this->name = $value;
    }

    public function setLastname($value)
    {
        $this->lastname = $value;
    }

    public function setUserName($value)
    {
        $this->userName = $value;
    }

    public function setEmail($value)
    {
        $this->email = $value;
    }

    public function setAdmin($value)
    {
        $this->admin = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getAdmin()
    {
        return $this->admin;
    }

}
 ?>
