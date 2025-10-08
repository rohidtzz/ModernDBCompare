@echo off
REM ModernDBCompare Built-in Server Launcher for Windows
REM This script starts PHP built-in server with web configuration editor

echo 🚀 Starting ModernDBCompare Server...
echo =====================================

REM Check if PHP is installed
php -v >nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo ❌ PHP is not installed or not in PATH
    echo Please install PHP to continue
    pause
    exit /b 1
)

REM Check PHP version
for /f "tokens=2" %%i in ('php -v ^| findstr /R "^PHP"') do set PHP_VERSION=%%i
echo ✅ PHP Version: %PHP_VERSION%

REM Check if .environment file exists
if not exist ".environment" (
    echo ⚠️  .environment file not found
    if exist ".environment.example" (
        echo 📋 Copying .environment.example to .environment
        copy ".environment.example" ".environment" >nul
        echo ✅ Please edit the configuration via web interface after starting the server
    ) else (
        echo ❌ Neither .environment nor .environment.example found
        echo Please create configuration file first
        pause
        exit /b 1
    )
) else (
    echo ✅ Configuration file found
)

REM Set default port
set PORT=%1
if "%PORT%"=="" set PORT=8000

echo.
echo 🌐 ModernDBCompare: http://localhost:%PORT%
echo ⚙️  Configuration Editor: http://localhost:%PORT%/config-editor.php
echo.
echo Press Ctrl+C to stop the server
echo =====================================

REM Start PHP built-in server
php -S localhost:%PORT% -t .