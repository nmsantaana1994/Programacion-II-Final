<?php
class Autenticacion 
{

    /**
     * Verifica las credenciales del usuario, y de ser correctas guarda los datos en la sesión
     * @param string $username El nombre de usuario provisto
     * @param string $username El password provisto
     * @return ?string Devuelve TRUE en caso que las credenciales sean correctas, FALSE en caso de que no lo sean
     */
    public function log_in(string $usuario, string $password) : ?string{

        $datosUsuario = (new Usuario())->usuario_x_username($usuario);

        if ($datosUsuario) {
            if (password_verify($password, $datosUsuario->getPassword())) {
                $datosLogin['username'] = $datosUsuario->getNombre_usuario();
                $datosLogin['id'] = $datosUsuario->getId();
                $datosLogin['roles'] = $datosUsuario->getRoles();
                $datosLogin["nombre"] =$datosUsuario->getNombre();
                $datosLogin["apellido"] =$datosUsuario->getApellido();
                $_SESSION['loggedIn'] = $datosLogin;
                return $datosLogin['roles'];
            } else {
                (new Alerta())->add_alerta('danger', "El password ingresado no es correcto.");
                return NULL;
            }
        } else {
            (new Alerta())->add_alerta('warning', "El usuario ingresado no se encontró en nuestra base de datos.");
            return NULL;
        }
    }

    public function log_out(){
        (new Alerta())->clear_alertas();
        
        if (isset($_SESSION['loggedIn'])) {
            unset($_SESSION['loggedIn']);
        };
    }

    public function verify(): bool {
        if (isset($_SESSION['loggedIn'])) {
            return TRUE;
        } else {
            header('location: index.php?sec=login');
        }
    }


}

?>