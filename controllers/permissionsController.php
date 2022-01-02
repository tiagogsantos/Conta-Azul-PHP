<?php

class permissionsController extends controller {

    // Preciso do construdor devido meu sistema ser acessivel apenas para usuários logados.
    public function __construct() {
        parent::__construct();

        $u = new Users();
        if($u->isLogged() == false) {
            header("Location: ".BASE_URL."/login");
            exit;
        }
    }

    // Pegando os dados de company e usuário
    public function index ()
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        $company = new Companies($u->getCompany());
        // Retornando o nome da compania
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermissions('permissions_view')) {
            $permissions = new Permissions();
            // Retornando minha lista de permissão
            $data['permissions_list'] = $permissions->getList($u->getCompany());
            // Retornando minha lista de permissão por grupos
            $data['permissions_groups_list'] = $permissions->getGroupList($u->getCompany());
            // Fazendo a leitura do meu view
            $this->loadTemplate('permissions', $data);
        } else {
            header("Location: ".BASE_URL."home");
           // $data['$error_msg']  = 'Você não possui permissão para acessar está página, contate o administrador';
        }
    }

    /*
     * Metodo para adicionar permissões ao usuário
     */
    public function add()
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermissions('permissions_view')) {
            $permissions = new Permissions();

            // Criando as permissões por nome
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $pname = addslashes($_POST['name']);
                $permissions->add($pname, $u->getCompany());
                header("Location: ".BASE_URL."/permissions");
               // $data = "Permissão adicionada com sucesso";
            }
            $this->loadTemplate('permissions_add', $data);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function addGroup()
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermissions('permissions_view')) {
            $permissions = new Permissions();

            // Criando as permissões por nome e Grupo
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $pname = addslashes($_POST['name']);
                $plist = $_POST['permissions'];

                // Adicionando novo grupo
                $permissions->addGroup($pname, $plist, $u->getCompany());
                header("Location: ".BASE_URL."/permissions");
                // $data = "Permissão adicionada com sucesso";
            }

            // Retornando minha lista de permissões
            $data['permissions_list'] = $permissions->getList($u->getCompany());

            $this->loadTemplate('permissions_addgroup', $data);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    /*
     * Medoto para a edição dos grupos
     */
    public function edit_group($id) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if($u->hasPermissions('permissions_view')) {
            $permissions = new Permissions();

            if(isset($_POST['name']) && !empty($_POST['name'])) {
                $pname = addslashes($_POST['name']);
                $plist = $_POST['permissions'];

                $permissions->editGroup($pname, $plist, $id, $u->getCompany());
                header("Location: ".BASE_URL."/permissions");
            }

            $data['permissions_list'] = $permissions->getList($u->getCompany());
            $data['group_info'] = $permissions->getGroup($id, $u->getCompany());

            $this->loadTemplate('permissions_edit_group', $data);
        } else {
            header("Location: ".BASE_URL);
        }
    }


    // Metodo para deletar as permissões
    public function delete($id)
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermissions('permissions_view')) {
            $permissions = new Permissions();
            // Deletando uma permissão
           $permissions->delete($id);
            header("Location: ".BASE_URL."/permissions");
        } else {
            header("Location: ".BASE_URL);
        }
    }

    // Deletando um de permissão
    public function delete_group ($id)
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermissions('permissions_view')) {
            $permissions = new Permissions();
            // Deletando uma permissão
            $permissions->deleteGroup($id);
            header("Location: ".BASE_URL."/permissions");
        } else {
            header("Location: ".BASE_URL);
        }
    }

}