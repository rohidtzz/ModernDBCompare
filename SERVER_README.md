# ModernDBCompare Built-in Server

ModernDBCompare sekarang dilengkapi dengan server built-in PHP dan editor konfigurasi web untuk kemudahan penggunaan development.

## 🚀 Cara Menjalankan Server

### Linux/Mac:
```bash
./server.sh [port]
```

### Windows:
```cmd
server.bat [port]
```

**Port default: 8000**

Contoh:
```bash
# Menggunakan port default (8000)
./server.sh

# Menggunakan port custom
./server.sh 3000
```

## 🌐 Akses Aplikasi

Setelah server berjalan, Anda dapat mengakses:

- **Aplikasi utama**: http://localhost:8000
- **Editor konfigurasi**: http://localhost:8000/config-editor.php

## ⚙️ Editor Konfigurasi Web

Editor konfigurasi memungkinkan Anda untuk:

- ✅ Mengedit semua parameter database via web interface
- ✅ Mengubah driver database (MySQL, PostgreSQL, SQL Server, Oracle)
- ✅ Mengatur koneksi primary dan secondary database
- ✅ Menyimpan konfigurasi secara real-time
- ✅ Interface yang user-friendly dengan validasi form

### Fitur Editor:
1. **Main Settings**: Driver database, encoding, sample data length
2. **Primary Database**: Host, port, database name, credentials, description
3. **Secondary Database**: Host, port, database name, credentials, description

## 🔧 Otomatisasi Setup

Script server akan otomatis:
- ✅ Mengecek instalasi PHP
- ✅ Memverifikasi file konfigurasi
- ✅ Membuat `.environment` dari `.environment.example` jika belum ada
- ✅ Memberikan informasi akses yang jelas

## 📝 File Konfigurasi

- `.environment` - File konfigurasi aktual (tidak di-commit ke git)
- `.environment.example` - Template konfigurasi (di-commit ke git)

## 🛑 Menghentikan Server

Tekan `Ctrl+C` di terminal untuk menghentikan server.

## 💡 Tips

1. **Development**: Gunakan server built-in untuk development dan testing
2. **Production**: Gunakan web server proper (Apache/Nginx) untuk production
3. **Port**: Jika port 8000 sudah digunakan, gunakan port lain (misal: 3000, 8080)
4. **Konfigurasi**: Edit konfigurasi melalui web interface lebih mudah daripada edit file manual

## 🔐 Keamanan

⚠️ **Peringatan**: Server built-in PHP hanya untuk development. Jangan gunakan untuk production karena alasan keamanan.