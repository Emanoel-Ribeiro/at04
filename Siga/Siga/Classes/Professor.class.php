<?php
include_once "Usuario.class.php";

class Professor extends Usuario {
    private $nome_prof;

    public function __construct($id, $nome, $email, $senha, $matricula, $contato, $nome_prof) {
        parent::__construct($id, $nome, $email, $senha, $matricula, $contato, 1); // tipo 1 = Professor
        $this->setNomeProf($nome_prof);
    }

    public function setNomeProf($nome_prof) {
        $this->nome_prof = $nome_prof;
    }

    public function getNomeProf() {
        return $this->nome_prof;
    }

    public function inserir(): Bool {
        $sql = "INSERT INTO usuario 
                (nome, email, senha, matricula, contato, nome_prof, tipo)
                VALUES(:nome, :email, :senha, :matricula, :contato, :nome_prof, :tipo)";

        $parametros = array(
            ':nome'      => $this->getNome(),
            ':email'     => $this->getEmail(),
            ':senha'     => $this->getSenha(),
            ':matricula' => $this->getMatricula(),
            ':contato'   => $this->getContato(),
            ':nome_prof' => $this->getNomeProf(),
            ':tipo'      => $this->getTipo()
        );

        return Database::executar($sql, $parametros) == true;
    }

    public function alterar(): Bool {
        $sql = "UPDATE usuario
                   SET nome = :nome,
                       email = :email,
                       senha = :senha,
                       matricula = :matricula,
                       contato = :contato,
                       nome_prof = :nome_prof
                 WHERE id = :id";

        $parametros = array(
            ':id'        => $this->getId(),
            ':nome'      => $this->getNome(),
            ':email'     => $this->getEmail(),
            ':senha'     => $this->getSenha(),
            ':matricula' => $this->getMatricula(),
            ':contato'   => $this->getContato(),
            ':nome_prof' => $this->getNomeProf()
        );

        return Database::executar($sql, $parametros) == true;
    }
}
?>
