<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['username']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: index.php');
        exit();
    }
}

function login($username, $password) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        return true;
    }
    
    return false;
}

function logout() {
    session_destroy();
    header('Location: index.php');
    exit();
}
function requireAdmin() {
    requireLogin(); // Primeiro verifica se está logado
    
    // Lista de IDs de usuários administradores (substitua pelos seus IDs reais)
    $adminUsers = [1]; // Exemplo: usuário com ID 1 é admin
    
    if (!in_array($_SESSION['user_id'], $adminUsers)) {
        header('Location: dashboard.php');
        exit();
    }
}
?>
