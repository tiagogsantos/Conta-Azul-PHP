<?php

class Companies extends controller {

    private $companyInfo;

    public function __construct($id)
    {
        parent::__construct();

        // Retornando as companias
        $sql = $this->db->prepare("SELECT * FROM companies WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $this->companyInfo = $sql->fetch();
        }
    }

    // retornando o nome da compania
    public function getName()
    {
        if (isset($this->companyInfo['name'])) {
            return $this->companyInfo['name'];
        } else {
            return '';
        }
    }

}