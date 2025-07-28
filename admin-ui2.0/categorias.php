<?php
require_once 'config/database.php';
require_once 'config/auth.php';
requireLogin();

// Buscar categorias com contagem de produtos
$stmt = $pdo->query("
    SELECT c.*, COUNT(p.id) as product_count 
    FROM categories c 
    LEFT JOIN products p ON c.id = p.category_id 
    GROUP BY c.id 
    ORDER BY c.created_at DESC
");
$categories = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - Sistema Administrativo</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>
    
    <div class="main-content">
        <div class="header">
            <h1>Gerenciar Categorias</h1>
            <button class="btn btn-primary" onclick="openCategoryModal()">
                <i class="fas fa-plus"></i>
                Adicionar Categoria
            </button>
        </div>
        
        <div class="card">
            <div class="card-content">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Produtos</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $category): ?>
                                <tr>
                                    <td><?php echo $category['id']; ?></td>
                                    <td><?php echo htmlspecialchars($category['name']); ?></td>
                                    <td><?php echo htmlspecialchars($category['description'] ?? '-'); ?></td>
                                    <td>
                                        <span class="product-count">
                                            <i class="fas fa-box"></i>
                                            <?php echo $category['product_count']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn-icon" onclick="editCategory(<?php echo htmlspecialchars(json_encode($category)); ?>)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-icon btn-danger" onclick="deleteCategory(<?php echo $category['id']; ?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal para adicionar/editar categoria -->
    <div id="categoryModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Adicionar Categoria</h3>
                <button class="modal-close" onclick="closeCategoryModal()">&times;</button>
            </div>
            <form id="categoryForm">
                <input type="hidden" id="categoryId">
                <div class="form-group">
                    <label for="categoryName">Nome da Categoria</label>
                    <input type="text" id="categoryName" required>
                </div>
                <div class="form-group">
                    <label for="categoryDescription">Descrição (opcional)</label>
                    <textarea id="categoryDescription" rows="3" placeholder="Descrição da categoria"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="button" class="btn btn-secondary" onclick="closeCategoryModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    
    <script src="assets/js/categories.js"></script>
</body>
</html>
