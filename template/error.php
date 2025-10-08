<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ModernDBCompare - Error</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .error-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        .header-gradient {
            background: linear-gradient(45deg, #dc3545, #fd7e14);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 2rem;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card error-card border-0">
                    <!-- Header -->
                    <div class="header-gradient text-center">
                        <h1 class="display-4 fw-bold mb-2">
                            <i class="bi bi-exclamation-triangle-fill me-3"></i>Error
                        </h1>
                        <p class="lead mb-0">Something went wrong with ModernDBCompare</p>
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- Error Message -->
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <i class="bi bi-exclamation-circle-fill me-3 fs-4"></i>
                            <div>
                                <h5 class="alert-heading mb-2">Connection Error</h5>
                                <p class="mb-0"><?php echo htmlspecialchars($e->getMessage()); ?></p>
                            </div>
                        </div>
                        
                        <!-- Stack Trace -->
                        <div class="mt-4">
                            <h5 class="mb-3">
                                <i class="bi bi-bug me-2"></i>Stack Trace
                            </h5>
                            <div class="bg-light p-3 rounded">
                                <pre class="mb-0 small text-muted"><?php echo htmlspecialchars($e->getTraceAsString()); ?></pre>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="mt-4 text-center">
                            <a href="config-editor.php" class="btn btn-primary me-2">
                                <i class="bi bi-gear me-1"></i>Edit Configuration
                            </a>
                            <a href="index.php" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-clockwise me-1"></i>Try Again
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>