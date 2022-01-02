<?php

class LoginController extends controller {

    // Retornando minha index
    public function index ()
    {
        $data = array();

        // Verificando se o email existe e se o mesmo nao esta vazio
        if(isset($_POST['email']) && !empty($_POST['email'])) {
            $email = addslashes($_POST['email']);
            $pass  = addslashes($_POST['password']);

            $u = new Users();
            // Se o Login estiver correto o mesmo ira ser direcionado ao meu home
            if($u->doLogin($email, $pass)) {
                header("Location: ".BASE_URL."/home");
                exit;
            } else {
                $data['error'] = 'E-mail e/ou senha errados.';
            }
        }

        // Retornando a view de login
        $this->loadView('login', $data);
    }

    // Metodo de Logout
    public function logout()
    {
        $u = new Users();
        $u->setLoggedUser();
        $u->logout();
        header("Location: ".BASE_URL);
    }
}