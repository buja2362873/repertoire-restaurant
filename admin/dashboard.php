<?php
require_once 'check_session.php';
require_once 'db_connection.php';

// Get all tables from database
$tables = [];
try {
    $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    $error = 'Error fetching tables: ' . $e->getMessage();
}

// Get selected table and its data
$selectedTable = $_GET['table'] ?? ($tables[0] ?? null);
$tableData = [];
$tableColumns = [];

if ($selectedTable) {
    try {
        // Get columns
        $stmt = $pdo->query("PRAGMA table_info($selectedTable)");
        $tableColumns = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Get data
        $stmt = $pdo->query("SELECT * FROM $selectedTable");
        $tableData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $error = 'Error fetching table data: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="EN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Restaurant</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link rel="stylesheet" href="../css/admin/dashboard.css">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="admin-sidebar-header">
                <h2 class="admin-sidebar-title">Admin Panel</h2>
                <span class="admin-user-info"><?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
            </div>

            <nav class="admin-sidebar-nav">
                <p class="admin-nav-label">Tables</p>
                <?php foreach ($tables as $table): ?>
                    <a 
                        href="?table=<?php echo urlencode($table); ?>" 
                        class="admin-nav-item <?php echo $table === $selectedTable ? 'active' : ''; ?>"
                    >
                        <?php echo htmlspecialchars(ucfirst($table)); ?>
                    </a>
                <?php endforeach; ?>
            </nav>

            <div class="admin-sidebar-footer">
                <a href="logout.php" class="admin-btn-logout">Logout</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <header class="admin-header">
                <h1 class="admin-page-title"><?php echo $selectedTable ? ucfirst(htmlspecialchars($selectedTable)) : 'Dashboard'; ?></h1>
                <?php if ($selectedTable): ?>
                    <button class="admin-btn-primary" id="addNewBtn">Add New</button>
                <?php endif; ?>
            </header>

            <div class="admin-content">
                <?php if (!$selectedTable): ?>
                    <div class="admin-no-table">
                        <p>Select a table to view and manage its content</p>
                    </div>
                <?php elseif (empty($tableData)): ?>
                    <div class="admin-no-data">
                        <p>No data in this table</p>
                        <button class="admin-btn-primary" id="addNewBtnEmpty">Add First Entry</button>
                    </div>
                <?php else: ?>
                    <div class="admin-table-wrapper">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <?php foreach ($tableColumns as $column): ?>
                                        <th><?php echo htmlspecialchars($column['name']); ?></th>
                                    <?php endforeach; ?>
                                    <th class="admin-actions-col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tableData as $row): ?>
                                    <tr>
                                        <?php foreach ($tableColumns as $column): ?>
                                            <td class="admin-cell" data-column="<?php echo htmlspecialchars($column['name']); ?>">
                                                <?php 
                                                    $value = $row[$column['name']] ?? '';
                                                    $displayValue = strlen($value) > 50 ? substr($value, 0, 50) . '...' : $value;
                                                    echo htmlspecialchars($displayValue);
                                                ?>
                                            </td>
                                        <?php endforeach; ?>
                                        <td class="admin-actions-cell">
                                            <button 
                                                class="admin-btn-icon admin-btn-edit" 
                                                data-row="<?php echo htmlspecialchars(json_encode($row)); ?>"
                                                title="Edit"
                                            >
                                                <span class="material-symbols-outlined">edit</span>
                                            </button>
                                            <button 
                                                class="admin-btn-icon admin-btn-delete" 
                                                data-id="<?php echo htmlspecialchars($row[$tableColumns[0]['name']]); ?>"
                                                title="Delete"
                                            >
                                                <span class="material-symbols-outlined">delete</span>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <!-- Add/Edit Modal -->
    <?php include '../components/admin/modal.php'; ?>

    <script src="../js/admin/dashboard.js"></script>
    <script>
        const selectedTable = '<?php echo htmlspecialchars($selectedTable); ?>';
        const tableColumns = <?php echo json_encode($tableColumns); ?>;
    </script>
</body>
</html>