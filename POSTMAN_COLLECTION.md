# Sirius Ecommerce API Postman Koleksiyonu

Aşağıda, projedeki temel API endpointleri ve örnek istek gövdeleri yer almaktadır. Tüm isteklerde `{{base_url}}` ve gerekliyse `{{token}}` değişkenlerini kendi ortamınıza göre ayarlayınız.

---

## Auth

### ➕ Kayıt Ol (Register)
- **Yöntem:** POST
- **Endpoint:** `/api/register`
- **Body:**
```json
{
  "name": "Test User",
  "email": "test@example.com",
  "password": "password",
  "password_confirmation": "password"
}
```

### 🔑 Giriş Yap (Login)
- **Yöntem:** POST
- **Endpoint:** `/api/login`
- **Body:**
```json
{
  "email": "test@example.com",
  "password": "password"
}
```

---

## Products

### 📦 Ürünleri Listele
- **Yöntem:** GET
- **Endpoint:** `/api/products`

### 📦 Ürün Detayı
- **Yöntem:** GET
- **Endpoint:** `/api/products/{id}`

---

## Cart

### ➕ Sepete Ürün Ekle
- **Yöntem:** POST
- **Endpoint:** `/api/cart`
- **Header:**
  - `Authorization: Bearer {{token}}`
- **Body:**
```json
{
  "product_id": 1,
  "quantity": 2
}
```

### 🛒 Sepet İçeriğini Listele
- **Yöntem:** GET
- **Endpoint:** `/api/cart`
- **Header:**
  - `Authorization: Bearer {{token}}`

---

## Orders

### 📝 Sipariş Oluştur
- **Yöntem:** POST
- **Endpoint:** `/api/orders`
- **Header:**
  - `Authorization: Bearer {{token}}`
- **Body:**
```json
{
  "address": "Test Mah. Test Cad. No:1"
}
```

### 📄 Siparişleri Listele
- **Yöntem:** GET
- **Endpoint:** `/api/orders`
- **Header:**
  - `Authorization: Bearer {{token}}`

---

## Değişkenler
- `{{base_url}}`: API ana adresi (örn: http://localhost:8000)
- `{{token}}`: Giriş yaptıktan sonra alınan Bearer Token

---

> Tüm endpointler için örnek istekleri Postman'a manuel olarak ekleyebilir veya bu dokümandan kopyalayarak kullanabilirsiniz. 