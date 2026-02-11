<?php
    class Student extends Connection {
        public function login() {
            $connect = parent::Connect();
            parent::set_names();

            if ($_POST['send']) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                if (empty($email) and empty($password)) {
                    header("Location:".Connection::route()."index.php?m=2");
                    exit();
                } else {
                    $sql = "SELECT * FROM estudiante WHERE correo = ? AND contrasenia = ? AND estado = 1";
                    $statement = $connect->prepare($sql);
                    $statement->bindValue(1, $email);
                    $statement->bindValue(2, $password);
                    $statement->execute();
                    $result = $statement->fetch();

                    if (is_array($result) and count($result) > 0) {
                        $_SESSION['id_estudiante'] = $result['id_estudiante'];
                        $_SESSION['nombres'] = $result['nombres'];
                        $_SESSION['apellidos'] = $result['apellidos'];
                        $_SESSION['fecha_nacimiento'] = $result['fecha_nacimiento'];
                        $_SESSION['direccion'] = $result['direccion'];
                        $_SESSION['telefono'] = $result['telefono'];
                        $_SESSION['correo'] = $result['correo'];
                        $_SESSION['contrasenia'] = $result['contrasenia'];
                        $_SESSION['estado'] = $result['estado'];
                        header("Location: ".Connection::route()."view/StudentHome/");
                        exit();
                    } else {
                        header("Location:".Connection::route()."index.php?m=1");
                        exit();
                    }
                }
            }
        }
    }
?>