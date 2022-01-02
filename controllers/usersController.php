<?php

class usersController extends controller
{
    public function __construct() {
        parent::__construct();

        $u = new Users();
        if($u->isLogged() == false) {
            header("Location: ".BASE_URL."/login");
            exit;
        }
    }

    /*
     * Retornando todos os usuários
     */
    public function index ()
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        $company = new Companies($u->getCompany());
        // Retornando o nome da compania
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        // Verificando se tenho permissão para entrar no view
        if ($u->hasPermissions('users_view')) {
            // Retornando a minha lista de usuários atrelado a minha companhia
            $data['users_list'] = $u->getList($u->getCompany());
            $this->loadTemplate('users', $data);
        } else {
            $data['$error_msg'] = "Bufou";
            $this->loadTemplate('no-permission', $data);
        }
    }

    /*
     * Metodo para cadastro de usuários
     */
    public function add ()
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        $company = new Companies($u->getCompany());
        // Retornando o nome da compania
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        // Verificando se tenho permissão para entrar no view
        if ($u->hasPermissions('users_view')) {
            // Retornando a minha lista de usuários atrelado a minha companhia
            $p = new Permissions();

            if (isset($_POST['email']) && !empty($_POST['email'])) {
                $email = addslashes($_POST['email']);
                $password = addslashes($_POST['password']);
                $group = addslashes($_POST['group']);

                $a = $u->add($email, $password, $group, $u->getCompany());

                if ($a == true) {
                    $data['success_msg'] = "Usuário adicionado com sucesso!";
                } else {
                    $data['error_msg'] = "Este e-mail já encontra-se cadastrado!";
                }
            }

            $data['group_list'] = $p->getGroupList($u->getCompany());

            $this->loadTemplate('users_add', $data);
        } else {
            header("Location: ".BASE_URL."home");
            // $data['error']  = 'Você não possui permissão para acessar está página, contate o administrador';
        }
    }

    /*
     * Metodo para a edição de usuários
     */
    public function edit ($id)
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        $company = new Companies($u->getCompany());
        // Retornando o nome da compania
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        // Verificando se tenho permissão para entrar no view
        if ($u->hasPermissions('users_view')) {
            // Retornando a minha lista de usuários atrelado a minha companhia
            $p = new Permissions();

            if (isset($_POST['group']) && !empty($_POST['group'])) {
                $password = addslashes($_POST['password']);
                $group = addslashes($_POST['group']);

                $a = $u->edit($password, $group, $id, $u->getCompany());

                if ($a == true) {
                    $data['success_msg'] = "Usuário editado com sucesso!";
                }
            }

            $data['user_info'] = $u->getInfo($id, $u->getCompany());
            $data['group_list'] = $p->getGroupList($u->getCompany());

            $this->loadTemplate('users_edit', $data);
        } else {
            header("Location: ".BASE_URL."home");
        }
    }

    /*
    * Metodo para a deletar usuários
    */
    public function delete ($id)
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        $company = new Companies($u->getCompany());
        // Retornando o nome da compania
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        // Verificando se tenho permissão para entrar no view
        if ($u->hasPermissions('users_view')) {
            // Retornando a minha lista de usuários atrelado a minha companhia
            $p = new Permissions();

           $result = $u->delete($id, $u->getCompany());

           if ($result == true) {
               header("Location: ".BASE_URL."/users");
               $data['success_msg'] = "Usuário deletado com sucesso!";
           } else {
               $data['error_msg'] = "Ooops, não foi possível deletar o usuário";
           }

        } else {
            header("Location: ".BASE_URL."home");
        }
    }

}