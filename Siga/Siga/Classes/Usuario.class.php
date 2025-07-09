<?php
require_once("../autoload.php"); // ajuste o caminho se necessário


abstract class Usuario{
    private $id;
    private $nome;
    private $email; // login
    private $senha;
    private $matricula;
    private $contato;
    private $login; // objeto login
    private $tipo;

    // construtor da classe
    public function __construct($id,$nome,$email,$senha, $matricula, $contato, $tipo){
        $this->setId($id);
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setSenha($senha);
        $this->setMatricula($matricula);
        $this->setContato($contato);
        $this->setTipo($tipo);
      //  $this->login->setIdSession(1);
    }

    public function setLogin(Login $login){
        $this->login = $login;
    }

    public function setId($id){
        if ($id < 0)
            throw new Exception('Erro. O ID deve ser maior ou igual a 0');
        else
            $this->id = $id;
    }

    public function setNome($nome){
        if ($nome == "")
            throw new Exception('Erro. Informe um nome.');
        else
            $this->nome = $nome;
    }

    public function setEmail($email){
        $padrao = "/^[_a-z0-9-+]+(\.[_a-z0-9-+]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
        if (($email == "") && !preg_match($padrao,strtolower($email)))
            throw new Exception('Erro. Informe um email.');
        else
            $this->email = $email;
    }


    public function setSenha($senha){
        if ($senha == "") // regras para senha
            throw new Exception('Erro. Informe uma senha válida.');
        else
            $this->senha = $senha;
    }

    public function setMatricula($matricula){
        if ($matricula == "") // regras para matricula
            throw new Exception('Erro. Informe uma matricula válida.');
        else
            $this->matricula = $matricula;
    }

    public function setContato($contato){
        if ($contato == "") // regras para contato
            throw new Exception('Erro. Informe um contato válida.');
        else
            $this->contato = $contato;
    }

    public function setTipo($tipo){
        if ($tipo == "")
            $tipo = 1;
        else
            $this->tipo = $tipo;
    }

    public function getId(){return $this->id;}
    public function getNome(){return $this->nome;}
    public function getEmail(){return $this->email;}
    public function getSenha(){return $this->senha;}
    public function getMatricula(){return $this->matricula;}
    public function getContato(){return $this->contato;}
    public function getTipo(){return $this->tipo;}

    // método mágico para imprimir uma atividade
    public function __toString():String{  
        $str = "Usuario: $this->getId() - $this->getNome() - $this->getEmail() - $this->getSenha() - $this->getMatricula() - $this->getContato() - $this->getTipo()";        
        return $str;
    }

    // insere uma atividade no banco 
    abstract public function inserir():Bool;
    

    public static function listar($tipo=0, $info=''):Array{
        $sql = "SELECT * FROM usuario";
        switch ($tipo){
            case 0: break;
            case 1: $sql .= " WHERE id = :info ORDER BY id"; break; // filtro por ID
            case 2: $sql .= " WHERE nome like :info ORDER BY nome"; $info = '%'.$info.'%'; break; // filtro por descrição
            case 3: $sql .= " WHERE matricula = :info ORDER BY matricula"; break; // filtro por matricula
        }
        $parametros = array();
        if ($tipo > 0)
            $parametros = [':info'=>$info];

        $comando = Database::executar($sql, $parametros);
        $usuarios = [];
        while ($registro = $comando->fetch()){
            if ($registro['tipo'] == 1) {
                $usuario = new Professor(
                    $registro['id'],
                    $registro['nome'],
                    $registro['email'],
                    $registro['senha'],
                    $registro['matricula'],  
                    $registro['contato'],
                    $registro['nome_prof']
                );
            } else {
                $usuario = new Aluno(
                    $registro['id'],
                    $registro['nome'],
                    $registro['email'],
                    $registro['senha'],
                    $registro['matricula'], 
                    $registro['contato'],
                    $registro['nome_aluno']
                );
            }
            array_push($usuarios,$usuario);
        }
        return $usuarios;
    }

    abstract public function alterar():Bool;

    public function excluir():Bool{
        $sql = "DELETE FROM usuario
                      WHERE id = :id";
        $parametros = array(':id'=>$this->getid());
        return Database::executar($sql, $parametros) == true;
     }
}


?>