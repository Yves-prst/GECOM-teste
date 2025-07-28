<div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h2>Admin System</h2>
            <button class="sidebar-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <nav class="sidebar-nav">
            <a href="dashboard.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'active' : ''; ?>">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="produtos.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'produtos.php' ? 'active' : ''; ?>">
                <i class="fas fa-box"></i>
                <span>Produtos</span>
            </a>
            <a href="categorias.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'categorias.php' ? 'active' : ''; ?>">
                <i class="fas fa-folder-open"></i>
                <span>Categorias</span>
            </a>
            <a href="mesas.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'mesas.php' ? 'active' : ''; ?>">
                <i class="fas fa-chair"></i>
                <span>Mesas</span>
            </a>
            <a href="relatorios.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'relatorios.php' ? 'active' : ''; ?>">
                <i class="fas fa-chart-bar"></i>
                <span>Relatórios</span>
            </a>
            <li>
            <a href="funcionarios.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'funcionarios.php' ? 'active' : ''; ?>">
                <i class="fas fa-users"></i>
                <span>Funcionários</span>
            </a>
            <li>
            <a href="configuracoes.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'configuracoes.php' ? 'active' : ''; ?>">
                <i class="fas fa-cog"></i>
                <span>Configurações</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="api/logout.php" class="nav-link logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sair</span>
            </a>
        </div>
    </div>


<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

