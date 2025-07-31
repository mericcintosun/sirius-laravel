# Railway Deployment Guide

Bu Laravel projesini Railway'de deploy etmek için aşağıdaki adımları takip edin:

## 1. Railway Hesabı Oluşturma
- [Railway.app](https://railway.app) adresine gidin
- GitHub hesabınızla giriş yapın

## 2. Yeni Proje Oluşturma
- Railway dashboard'da "New Project" butonuna tıklayın
- "Deploy from GitHub repo" seçeneğini seçin
- Bu repository'yi seçin

## 3. Environment Variables Ayarlama
Railway dashboard'da aşağıdaki environment variables'ları ekleyin:

```
APP_NAME="Sirius Ecommerce"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app-name.railway.app

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=${MYSQL_HOST}
DB_PORT=${MYSQL_PORT}
DB_DATABASE=${MYSQL_DATABASE}
DB_USERNAME=${MYSQL_USERNAME}
DB_PASSWORD=${MYSQL_PASSWORD}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## 4. MySQL Database Ekleme
- Railway dashboard'da "New" butonuna tıklayın
- "Database" seçeneğini seçin
- MySQL database'i ekleyin
- Railway otomatik olarak environment variables'ları ayarlayacaktır

## 5. Deployment
- Railway otomatik olarak projenizi deploy edecektir
- Build tamamlandıktan sonra uygulamanız hazır olacaktır

## 6. İlk Kurulum
Deployment tamamlandıktan sonra Railway terminal'inde şu komutları çalıştırın:

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
```

## 7. Filament Admin Panel
Admin paneline erişmek için:
- `https://your-app-name.railway.app/admin` adresine gidin
- İlk kullanıcıyı oluşturmak için terminal'de şu komutu çalıştırın:
```bash
php artisan make:filament-user
```

## 8. API Endpoints
API endpoint'leri şu adreste erişilebilir:
- `https://your-app-name.railway.app/api`

## Sorun Giderme
- Logs'ları Railway dashboard'dan kontrol edin
- Environment variables'ların doğru ayarlandığından emin olun
- Database bağlantısını kontrol edin 