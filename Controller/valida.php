<?php
session_start();
require_once ("../conexao.php");

if((isset($_POST['userCpf']))){
    $cpf = filter_input(INPUT_POST, 'userCpf', FILTER_SANITIZE_SPECIAL_CHARS);
    if (strlen($cpf) == 14) {
        $sql = "select cpf, cargo from medico where cpf = '$cpf'"; 
        $stm = mysqli_query($conn, $sql) or die(mysqli_errno($conn));
        $nrrows = mysqli_num_rows($stm);
        if ($nrrows > 0) {
            while ($row_query = mysqli_fetch_assoc($stm)) {
                $_SESSION['cpf'] = $row_query['cpf'];
                $cargo = $row_query['cargo'];
                $_SESSION['msg'] = "";
                header("Location: ../cadTutor.php"); exit();
            }
        }else{
            $_SESSION['loginErro'] = "<b>CPF Inválido!</b>";
            header("Location: ../index.php");
        }
    }else if($cpf == ""){
        $_SESSION['loginBranco'] = "<b>Impossível logar sem informar um CPF Válido!</b>";
        header("Location: ../index.php");
    }else{
        $_SESSION['loginErro'] = "<b>CPF Inválido!</b>";
        header("Location: ../index.php");
    }
}


