# White Label E-Commerce Platform

A complete white label e-commerce solution built with Laravel 11, featuring REST APIs, admin panel, and user-friendly frontend.

## 📋 Table of Contents
- [Features](#features)
- [Technology Stack](#technology-stack)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Setup](#database-setup)
- [Running the Application](#running-the-application)
- [API Documentation](#api-documentation)
- [Default Credentials](#default-credentials)
- [Project Structure](#project-structure)
- [Testing](#testing)

## ✨ Features

### User Website (Frontend)
- ✅ User Registration & Login
- ✅ Product Listing with Pagination
- ✅ Product Search and Filtering
- ✅ Product Detail Page
- ✅ Shopping Cart Management
- ✅ Checkout Process
- ✅ Dummy Payment System (Success/Failure Simulation)
- ✅ Order Confirmation

### User Dashboard
- ✅ Profile Management
- ✅ Order History
- ✅ Order Details View
- ✅ Order Tracking (Pending/Processing/Shipped/Delivered)
- ✅ Change Password

### Admin Panel
- ✅ Admin Login & Dashboard
- ✅ Analytics Dashboard (Users, Products, Orders Count)
- ✅ Category Management (CRUD)
- ✅ Product Management (CRUD with Image Upload)
- ✅ Order Management
- ✅ Update Order Status
- ✅ User Management
- ✅ White Label Settings (Logo, Site Name, Theme Colors)

### REST API
- ✅ JSON Responses
- ✅ Laravel Sanctum Authentication
- ✅ User Registration & Login
- ✅ Product Listing (with pagination)
- ✅ Product Details
- ✅ Cart Management
- ✅ Place Order
- ✅ Order History
- ✅ Order Tracking
- ✅ Proper HTTP Status Codes
- ✅ Comprehensive Error Handling

## 🛠 Technology Stack

- **Backend**: PHP 8.2+ with Laravel 11
- **Database**: MySQL 8.0+
- **API Authentication**: Laravel Sanctum
- **Frontend**: Blade Templates, Bootstrap 5, jQuery
- **Version Control**: Git

## 📦 Requirements

- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js & NPM (for asset compilation)
- Git

## 🚀 Installation

### Step 1: Clone the Repository

```bash
git clone <repository-url>
cd whitelabel-ecommerce
```

### Step 2: Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install NPM dependencies (if using Vite)
npm install
```

### Step 3: Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Configure Environment Variables

Edit `.env` file with your database credentials:

```env
APP_NAME="White Label E-Commerce"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=whitelabel_ecommerce
DB_USERNAME=root
DB_PASSWORD=your_password

# Sanctum Configuration
SANCTUM_STATEFUL_DOMAINS=localhost,localhost:8000,127.0.0.1,127.0.0.1:8000
```

## 💾 Database Setup

### Option 1: Using Migrations and Seeders (Recommended)

```bash
# Create database
mysql -u root -p -e "CREATE DATABASE whitelabel_ecommerce CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed
```

### Option 2: Using SQL File

```bash
# Import the database.sql file
mysql -u root -p whitelabel_ecommerce < database.sql
```

## 🏃 Running the Application

### Start Development Server

```bash
# Start Laravel development server
php artisan serve

# The application will be available at: http://localhost:8000
```

### Compile Assets (if needed)

```bash
# Development
npm run dev

# Production
npm run build
```

### Create Storage Link

```bash
php artisan storage:link
```

### Clear Cache (if needed)

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## 🔑 Default Credentials

### Admin Account
- **Email**: admin@example.com
- **Password**: password123

### Test User Account
- **Email**: user@example.com
- **Password**: password123

## 📚 API Documentation

### Base URL
```
http://localhost:8000/api
```

### Authentication

All protected endpoints require Bearer token authentication.

#### Register
```http
POST /api/register
Content-Type: application/json

{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "phone": "1234567890",
    "address": "123 Street",
    "city": "City",
    "state": "State",
    "zip_code": "12345"
}
```

**Response (201)**:
```json
{
    "success": true,
    "message": "User registered successfully",
    "data": {
        "user": { ... },
        "token": "1|abc123...",
        "token_type": "Bearer"
    }
}
```

#### Login
```http
POST /api/login
Content-Type: application/json

{
    "email": "user@example.com",
    "password": "password123"
}
```

**Response (200)**:
```json
{
    "success": true,
    "message": "Login successful",
    "data": {
        "user": { ... },
        "token": "2|def456...",
        "token_type": "Bearer"
    }
}
```

### Products

#### Get Products List
```http
GET /api/products?page=1&per_page=12&search=laptop&category_id=1
```

**Query Parameters**:
- `page` (optional): Page number for pagination
- `per_page` (optional): Items per page (default: 12)
- `search` (optional): Search by name, description, or SKU
- `category_id` (optional): Filter by category
- `min_price` (optional): Minimum price filter
- `max_price` (optional): Maximum price filter
- `sort_by` (optional): Sort field (default: created_at)
- `sort_order` (optional): asc or desc (default: desc)

**Response (200)**:
```json
{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "name": "Laptop Pro 15",
                "slug": "laptop-pro-15",
                "price": "1299.99",
                "sale_price": "1199.99",
                "stock": 50,
                "category": { ... }
            }
        ],
        "per_page": 12,
        "total": 100
    }
}
```

#### Get Product Details
```http
GET /api/products/{id}
```

**Response (200)**:
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Laptop Pro 15",
        "description": "...",
        "price": "1299.99",
        "sale_price": "1199.99",
        "stock": 50,
        "category": { ... }
    }
}
```

### Cart (Protected)

#### Get Cart
```http
GET /api/cart
Authorization: Bearer {token}
```

**Response (200)**:
```json
{
    "success": true,
    "data": {
        "items": [
            {
                "id": 1,
                "product_id": 5,
                "quantity": 2,
                "price": "49.99",
                "product": { ... }
            }
        ],
        "total": 99.98,
        "count": 1
    }
}
```

#### Add to Cart
```http
POST /api/cart
Authorization: Bearer {token}
Content-Type: application/json

{
    "product_id": 1,
    "quantity": 2
}
```

**Response (201)**:
```json
{
    "success": true,
    "message": "Product added to cart",
    "data": { ... }
}
```

#### Update Cart Item
```http
PUT /api/cart/{id}
Authorization: Bearer {token}
Content-Type: application/json

{
    "quantity": 3
}
```

#### Remove from Cart
```http
DELETE /api/cart/{id}
Authorization: Bearer {token}
```

**Response (200)**:
```json
{
    "success": true,
    "message": "Item removed from cart"
}
```

### Orders (Protected)

#### Get Order History
```http
GET /api/orders?page=1
Authorization: Bearer {token}
```

**Response (200)**:
```json
{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "order_number": "ORD-ABC123",
                "total_amount": "149.99",
                "status": "processing",
                "payment_status": "success",
                "created_at": "2024-01-15T10:30:00.000000Z",
                "order_items": [ ... ]
            }
        ]
    }
}
```

#### Place Order
```http
POST /api/orders
Authorization: Bearer {token}
Content-Type: application/json

{
    "shipping_address": "123 Main St",
    "shipping_city": "New York",
    "shipping_state": "NY",
    "shipping_zip": "10001",
    "payment_method": "cash_on_delivery",
    "notes": "Please call before delivery"
}
```

**Response (201)**:
```json
{
    "success": true,
    "message": "Order placed successfully",
    "data": {
        "id": 1,
        "order_number": "ORD-ABC123",
        "total_amount": "149.99",
        "status": "processing",
        "payment_status": "success",
        "order_items": [ ... ]
    }
}
```

#### Get Order Details
```http
GET /api/orders/{id}
Authorization: Bearer {token}
```

#### Track Order
```http
GET /api/orders/track/{orderNumber}
Authorization: Bearer {token}
```

**Response (200)**:
```json
{
    "success": true,
    "data": {
        "order": { ... },
        "tracking": {
            "pending": true,
            "processing": true,
            "shipped": false,
            "delivered": false
        }
    }
}
```

### Error Responses

**Validation Error (422)**:
```json
{
    "success": false,
    "message": "Validation error",
    "errors": {
        "email": ["The email field is required."]
    }
}
```

**Unauthorized (401)**:
```json
{
    "success": false,
    "message": "Unauthenticated"
}
```

**Not Found (404)**:
```json
{
    "success": false,
    "message": "Resource not found"
}
```

**Server Error (500)**:
```json
{
    "success": false,
    "message": "Internal server error"
}
```

## 📁 Project Structure

```
whitelabel-ecommerce/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin panel controllers
│   │   │   ├── Api/            # API controllers
│   │   │   └── Auth/           # Authentication controllers
│   │   └── Middleware/
│   └── Models/                 # Eloquent models
├── config/                     # Configuration files
├── database/
│   ├── migrations/             # Database migrations
│   └── seeders/                # Database seeders
├── public/                     # Public assets
│   ├── css/
│   ├── js/
│   └── uploads/                # Uploaded files
├── resources/
│   └── views/                  # Blade templates
│       ├── admin/              # Admin panel views
│       ├── auth/               # Authentication views
│       ├── layouts/            # Layout templates
│       └── user/               # User frontend views
├── routes/
│   ├── api.php                 # API routes
│   └── web.php                 # Web routes
├── storage/                    # Storage directory
├── .env.example                # Environment template
├── composer.json               # PHP dependencies
└── database.sql                # Database SQL dump
```

## 🧪 Testing

### Run Tests
```bash
php artisan test
```

### Test API with Postman

1. Import the Postman collection (if provided)
2. Set environment variable `base_url` to `http://localhost:8000/api`
3. After login, set `token` variable with the received Bearer token
4. Test all endpoints

### Manual Testing Checklist

#### User Flow:
- [ ] Register new user
- [ ] Login with user credentials
- [ ] Browse products
- [ ] Search and filter products
- [ ] View product details
- [ ] Add products to cart
- [ ] Update cart quantities
- [ ] Remove items from cart
- [ ] Complete checkout
- [ ] View order history
- [ ] Track order status
- [ ] Update profile
- [ ] Change password

#### Admin Flow:
- [ ] Login as admin
- [ ] View dashboard analytics
- [ ] Create/Edit/Delete categories
- [ ] Create/Edit/Delete products
- [ ] Upload product images
- [ ] View all orders
- [ ] Update order status
- [ ] View user list
- [ ] Update white label settings
- [ ] Change site name and colors
- [ ] Upload logo

## 🔧 Troubleshooting

### Common Issues

**1. Database Connection Error**
```bash
# Check MySQL is running
sudo service mysql status

# Verify database credentials in .env
DB_USERNAME=root
DB_PASSWORD=your_password
```

**2. Storage Permission Error**
```bash
# Fix storage permissions
chmod -R 775 storage bootstrap/cache
```

**3. Class Not Found Error**
```bash
# Clear and regenerate autoload files
composer dump-autoload
php artisan config:clear
```

**4. CORS Issues with API**
```bash
# Publish CORS config
php artisan vendor:publish --tag=cors

# Update config/cors.php if needed
```

**5. Token Mismatch Error**
```bash
# Clear all caches
php artisan optimize:clear
```

## 📝 Additional Notes

### White Label Configuration
- Access admin panel to customize branding
- Upload custom logo
- Change site name
- Customize primary and secondary colors
- All changes reflect immediately on frontend

### Payment System
- Currently implements dummy payment (50% success rate)
- To integrate real payment gateway:
  1. Install payment gateway SDK
  2. Update OrderController payment logic
  3. Handle payment callbacks
  4. Update order status accordingly

### Image Upload
- Product images stored in `public/uploads/products/`
- Maximum upload size: 2MB (configurable in php.ini)
- Supported formats: JPG, PNG, GIF, WebP

### Security Features
- Password hashing with bcrypt
- CSRF protection on all forms
- SQL injection prevention via Eloquent ORM
- XSS protection
- API rate limiting
- Sanctum token authentication

## 📄 License

This project is open-source and available under the MIT License.

## 👥 Support

For issues and questions:
- Create an issue in the repository
- Email: support@example.com

## 🎯 Future Enhancements

- [ ] Email notifications
- [ ] Advanced product search (Elasticsearch)
- [ ] Product reviews and ratings
- [ ] Wishlist functionality
- [ ] Coupon/discount system
- [ ] Multi-currency support
- [ ] Real payment gateway integration
- [ ] PWA support
- [ ] Advanced analytics dashboard
- [ ] Export orders to CSV/PDF
- [ ] Inventory management
- [ ] Multi-vendor support

---

**Version**: 1.0.0  
**Last Updated**: February 2024  
**Built with**: Laravel 11 ❤️
