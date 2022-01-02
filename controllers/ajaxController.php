<?php

class ajaxController extends controller
{
    public function __construct()
    {
        parent::__construct();

        $u = new Users();
        if ($u->isLogged() == false) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
    }

    public function index ()
    {
    }

    public function searchClientes()
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $c = new Clients();

        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $q = addslashes($_GET['q']);

            $data = $c->searchClienteByName($q, $u->getCompany());
        }

        echo json_encode($data);
    }



}