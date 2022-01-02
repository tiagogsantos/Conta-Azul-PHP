<?php

class Permissions extends model
{

    private $group;
    private $permissions;

    public function setGroup($id, $id_company)
    {
        // o id do meu grupo
        $this->group = $id;

        $this->permissions = array();

        // Selecionando os meus parametros (nome) pelo os id da minha compania
        $sql = $this->db->prepare("SELECT params FROM permission_groups WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue("id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();

            if (empty($row['params'])) {
                $row['params'] = '0';
            }

            $params = $row['params'];

            // pegando as permissões dos meus grupos separados por virgula
            $sql = $this->db->prepare("SELECT name FROM permission_params 
            WHERE id IN($params) AND id_company = :id_company");
            $sql->bindValue(":id_company", $id_company);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                foreach ($sql->fetchAll() as $item) {
                    // Adicionando os nomes das minhas permissões
                    $this->permissions[] = $item['name'];
                }
            }
        }
    }

    /*
     * Retornando o nome da permissão
     */
    public function hasPermissions($name)
    {
        if (in_array($name, $this->permissions)) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Retornando minha lista de permissão
     */
    public function getList($id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM permission_params WHERE id_company = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if($sql->rowCount()) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    /*
     * Retornado o grupo de permissões
     */
    public function getGroupList ($id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM permission_groups WHERE id_company = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount()) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    // Retornando o grupo de permissões
    public function getGroup ($id, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM permission_groups WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount()) {
            $array = $sql->fetch();
            $array['params'] = explode(',', $array['params']);
        }

        return $array;
    }

    /*
     * Adicionando uma permissão
     */
    public function add ($name, $id_company)
    {
        $sql = $this->db->prepare("INSERT INTO permission_params SET name = :name, id_company = :id_company");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
    }

    /*
     * Adicionando um grupo
     */
    public function addGroup ($name, $plist, $id_company)
    {
        // retornando meu array do checkbox
        $params = implode(',', $plist);

        $sql = $this->db->prepare("INSERT INTO permission_groups SET name = :name, id_company = :id_company, params = :params");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":params", $params);
        $sql->execute();
    }

    /*
     * Metodo para edição de grupo
     */

    public function editGroup ($name, $plist, $id, $id_company)
    {
        $params = implode(',', $plist);

        $sql = $this->db->prepare("UPDATE permission_groups SET name = :name, id_company = :id_company, params = :params WHERE id = :id");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":params", $params);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }


    /*
     * Deletando uma permissão
     */
    public function delete($id)
    {
        $sql = $this->db->prepare("DELETE FROM permission_params WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    /*
     * Deletando um grupo
     */
    public function deleteGroup ($id)
    {
        $u = new Users();

        if($u->findUsersInGroup($id) == false) {
            $sql = $this->db->prepare("DELETE FROM permission_groups WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
        }
    }
}