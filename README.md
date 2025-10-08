# ModernDBCompare 🔍

> Modern web-based database comparison tool with elegant Bootstrap 5 interface

## What is ModernDBCompare?
ModernDBCompare is an enhanced, modern version of database schema comparison tool with beautiful Bootstrap 5 UI. It supports MySQL, PostgreSQL, MS SQL Server and Oracle databases with a responsive web interface.

## ✨ Features

- 🎨 **Modern Bootstrap 5 UI** - Beautiful, responsive design
- ⚙️ **Web Configuration Editor** - Edit database settings via web interface
- 🔄 **Database Comparison** - Compare tables, views, procedures, functions, indexes, and triggers
- 📱 **Responsive Design** - Works perfectly on mobile and desktop
- 🚀 **Built-in Server** - Easy development with PHP built-in server
- 🎪 **Glass Morphism Design** - Modern UI with gradient backgrounds
- 📊 **Sample Data Preview** - View table contents with pagination

## 🚀 Quick Start

### 1. Setup Configuration
```bash
# Copy environment template
cp .environment.example .environment

# Edit configuration (or use web interface)
nano .environment
```

### 2. Start Development Server
```bash
# Linux/Mac
./server.sh [port]

# Windows
server.bat [port]

# Manual
php -S localhost:8000
```

### 3. Access Application
- **Main application**: http://localhost:8000
- **Configuration editor**: http://localhost:8000/config-editor.php

**New Web Interface Features:**
- ✅ Modern Bootstrap 5 design with animations
- ✅ Web-based configuration editor
- ✅ Real-time configuration changes
- ✅ Mobile-responsive interface
- ✅ Glass morphism and gradient themes

## �️ Configuration

You can configure ModernDBCompare in two ways:

### Web Interface (Recommended)
Use the modern web-based configuration editor at `http://localhost:8000/config-editor.php` with Bootstrap 5 interface.

### Manual Configuration
Edit `.environment` file directly: 

`DATABASE_DRIVER` - database driver, possible value

- `mysql` - for MySQL database
- `pgsql` - for PostgreSQL database
- `dblib` - for Microsoft SQL Server database
- `oci`   - for Oracle database

`DATABASE_HOST` and `DATABASE_HOST_SECONDARY`  - database host name or IP for first and second server



`DATABASE_PORT` and `DATABASE_PORT_SECONDARY` - database port for first and second server

Default ports for DB:

- `3306` - Mysql
- `5432` - PostgreSQL
- `1433` - MSSQL
- `1521` - Oracle

`DATABASE_NAME` and `DATABASE_NAME_SECONDARY` - first and second database name

`DATABASE_USER` / `DATABASE_PASSWORD`  and `DATABASE_USER_SECONDARY` / `DATABASE_PASSWORD_SECONDARY` - login and password to access your databases 

`DATABASE_DESCRIPTION` and `DATABASE_DESCRIPTION_SECONDARY` - server description (not necessary). For information only. These names will display as a database name.

## Requirements 

ModernDBCompare requires PHP 7.4 and up with PDO extension.

## Installation

	$ git clone https://github.com/rohidtzz/ModernDBCompare.git
	$ cd ModernDBCompare
	
Open `.environment`. You'll see configuration params

```ini
[ Main settings ]
; Possible DATABASE_DRIVER: 'mysql', 'pgsql', 'dblib', 'oci'.
; Please use 'dblib' for Microsoft SQL Server
DATABASE_DRIVER = mysql
DATABASE_ENCODING = utf8
SAMPLE_DATA_LENGTH = 100

[ Primary connection params ]
DATABASE_HOST = localhost
DATABASE_PORT = 3306
DATABASE_NAME = moderndb_dev
DATABASE_USER = root
DATABASE_PASSWORD =
DATABASE_DESCRIPTION = Developer database

[ Secondary connection params ]
DATABASE_HOST_SECONDARY = localhost
DATABASE_PORT_SECONDARY = 3306
DATABASE_NAME_SECONDARY = moderndb_prod
DATABASE_USER_SECONDARY = root
DATABASE_PASSWORD_SECONDARY =
DATABASE_DESCRIPTION_SECONDARY = Production database
```

where 

`DATABASE_DRIVER` - database driver, possible value

- `mysql` - for MySQL database
- `pgsql` - for PostgreSQL database
- `dblib` - for Microsoft SQL Server database
- `oci`   - for Oracle database

`[ Primary connection params ]` and `[ Secondary connection params ]`sections describes settings for first and second databases.

Where

`DATABASE_HOST` and `DATABASE_HOST_SECONDARY`  - database host name or IP for first and second server

`DATABASE_PORT` and `DATABASE_PORT_SECONDARY` - database port for first and second server

Default ports:

- `3306` - Mysql
- `5432` - PostgreSQL
- `1433` - MSSQL
- `1521` - Oracle

## 📋 Supported Databases

- ✅ **MySQL** - Full support with all object types
- ✅ **PostgreSQL** - Tables, views, functions, indexes
- ✅ **Microsoft SQL Server** - Use 'dblib' driver
- ✅ **Oracle** - Complete object comparison

## 🔧 Development

### Requirements
- PHP 7.4+
- PDO extension
- Database drivers (mysql, pgsql, sqlsrv, oci)

### Project Structure
```
ModernDBCompare/
├── index.php              # Main application
├── config-editor.php      # Web configuration editor
├── config.php             # Configuration handler
├── driver/                # Database drivers
│   ├── abstract.php
│   ├── mysql.php
│   ├── pgsql.php
│   ├── dblib.php
│   ├── sqlsrv.php
│   ├── mssql.php
│   └── oci.php
├── template/              # HTML templates
│   ├── compare.php
│   ├── error.php
│   └── rows.php
├── public/                # Static assets
│   ├── css/
│   └── js/
├── .environment.example   # Configuration template
├── server.sh             # Development server (Linux/Mac)
├── server.bat            # Development server (Windows)
└── README.md
```

## 🎨 Screenshots

### Modern Interface
Beautiful Bootstrap 5 interface with gradient themes and glass morphism effects.

### Configuration Editor
User-friendly web-based configuration with real-time validation.

### Database Comparison
Side-by-side comparison with color-coded differences and interactive sample data preview.

## 🙏 Credits

This project is an enhanced fork of [compalex](https://github.com/dkarpuk/compalex) with significant UI/UX improvements and new features.

### Original Project
- **Author**: Dmitriy Karpuk (dkarpuk)
- **Repository**: https://github.com/dkarpuk/compalex
- **License**: MIT

### Enhancements Added
- **Author**: Rohidtzz
- **Enhanced Features**:
  - Complete Bootstrap 5 UI overhaul
  - Web-based configuration editor
  - Responsive design with mobile support
  - Glass morphism and gradient themes
  - Modern animations and transitions
  - Built-in PHP server support
  - Enhanced error handling and user experience

## 📜 License

MIT License

Copyright (c) 2025 Rohidtzz

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

### Original License Notice

This project is based on compalex by Dmitriy Karpuk (dkarpuk).
Original project copyright (c) 2021, Levsha Dmitry.

## 🤝 Contributing

1. Fork the repository
2. Create feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open Pull Request

## 🔄 Changelog

### v2.0.0 (2025-10-08) - ModernDBCompare
- 🎨 Complete UI overhaul with Bootstrap 5
- ⚙️ Added web-based configuration editor
- 📱 Responsive design implementation
- 🚀 Built-in server scripts
- 🎪 Modern glass morphism design
- 📊 Enhanced sample data preview
- 🔧 Improved error handling

### v1.0.0 (Original Project)
- Basic database comparison functionality
- Multiple database driver support
- CLI-based configuration

---

**Made with ❤️ and Bootstrap 5**
	
