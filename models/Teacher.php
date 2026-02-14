<?php
    class Teacher extends Connection {
        public function login() {
            $connect = parent::Connect();
            parent::set_names();

            if ($_POST['send']) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                if (empty($email) and empty($password)) {
                    header("Location: ".Connection::route()."index.php?m=2");
                    exit();
                } else {
                    $sql = "SELECT * FROM docente WHERE correo = ? AND contrasenia = ? AND estado = 1";
                    $statement = $connect->prepare($sql);
                    $statement->bindValue(1, $email);
                    $statement->bindValue(2, $password);
                    $statement->execute();
                    $result = $statement->fetch();

                    if (is_array($result) and count($result) > 0) {
                        $_SESSION['id_docente'] = $result['id_docente'];
                        $_SESSION['nombres'] = $result['nombres'];
                        $_SESSION['apellidos'] = $result['apellidos'];
                        $_SESSION['especialidad'] = $result['especialidad'];
                        $_SESSION['telefono'] = $result['telefono'];
                        $_SESSION['correo'] = $result['correo'];
                        $_SESSION['contrasenia'] = $result['contrasenia'];
                        header("Location: ".Connection::route()."view/TeacherHome/");
                    } else {
                        header("Location:".Connection::route()."index.php?m=1");
                        exit();
                    }
                }
            }
        }
    }
?>