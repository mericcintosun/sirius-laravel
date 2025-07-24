# Sirius Ecommerce Laravel

Bu proje, Laravel ile geliştirilmiş basit bir e-ticaret API uygulamasıdır.

---

## 🚀 Projeyi Çalıştırma Adımları

1. **Depoyu klonlayın:**
   ```bash
   git clone <repo-url>
   cd sirius-ecommerce-laravel
   ```
2. **Bağımlılıkları yükleyin:**
   ```bash
   composer install
   npm install
   ```
3. **.env dosyasını oluşturun:**
   ```bash
   cp .env.example .env
   ```
4. **Uygulama anahtarını oluşturun:**
   ```bash
   php artisan key:generate
   ```
5. **Veritabanı ayarlarını yapın:**
   `.env` dosyasında veritabanı bilgilerinizi güncelleyin.
6. **Veritabanı migrasyonlarını ve seed işlemlerini çalıştırın:**
   ```bash
   php artisan migrate --seed
   ```
7. **Projeyi başlatın:**
   ```bash
   php artisan serve
   ```
8. **API'yi test etmek için Postman koleksiyonunu kullanabilirsiniz.**

---

## 🛠️ Kullanılan Teknolojiler

- PHP (Laravel Framework)
- MySQL (veya başka bir desteklenen veritabanı)
- Composer
- Node.js & NPM (ön yüz derleyici için)
- Sanctum (API authentication)

---

## 👤 Varsayılan Kullanıcı Bilgileri

Seed işlemiyle birlikte aşağıdaki kullanıcı otomatik olarak oluşturulur:

- **E-posta:** `user@example.com`
- **Şifre:** `password`

> Giriş yaptıktan sonra Bearer Token'ı kullanarak korumalı uç noktalara erişebilirsiniz.

---

## 📄 Ek Bilgiler

- API uç noktaları ve örnek istekler için `Postman` koleksiyonu kullanabilirsiniz.
- Geliştirme ortamında sorun yaşarsanız, öncelikle `php artisan migrate:fresh --seed` komutunu çalıştırarak veritabanını sıfırlayabilirsiniz.

## Admin Panel User Giriş Bilgileri
   - email: batin@gmail.com
   - password: batin123

