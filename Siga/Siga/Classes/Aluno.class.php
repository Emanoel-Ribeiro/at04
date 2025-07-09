<?php
include_once "Usuario.class.php";

class Aluno extends Usuario {
    private $nome_aluno;

    public function __construct($id, $nome, $email, $senha, $matricula, $contato, $nome_aluno) {
        parent::__construct($id, $nome, $email, $senha, $matricula, $contato, 2); 
        $this->setNomeAluno($nome_aluno);
    }

    public function setNomeAluno($nome_aluno) {
        $this->nome_aluno = $nome_aluno;
    }

    public function getNomeAluno() {
        return $this->nome_aluno;
    }

    // sobrescrita de método
    public function inserir(): Bool {
        $sql = "INSERT INTO usuario 
                (nome, email, senha, matricula, contato, nome_aluno, tipo)
                VALUES(:nome, :email, :senha, :matricula, :contato, :nome_aluno, :tipo)";

        $parametros = array(
            ':nome'=> $this->getNome(),
            ':email'=> $this->getEmail(),
            ':senha'=> $this->getSenha(),
            ':matricula'=> $this->getMatricula(),
            ':contato'=> $this->getContato(),
            ':nome_aluno'=> $this->getNomeAluno(),
            ':tipo'=> $this->getTipo()
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
                       nome_aluno = :nome_aluno
                 WHERE id = :id";

        $parametros = array(
            ':id'=> $this->getId(),
            ':nome'=> $this->getNome(),
            ':email'=> $this->getEmail(),
            ':senha'=> $this->getSenha(),
            ':matricula'=> $this->getMatricula(),
            ':contato'=> $this->getContato(),
            ':nome_aluno'=> $this->getNomeAluno()
        );

        return Database::executar($sql, $parametros) == true;
    }
}
?>
