#!/bin/bash

# ModernDBCompare Built-in Server Launcher
# This script starts PHP built-in server with web configuration editor

echo "🚀 Starting ModernDBCompare Server..."
echo "====================================="

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "❌ PHP is not installed or not in PATH"
    echo "Please install PHP to continue"
    exit 1
fi

# Check PHP version
PHP_VERSION=$(php -v | head -n 1 | cut -d ' ' -f 2)
echo "✅ PHP Version: $PHP_VERSION"

# Check if .environment file exists
if [ ! -f ".environment" ]; then
    echo "⚠️  .environment file not found"
    if [ -f ".environment.example" ]; then
        echo "📋 Copying .environment.example to .environment"
        cp .environment.example .environment
        echo "✅ Please edit the configuration via web interface after starting the server"
    else
        echo "❌ Neither .environment nor .environment.example found"
        echo "Please create configuration file first"
        exit 1
    fi
else
    echo "✅ Configuration file found"
fi

# Set default port
PORT=${1:-8000}

echo ""
echo "🌐 ModernDBCompare: http://localhost:$PORT"
echo "⚙️  Configuration Editor: http://localhost:$PORT/config-editor.php"
echo ""
echo "Press Ctrl+C to stop the server"
echo "====================================="

# Start PHP built-in server
php -S localhost:$PORT -t .