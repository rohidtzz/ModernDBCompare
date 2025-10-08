<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ModernDBCompare - Database Schema Comparison Tool</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <script src="/public/js/jquery.min.js"></script>
    <script src="/public/js/functional.js"></script>
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .main-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        .header-gradient {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 2rem;
        }
        .nav-pills .nav-link {
            border-radius: 25px;
            margin: 0 3px;
            transition: all 0.3s ease;
        }
        .nav-pills .nav-link.active {
            background: linear-gradient(45deg, #667eea, #764ba2);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        .database-header {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }
        .table-card {
            background: #fff;
            border-radius: 10px;
            border: 1px solid #e3e6f0;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }
        .table-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .table-card.has-differences {
            border-left: 4px solid #ffc107;
            box-shadow: 0 2px 8px rgba(255, 193, 7, 0.2);
            background: linear-gradient(135deg, #fff9e6, #ffffff);
        }
        .table-card.identical {
            border-left: 4px solid #28a745;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.1);
        }
        .comparison-summary {
            background: linear-gradient(135deg, #e3f2fd, #f8f9fa);
            border-radius: 10px;
            border-left: 4px solid #2196f3;
        }

        .badge-count {
            background: linear-gradient(45deg, #dc3545, #fd7e14);
        }

        .btn-gradient {
            background: linear-gradient(45deg, #667eea, #764ba2) !important;
            border: none;
            color: white;
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
            color: white;
        }
        .modal-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            z-index: 9999;
        }
        .modal {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            height: 80%;
            background: white;
            border-radius: 15px;
            overflow: hidden;
        }
        .modal iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>

<body>
    <!-- Modal for table data -->
    <div class="modal-background" onclick="Data.hideTableData(); return false;">
        <div class="modal">
            <iframe src="" frameborder="0"></iframe>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card main-card border-0">
                    <!-- Header -->
                    <div class="header-gradient text-center">
                        <h1 class="display-4 fw-bold mb-2">
                            ModernDBCompare<span style="color: #ffd700;"> 🔍</span>
                        </h1>
                        <p class="lead mb-0">
                            <i class="bi bi-database me-2"></i>Modern Database Schema Comparison Tool
                        </p>
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- Navigation and Config Button -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-items-center">
                                <!-- Navigation Pills -->
                                <ul class="nav nav-pills">
                                    <?php
                                    switch (DRIVER) {
                                        case 'oci8':
                                        case 'oci':
                                        case 'mysql':
                                            $buttons = array(
                                                'tables' => ['icon' => 'table', 'label' => 'Tables'],
                                                'views' => ['icon' => 'eye', 'label' => 'Views'],
                                                'procedures' => ['icon' => 'gear', 'label' => 'Procedures'],
                                                'functions' => ['icon' => 'code-square', 'label' => 'Functions'],
                                                'indexes' => ['icon' => 'list-columns', 'label' => 'Indexes'],
                                                'triggers' => ['icon' => 'lightning', 'label' => 'Triggers']
                                            );
                                            break;
                                        case 'sqlserv':
                                        case 'mssql':
                                        case 'dblib':
                                            $buttons = array(
                                                'tables' => ['icon' => 'table', 'label' => 'Tables'],
                                                'views' => ['icon' => 'eye', 'label' => 'Views'],
                                                'procedures' => ['icon' => 'gear', 'label' => 'Procedures'],
                                                'functions' => ['icon' => 'code-square', 'label' => 'Functions'],
                                                'indexes' => ['icon' => 'list-columns', 'label' => 'Indexes']
                                            );
                                            break;
                                        case 'pgsql':
                                            $buttons = array(
                                                'tables' => ['icon' => 'table', 'label' => 'Tables'],
                                                'views' => ['icon' => 'eye', 'label' => 'Views'],
                                                'functions' => ['icon' => 'code-square', 'label' => 'Functions'],
                                                'indexes' => ['icon' => 'list-columns', 'label' => 'Indexes']
                                            );
                                            break;
                                    }

                                    if (!isset($_REQUEST['action'])) $_REQUEST['action'] = 'tables';
                                    foreach ($buttons as $key => $button) {
                                        $activeClass = ($key == $_REQUEST['action']) ? 'active' : '';
                                        echo '<li class="nav-item">
                                                <a class="nav-link ' . $activeClass . '" href="index.php?action=' . $key . '">
                                                    <i class="bi bi-' . $button['icon'] . ' me-1"></i>' . $button['label'] . '
                                                </a>
                                              </li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <!-- View Toggle -->
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-primary btn-sm active" onclick="Data.showAll(this); return false;">
                                        <i class="bi bi-eye me-1"></i>All
                                    </button>
                                    <button type="button" class="btn btn-outline-warning btn-sm" onclick="Data.showDiff(this); return false;">
                                        <i class="bi bi-exclamation-triangle me-1"></i>Changed
                                    </button>
                                </div>
                                
                                <!-- Config Button -->
                                <a href="config-editor.php" class="btn btn-gradient btn-sm">
                                    <i class="bi bi-gear me-1"></i>Configuration
                                </a>
                            </div>
                        </div>
                        <!-- Database Headers -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="database-header p-3 h-100">
                                    <h4 class="fw-bold mb-2">
                                        <i class="bi bi-database-fill me-2 text-primary"></i>
                                        <?php echo DATABASE_NAME ?>
                                    </h4>
                                    <p class="text-danger mb-1 fw-semibold"><?php echo DATABASE_DESCRIPTION ?></p>
                                    <small class="text-muted">
                                        <i class="bi bi-server me-1"></i>
                                        <?php $spath = explode("@", FIRST_DSN); echo end($spath); ?>
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="database-header p-3 h-100">
                                    <h4 class="fw-bold mb-2">
                                        <i class="bi bi-database me-2 text-primary"></i>
                                        <?php echo DATABASE_NAME_SECONDARY ?>
                                    </h4>
                                    <p class="text-danger mb-1 fw-semibold"><?php echo DATABASE_DESCRIPTION_SECONDARY ?></p>
                                    <small class="text-muted">
                                        <i class="bi bi-server me-1"></i>
                                        <?php $spath = explode("@", SECOND_DSN); echo end($spath); ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Comparison Summary -->
                        <?php 
                        // Analyze tables to get summary
                        $totalTables = count($tables);
                        $tablesWithDifferences = [];
                        $identicalTables = [];
                        
                        foreach ($tables as $tableName => $data) {
                            $hasTableDifferences = false;
                            
                            // Check both sides for differences
                            foreach (array('fArray', 'sArray') as $blockType) {
                                if ($data != null && isset($data[$blockType]) && $data[$blockType] != null) {
                                    foreach ($data[$blockType] as $fieldName => $tparam) {
                                        if ((isset($tparam['isNew']) && $tparam['isNew']) || 
                                            (isset($tparam['changeType']) && $tparam['changeType'])) {
                                            $hasTableDifferences = true;
                                            break 2; // Break both loops
                                        }
                                    }
                                }
                            }
                            
                            if ($hasTableDifferences) {
                                $tablesWithDifferences[$tableName] = $data;
                            } else {
                                $identicalTables[$tableName] = $data;
                            }
                        }
                        
                        $differencesCount = count($tablesWithDifferences);
                        $identicalCount = count($identicalTables);
                        
                        // Combine arrays with differences first
                        $sortedTables = array_merge($tablesWithDifferences, $identicalTables);
                        ?>
                        
                        <!-- Summary Info -->
                        <div class="comparison-summary p-3 mb-4">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h6 class="mb-1 fw-bold">
                                        <i class="bi bi-info-circle me-2"></i>Comparison Summary
                                    </h6>
                                    <small class="text-muted">
                                        Total: <strong><?php echo $totalTables; ?></strong> <?php echo $_REQUEST['action']; ?> • 
                                        <span class="text-warning">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                            <strong><?php echo $differencesCount; ?></strong> with differences
                                        </span> • 
                                        <span class="text-success">
                                            <i class="bi bi-check-circle-fill me-1"></i>
                                            <strong><?php echo $identicalCount; ?></strong> identical
                                        </span>
                                    </small>
                                </div>
                                <div class="col-md-4 text-end">
                                    <?php if ($differencesCount > 0) { ?>
                                        <span class="badge bg-warning text-dark fs-6">
                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                            <?php echo $differencesCount; ?> Different
                                        </span>
                                    <?php } else { ?>
                                        <span class="badge bg-success fs-6">
                                            <i class="bi bi-check-circle me-1"></i>
                                            All Identical
                                        </span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tables/Objects Comparison (Sorted: Differences First) -->
                        <?php foreach ($sortedTables as $tableName => $data) { 
                            // Determine if this table has differences
                            $hasTableDifferences = array_key_exists($tableName, $tablesWithDifferences);
                        ?>
                        <div class="row mb-3 table-comparison-row">
                            <?php foreach (array('fArray', 'sArray') as $blockType) { ?>
                            <div class="col-md-6">
                                <div class="table-card p-3 h-100 <?php echo $hasTableDifferences ? 'has-differences' : 'identical'; ?>">
                                    <!-- Table Header -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="mb-0 fw-bold d-flex align-items-center">
                                            <?php 
                                            $icon = '';
                                            switch($_REQUEST['action']) {
                                                case 'tables': $icon = 'table'; break;
                                                case 'views': $icon = 'eye'; break;
                                                case 'procedures': $icon = 'gear'; break;
                                                case 'functions': $icon = 'code-square'; break;
                                                case 'indexes': $icon = 'list-columns'; break;
                                                case 'triggers': $icon = 'lightning'; break;
                                                default: $icon = 'database';
                                            }
                                            ?>
                                            <i class="bi bi-<?php echo $icon; ?> me-2 text-primary"></i>
                                            <?php echo $tableName; ?>
                                            
                                            <!-- Status Indicator -->
                                            <?php if ($hasTableDifferences) { ?>
                                                <span class="badge bg-warning text-dark ms-2 fs-7">
                                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                                </span>
                                            <?php } else { ?>
                                                <span class="badge bg-success ms-2 fs-7">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                </span>
                                            <?php } ?>
                                        </h5>
                                        <?php if ($data != null && isset($data[$blockType]) && $data[$blockType] != null) { ?>
                                        <span class="badge badge-count text-white">
                                            <?php echo count($data[$blockType]); ?>
                                        </span>
                                        <?php } ?>
                                    </div>
                                    
                                    <!-- Additional Info -->
                                    <?php if(isset($additionalTableInfo[$tableName][$blockType])) { ?>
                                    <div class="table-additional-info mb-3">
                                        <div class="bg-light p-2 rounded">
                                            <?php 
                                            foreach ($additionalTableInfo[$tableName][$blockType] as $paramKey => $paramValue) {
                                                if(strpos($paramKey, 'ARRAY_KEY') === false) {
                                                    echo "<small><strong>{$paramKey}:</strong> {$paramValue}</small><br>";
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    
                                    <!-- Fields List -->
                                    <?php if ($data[$blockType]) { ?>
                                    <div class="fields-list">
                                        <?php foreach ($data[$blockType] as $fieldName => $tparam) { ?>
                                        <div class="d-flex justify-content-between align-items-center py-1 border-bottom border-light">
                                            <span class="field-name <?php if (isset($tparam['isNew']) && $tparam['isNew']) echo 'text-danger fw-bold'; ?>">
                                                <strong><?php echo htmlspecialchars($fieldName); ?></strong>
                                            </span>
                                            <span class="field-type <?php if (isset($tparam['changeType']) && $tparam['changeType']) echo 'text-danger fw-bold'; ?>">
                                                <code class="<?php echo (isset($tparam['changeType']) && $tparam['changeType']) ? 'text-danger' : 'text-muted'; ?>"><?php echo htmlspecialchars($tparam['dtype']); ?></code>
                                            </span>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                    
                                    <!-- Table Status & Preview Button -->
                                    <?php if ($data != null && isset($data[$blockType]) && $data[$blockType] != null && count($data[$blockType]) && in_array($_REQUEST['action'], array('tables', 'views'))) { 
                                        // Check if there are differences in this table
                                        $hasDifferences = false;
                                        foreach ($data[$blockType] as $fieldName => $tparam) {
                                            if ((isset($tparam['isNew']) && $tparam['isNew']) || (isset($tparam['changeType']) && $tparam['changeType'])) {
                                                $hasDifferences = true;
                                                break;
                                            }
                                        }
                                        
                                        if ($hasDifferences) {
                                            $buttonClass = 'btn-warning';
                                            $iconClass = 'exclamation-triangle-fill';
                                            $statusText = 'Ada Perbedaan';
                                            $buttonText = 'Preview Data';
                                        } else {
                                            $buttonClass = 'btn-success';
                                            $iconClass = 'check-circle-fill';
                                            $statusText = 'Identik';
                                            $buttonText = 'Preview Data';
                                        }
                                    ?>
                                    <div class="mt-3 text-center">
                                        <!-- Status Badge -->
                                        <span class="badge <?php echo str_replace('btn-', 'bg-', $buttonClass); ?> fs-6">
                                            <i class="bi bi-<?php echo $iconClass; ?> me-1"></i>
                                            <?php echo $statusText; ?>
                                        </span>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                    
                    <!-- Footer -->
                    <div class="card-footer bg-light text-center border-0">
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            ModernDBCompare - Enhanced database comparison tool with Bootstrap 5 UI
                            <br>
                            <i class="bi bi-github me-1"></i>
                            <a href="https://github.com/rohidtzz/ModernDBCompare" target="_blank" class="text-decoration-none">
                                <strong>GitHub Repository</strong>
                            </a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Enhanced button toggle functionality
        document.querySelectorAll('.btn-group button').forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from siblings
                this.parentNode.querySelectorAll('button').forEach(b => b.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
            });
        });
    </script>
</body>
