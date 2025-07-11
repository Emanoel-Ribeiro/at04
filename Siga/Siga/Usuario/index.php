<?php
session_start();

require_once("../autoload.php"); // ajuste o caminho se necessário

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = isset($_POST['id'])?$_POST['id']:0;
    $nome = isset($_POST['nome'])?$_POST['nome']:"";
    $email = isset($_POST['email'])?$_POST['email']:"";
    $senha = isset($_POST['senha'])?$_POST['senha']:"";
    $matricula = isset($_POST['matricula'])?$_POST['matricula']:"";
    $contato = isset($_POST['contato'])?$_POST['contato']:"";
    $tipo = isset($_POST['tipo'])?$_POST['tipo']:0;
    $acao = isset($_POST['acao'])?$_POST['acao']:"";

    if ($tipo == 1)
        $usuario = new Professor($id,$nome,$email,$senha, $matricula, $contato, $tipo);
    else
        $usuario = new Aluno($id,$nome,$email,$senha, $matricula, $contato, $tipo);
    if ($acao == 'salvar')
        if ($id > 0)
            $resultado = $usuario->alterar();
        else
            $resultado = $usuario->inserir();
    elseif ($acao == 'excluir')
        $resultado = $usuario->excluir();

    if ($resultado)
        header("Location: index.php");
    else
        echo "Erro ao salvar dados: ". $usuario;
}elseif ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $formulario = file_get_contents('form_cad_usuario.html');

    $id = isset($_GET['id'])?$_GET['id']:0;
    $resultado = Usuario::listar(1,$id);
    if ($resultado){
        $usuario = $resultado[0];
        $formulario = str_replace('{id}',$usuario->getId(),$formulario);
        $formulario = str_replace('{nome}',$usuario->getNome(),$formulario);
        $formulario = str_replace('{email}',$usuario->getEmail(),$formulario);
        $formulario = str_replace('{senha}',$usuario->getSenha(),$formulario);
        $formulario = str_replace('{matricula}',$usuario->getMatricula(),$formulario);
        $formulario = str_replace('{contato}',$usuario->getContato(),$formulario);
        $formulario = str_replace('{tipo}',$usuario->getTipo(),$formulario);
    }else{
        $formulario = str_replace('{id}',0,$formulario);
        $formulario = str_replace('{nome}','',$formulario);
        $formulario = str_replace('{email}','',$formulario);
        $formulario = str_replace('{senha}','',$formulario);
        $formulario = str_replace('{matricula}','',$formulario);
        $formulario = str_replace('{contato}','',$formulario);
        $formulario = str_replace('{tipo}','',$formulario);
    }
    print($formulario); 


}
?>