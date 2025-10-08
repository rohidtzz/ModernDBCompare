<?php
/**
 * ModernDBCompare - Web Configuration Editor
 * 
 * Modern database comparison tool with Bootstrap 5 UI
 * Enhanced fork of the original project with significant improvements
 * 
 * @author Rohidtzz
 * @version 2.0.0
 * @license MIT
 * @original Original project by Dmitriy Karpuk (dkarpuk)
 */

require_once 'config.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_config'])) {
    $config_content = "[ Main settings ]\n";
    $config_content .= "; Possible DATABASE_DRIVER: 'mysql', 'pgsql', 'dblib', 'oci'.\n";
    $config_content .= "; Please use 'dblib' for Microsoft SQL Server\n";
    $config_content .= "DATABASE_DRIVER = " . $_POST['DATABASE_DRIVER'] . "\n";
    $config_content .= "DATABASE_ENCODING = " . $_POST['DATABASE_ENCODING'] . "\n";
    $config_content .= "SAMPLE_DATA_LENGTH = " . $_POST['SAMPLE_DATA_LENGTH'] . "\n\n";
    
    $config_content .= "[ Primary connection params ]\n";
    $config_content .= "DATABASE_HOST = " . $_POST['DATABASE_HOST'] . "\n";
    $config_content .= "DATABASE_PORT = " . $_POST['DATABASE_PORT'] . "\n";
    $config_content .= "DATABASE_NAME = " . $_POST['DATABASE_NAME'] . "\n";
    $config_content .= "DATABASE_USER = " . $_POST['DATABASE_USER'] . "\n";
    $config_content .= "DATABASE_PASSWORD = " . $_POST['DATABASE_PASSWORD'] . "\n";
    $config_content .= "DATABASE_DESCRIPTION = " . $_POST['DATABASE_DESCRIPTION'] . "\n\n";
    
    $config_content .= "[ Secondary connection params ]\n";
    $config_content .= "DATABASE_HOST_SECONDARY = " . $_POST['DATABASE_HOST_SECONDARY'] . "\n";
    $config_content .= "DATABASE_PORT_SECONDARY = " . $_POST['DATABASE_PORT_SECONDARY'] . "\n";
    $config_content .= "DATABASE_NAME_SECONDARY = " . $_POST['DATABASE_NAME_SECONDARY'] . "\n";
    $config_content .= "DATABASE_USER_SECONDARY = " . $_POST['DATABASE_USER_SECONDARY'] . "\n";
    $config_content .= "DATABASE_PASSWORD_SECONDARY = " . $_POST['DATABASE_PASSWORD_SECONDARY'] . "\n";
    $config_content .= "DATABASE_DESCRIPTION_SECONDARY = " . $_POST['DATABASE_DESCRIPTION_SECONDARY'] . "\n";
    
    if (file_put_contents(ENVIRONMENT_FILE, $config_content)) {
        $success_message = "Configuration saved successfully!";
        // Reload the configuration
        header("Location: " . $_SERVER['PHP_SELF'] . "?saved=1");
        exit;
    } else {
        $error_message = "Failed to save configuration file.";
    }
}

// Get current configuration
$current_config = [];
if (file_exists(ENVIRONMENT_FILE)) {
    $current_config = parse_ini_file(ENVIRONMENT_FILE, false, INI_SCANNER_RAW);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ModernDBCompare - Configuration Editor</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .config-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        .section-header {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            margin: -1.5rem -1.5rem 1.5rem -1.5rem;
            padding: 1rem 1.5rem;
            border-radius: 15px 15px 0 0;
        }
        .form-section {
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }
        .btn-gradient {
            background: linear-gradient(45deg, #667eea, #764ba2) !important;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <!-- Header -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bold mb-2">
                        <i class="bi bi-gear-fill me-3"></i>Configuration Editor
                    </h1>
                    <p class="lead">Manage your ModernDBCompare database connections</p>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        <?php if (isset($_GET['saved'])): ?>
            <div class="row justify-content-center mb-4">
                <div class="col-lg-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <strong>Success!</strong> Configuration saved successfully!
                        <a href="index.php" class="alert-link ms-2">← Back to ModernDBCompare</a>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
            <div class="row justify-content-center mb-4">
                <div class="col-lg-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Error!</strong> <?php echo htmlspecialchars($error_message); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- Configuration Form -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card config-card border-0">
                    <div class="card-body p-4">
                        <form method="POST">
                            <!-- Main Settings -->
                            <div class="form-section p-4 mb-4">
                                <div class="section-header">
                                    <h4 class="mb-0">
                                        <i class="bi bi-sliders me-2"></i>Main Settings
                                    </h4>
                                </div>
                                <div class="mb-3">
                                    <label for="DATABASE_DRIVER" class="form-label fw-semibold">
                                        <i class="bi bi-database me-1"></i>Database Driver
                                    </label>
                                    <select name="DATABASE_DRIVER" id="DATABASE_DRIVER" class="form-select" required>
                                        <option value="mysql" <?php echo (isset($current_config['DATABASE_DRIVER']) && $current_config['DATABASE_DRIVER'] == 'mysql') ? 'selected' : ''; ?>>
                                            <i class="bi bi-database"></i> MySQL
                                        </option>
                                        <option value="pgsql" <?php echo (isset($current_config['DATABASE_DRIVER']) && $current_config['DATABASE_DRIVER'] == 'pgsql') ? 'selected' : ''; ?>>
                                            PostgreSQL
                                        </option>
                                        <option value="dblib" <?php echo (isset($current_config['DATABASE_DRIVER']) && $current_config['DATABASE_DRIVER'] == 'dblib') ? 'selected' : ''; ?>>
                                            Microsoft SQL Server
                                        </option>
                                        <option value="oci" <?php echo (isset($current_config['DATABASE_DRIVER']) && $current_config['DATABASE_DRIVER'] == 'oci') ? 'selected' : ''; ?>>
                                            Oracle
                                        </option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="DATABASE_ENCODING" class="form-label fw-semibold">
                                                <i class="bi bi-translate me-1"></i>Database Encoding
                                            </label>
                                            <input type="text" name="DATABASE_ENCODING" id="DATABASE_ENCODING" 
                                                   class="form-control" 
                                                   value="<?php echo htmlspecialchars($current_config['DATABASE_ENCODING'] ?? 'utf8'); ?>" 
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="SAMPLE_DATA_LENGTH" class="form-label fw-semibold">
                                                <i class="bi bi-list-ol me-1"></i>Sample Data Length
                                            </label>
                                            <input type="number" name="SAMPLE_DATA_LENGTH" id="SAMPLE_DATA_LENGTH" 
                                                   class="form-control" 
                                                   value="<?php echo htmlspecialchars($current_config['SAMPLE_DATA_LENGTH'] ?? '100'); ?>" 
                                                   required>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Primary Database -->
                            <div class="form-section p-4 mb-4">
                                <div class="section-header">
                                    <h4 class="mb-0">
                                        <i class="bi bi-database-fill me-2"></i>Primary Database Connection
                                    </h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="DATABASE_HOST" class="form-label fw-semibold">
                                                <i class="bi bi-server me-1"></i>Host
                                            </label>
                                            <input type="text" name="DATABASE_HOST" id="DATABASE_HOST" 
                                                   class="form-control" 
                                                   value="<?php echo htmlspecialchars($current_config['DATABASE_HOST'] ?? 'localhost'); ?>" 
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="DATABASE_PORT" class="form-label fw-semibold">
                                                <i class="bi bi-plug me-1"></i>Port
                                            </label>
                                            <input type="number" name="DATABASE_PORT" id="DATABASE_PORT" 
                                                   class="form-control" 
                                                   value="<?php echo htmlspecialchars($current_config['DATABASE_PORT'] ?? '3306'); ?>" 
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="DATABASE_NAME" class="form-label fw-semibold">
                                        <i class="bi bi-collection me-1"></i>Database Name
                                    </label>
                                    <input type="text" name="DATABASE_NAME" id="DATABASE_NAME" 
                                           class="form-control" 
                                           value="<?php echo htmlspecialchars($current_config['DATABASE_NAME'] ?? ''); ?>" 
                                           required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="DATABASE_USER" class="form-label fw-semibold">
                                                <i class="bi bi-person me-1"></i>Username
                                            </label>
                                            <input type="text" name="DATABASE_USER" id="DATABASE_USER" 
                                                   class="form-control" 
                                                   value="<?php echo htmlspecialchars($current_config['DATABASE_USER'] ?? ''); ?>" 
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="DATABASE_PASSWORD" class="form-label fw-semibold">
                                                <i class="bi bi-lock me-1"></i>Password
                                            </label>
                                            <input type="password" name="DATABASE_PASSWORD" id="DATABASE_PASSWORD" 
                                                   class="form-control" 
                                                   value="<?php echo htmlspecialchars($current_config['DATABASE_PASSWORD'] ?? ''); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="DATABASE_DESCRIPTION" class="form-label fw-semibold">
                                        <i class="bi bi-card-text me-1"></i>Description
                                    </label>
                                    <input type="text" name="DATABASE_DESCRIPTION" id="DATABASE_DESCRIPTION" 
                                           class="form-control" 
                                           value="<?php echo htmlspecialchars($current_config['DATABASE_DESCRIPTION'] ?? 'Primary database'); ?>" 
                                           required>
                                </div>
                            </div>
            
                            <!-- Secondary Database -->
                            <div class="form-section p-4 mb-4">
                                <div class="section-header">
                                    <h4 class="mb-0">
                                        <i class="bi bi-database me-2"></i>Secondary Database Connection
                                    </h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="DATABASE_HOST_SECONDARY" class="form-label fw-semibold">
                                                <i class="bi bi-server me-1"></i>Host
                                            </label>
                                            <input type="text" name="DATABASE_HOST_SECONDARY" id="DATABASE_HOST_SECONDARY" 
                                                   class="form-control" 
                                                   value="<?php echo htmlspecialchars($current_config['DATABASE_HOST_SECONDARY'] ?? 'localhost'); ?>" 
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="DATABASE_PORT_SECONDARY" class="form-label fw-semibold">
                                                <i class="bi bi-plug me-1"></i>Port
                                            </label>
                                            <input type="number" name="DATABASE_PORT_SECONDARY" id="DATABASE_PORT_SECONDARY" 
                                                   class="form-control" 
                                                   value="<?php echo htmlspecialchars($current_config['DATABASE_PORT_SECONDARY'] ?? '3306'); ?>" 
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="DATABASE_NAME_SECONDARY" class="form-label fw-semibold">
                                        <i class="bi bi-collection me-1"></i>Database Name
                                    </label>
                                    <input type="text" name="DATABASE_NAME_SECONDARY" id="DATABASE_NAME_SECONDARY" 
                                           class="form-control" 
                                           value="<?php echo htmlspecialchars($current_config['DATABASE_NAME_SECONDARY'] ?? ''); ?>" 
                                           required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="DATABASE_USER_SECONDARY" class="form-label fw-semibold">
                                                <i class="bi bi-person me-1"></i>Username
                                            </label>
                                            <input type="text" name="DATABASE_USER_SECONDARY" id="DATABASE_USER_SECONDARY" 
                                                   class="form-control" 
                                                   value="<?php echo htmlspecialchars($current_config['DATABASE_USER_SECONDARY'] ?? ''); ?>" 
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="DATABASE_PASSWORD_SECONDARY" class="form-label fw-semibold">
                                                <i class="bi bi-lock me-1"></i>Password
                                            </label>
                                            <input type="password" name="DATABASE_PASSWORD_SECONDARY" id="DATABASE_PASSWORD_SECONDARY" 
                                                   class="form-control" 
                                                   value="<?php echo htmlspecialchars($current_config['DATABASE_PASSWORD_SECONDARY'] ?? ''); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="DATABASE_DESCRIPTION_SECONDARY" class="form-label fw-semibold">
                                        <i class="bi bi-card-text me-1"></i>Description
                                    </label>
                                    <input type="text" name="DATABASE_DESCRIPTION_SECONDARY" id="DATABASE_DESCRIPTION_SECONDARY" 
                                           class="form-control" 
                                           value="<?php echo htmlspecialchars($current_config['DATABASE_DESCRIPTION_SECONDARY'] ?? 'Secondary database'); ?>" 
                                           required>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="index.php" class="btn btn-outline-secondary btn-lg me-md-2">
                                    <i class="bi bi-arrow-left me-2"></i>Back to ModernDBCompare
                                </a>
                                <button type="submit" name="save_config" class="btn btn-gradient btn-lg">
                                    <i class="bi bi-check-circle me-2"></i>Save Configuration
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>