<?php

class Users extends model {

    private $userInfo;
    private $permissions;


    // Verificando se possuo um usuário logado
    public function isLogged()
    {
        /*
         * Verificando a sessão e comparando se a mesma não está vazia
         */
        if(isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
            return true;
        } else {
            return false;
        }

    }

    /*
     * Verificando se existe um usuário logado
     */
    public function doLogin($email, $password)
    {
        /*
         * Retornando meu usuario através do e-mail e senha
         */
        $sql = $this->db->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', md5($password));
        $sql->execute();

        /*
         * Se minha contagem for maior que 0, quer dizer que obtenho um usuário
         */
        if($sql->rowCount() > 0) {
            $row = $sql->fetch();
            $_SESSION['ccUser'] = $row['id'];

            return true;
        } else {
            return false;
        }
    }

    /*
     * Retornando o usuário logado
     */
    public function setLoggedUser ()
    {
        // Verificando se existe e se não está vazio
        if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
            // retornando o id do usuário logado
            $id = $_SESSION['ccUser'];

            $sql = $this->db->prepare("SELECT * FROM users WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $this->userInfo = $sql->fetch();
                $this->permissions = new Permissions();
                $this->permissions->setGroup($this->userInfo['id_group'], $this->userInfo['id_company']);
            }
        }
    }

    /*
     * Retornando o user logado para realizar o logout
     */
    public function logout ()
    {
        unset($_SESSION['ccUser']);
    }

    /*
     * Retornando o nome da permissão.
     */
    public function hasPermissions($name)
    {
        return $this->permissions->hasPermissions($name);
    }

    /*
     * Retornando as informações da minha compania
     */
    public function getCompany ()
    {
        if (isset($this->userInfo['id_company'])) {
            // Retornando o id_company do meu usuário logado
            return $this->userInfo['id_company'];
        } else {
            return 0;
        }
    }

    /*
     * Retornando as informações do e-mail
     */
    public function getEmail()
    {
        if (isset($this->userInfo['email'])) {
            return $this->userInfo['email'];
        } else {
            return '';
        }
    }

    /*
     * Pegando as informações do meu usuário atrelado ao id_company
     */
    public function getInfo($id, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM users WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue("id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    /*
     * Pegando o grupo na qual meu usuário pertence
     */
    public function findUsersInGroup ($id)
    {
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM users WHERE id_group = :group");
        $sql->bindValue(":group", $id);
        $sql->execute();
        $row = $sql->fetch();
        if ($row['c'] == 0) {
            return false;
        } else {
            return true;
        }
    }

    /*
     * retornando minha lista de usuários e de grupos atrelado
     */
    public function getList($id_company)
    {
        $array = array();

            $sql = $this->db->prepare("SELECT 
                    u.id, u.email, pg.name
                FROM
                    users u
                        LEFT JOIN
                    permission_groups pg ON pg.id = u.id_group
                WHERE
                    u.id_company = pg.id_company");
            $sql->bindValue(":id_company", $id_company);
            $sql->execute();

            if ($sql->rowCount() > 0) {
               $array = $sql->fetchAll();
            }

        return $array;
    }

    /*
     * Retornando cadastro de usuários
     */
    public function add($email, $password, $group, $id_company)
    {
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM users WHERE email = :email");
        $sql->bindValue("email", $email );
        $sql->execute();
        $row = $sql->fetch();

        if ($row['c'] == 0){
            $sql = $this->db->prepare("INSERT INTO users SET email = :email, password = :password, 
                                            id_group = :id_group, id_company = :id_company");
            $sql->bindValue(":email", $email);
            $sql->bindValue(":password", md5($password));
            $sql->bindValue(":id_group", $group);
            $sql->bindValue(":id_company", $id_company);
            $sql->execute();

            return true;
        } else {
            return false;
        }
    }

    /*
    Edição de usuários
    */
    public function edit($password, $group, $id, $id_company)
    {

        $sql = $this->db->prepare("UPDATE users SET id_group = :id_group WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id_group", $group);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if(!empty($password)) {
            $sql = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id AND id_company = :id_company");
            $sql->bindValue(":password", md5($password));
            $sql->bindValue(":id", $id);
            $sql->bindValue(":id_company", $id_company);
            $sql->execute();
        }

        return true;
    }

    // Metodo para deletar um usuário
    public function delete($id, $id_company)
    {
        if (!empty($id)) {
            $sql = $this->db->prepare("DELETE FROM users WHERE id = :id AND id_company = :id_company");
            $sql->bindValue(":id", $id);
            $sql->bindValue(":id_company", $id_company);
            $sql->execute();
            return true;
        }
         else {
            return false;
        }
    }
}