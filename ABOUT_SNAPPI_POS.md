# Snappi POS — Complete Application Overview

## What is Snappi POS?

Snappi POS is a **multi-tenant SaaS Point-of-Sale system** designed for restaurants. It enables restaurant owners to manage orders, menus, staff, inventory, payments, deliveries, and customers — all from one unified platform. The application supports multiple restaurants and branches under a single installation, making it suitable for both independent restaurants and multi-location chains.

---

## Architecture & Multi-Tenancy

### Hierarchy
```
Super Admin (Platform Owner)
  └── Restaurants (Tenants)
        └── Branches (Locations)
              └── Users (Staff)
```

- **Super Admin**: Manages the entire platform — creates restaurants, sets up billing packages, configures global settings.
- **Restaurant**: A single business entity (tenant). Has its own settings, branding, currency, timezone, and subscription plan.
- **Branch**: A physical location of a restaurant. All orders, inventory, and staff are scoped to a branch.
- **Users**: Staff members assigned to a branch with specific roles (Admin, Manager, Cashier, Waiter, Kitchen, Delivery).

Data isolation is enforced at the database level using global scopes — every query is automatically filtered by the current branch/restaurant context.

---

## Core Features

### 1. Point of Sale (POS)

The POS is the central hub where orders are taken. Staff can:

- Create new orders (Dine-in, Takeaway, Delivery)
- Add menu items with variations and modifiers (e.g., size, toppings)
- Apply discounts and extra charges
- Assign customers and tables
- Split bills between multiple parties
- Accept multiple payment methods per order
- Print receipts directly from the POS

**Order Lifecycle**:
```
Placed → Confirmed → Preparing → Ready for Pickup → Served/Delivered
                                                   → Out for Delivery → Delivered
                                                   → Cancelled (with reason)
```

---

### 2. Kitchen Order Tickets (KOT)

When an order is placed from the POS, a **Kitchen Order Ticket** is automatically generated and sent to the kitchen display or printer.

- KOTs are separate from the final bill — they only contain preparation instructions
- KOT items track individual preparation status
- Kitchen stations (KOT Places) can be configured for different prep areas (e.g., grill, bar, desserts)
- KOTs can be cancelled with recorded reasons
- Real-time updates push new KOTs to kitchen displays

---

### 3. Menu Management

Restaurants can build and manage their full menu:

- **Categories**: Organize items into groups (e.g., Appetizers, Main Course, Drinks)
- **Menu Items**: Each item has a name, price, description, image, and type (Veg/Non-veg/Egg)
- **Variations**: Size or portion options (e.g., Small, Medium, Large) with individual pricing
- **Modifiers**: Customizations customers can choose (e.g., Extra cheese, No onions)
- **Modifier Groups**: Logical grouping of modifiers (e.g., "Toppings", "Sauces")
- **Taxes**: Per-item tax configuration
- **Translations**: Menu items and modifiers can be translated into 20+ languages
- **Stock Status**: Mark items as in-stock or out-of-stock
- **Sorting**: Custom display order

---

### 4. Table & Dine-In Management

For dine-in restaurants:

- **Tables**: Define tables with names, seat count, and area assignment
- **Areas**: Group tables logically (Indoor, Outdoor, Rooftop, Bar, etc.)
- **QR Codes**: Auto-generated QR codes per table for contactless ordering
- **Table Ordering**: Customers scan a QR code and order directly from their phone — no app needed
- **Waiter Requests**: Customers can call a waiter directly from their table via the system
- **Reservations**: Accept table bookings with date/time selection and customer assignment

---

### 5. Customer Management

- Create and maintain customer profiles (name, email, phone)
- Track customer order history
- Manage multiple delivery addresses per customer
- Customer accounts with login/signup
- Customer-facing website for online ordering

---

### 6. Delivery Management

Full delivery workflow support:

- **Delivery Executives**: Register and manage delivery staff
- **Delivery Fee Configuration**:
  - Fixed fee
  - Distance-based fees with tiered pricing
  - Free delivery thresholds (by order amount or distance)
- **Delivery Radius**: Set maximum delivery distance
- **Order Tracking**: Track delivery status from dispatch to completion
- **Customer Addresses**: Stored with latitude/longitude for distance calculations

---

### 7. Inventory & Purchases

Stock management for ingredient and supply tracking:

- **Stock Tracking**: Per-branch inventory levels
- **Stock Movements**: Full audit trail of every stock change (purchases, sales, adjustments)
- **Purchases**: Record purchases from suppliers with cost tracking
- **Measurements**: Define units (kg, liters, pieces, etc.)
- **Low-Stock Alerts**: Dashboard notifications when items run low
- **Auto-Deduction**: Stock automatically decreases when orders are placed

---

### 8. Payment Processing

**6 Online Payment Gateways**:
| Gateway | Region |
|---------|--------|
| Stripe | Global (cards) |
| Razorpay | India (cards, UPI, wallets) |
| PayPal | International |
| Paystack | Africa |
| Flutterwave | Africa (multi-currency) |
| PayFast | South Africa |

**In-Person Payment Methods**:
- Cash
- Card (manual entry)
- UPI / QR code payments
- Custom offline payment methods (with approval workflow)

**Payment Features**:
- Multiple payments per order (split payment)
- Payment history and tracking
- Webhook handling for all gateways
- Predefined quick-select amounts
- Payment receipts

---

### 9. Reporting & Analytics

**Available Reports**:
- **Sales Report**: Revenue breakdown by date, item, and payment method
- **Item Report**: Per-item sales performance
- **Category Report**: Category-level sales analysis
- **Expense Report**: Expense tracking and trends
- **Outstanding Payments**: Unpaid orders tracking
- **Print Log**: History of all print jobs

**Dashboard Widgets**:
- Today's earnings, orders, customers, reservations
- Top-selling menu items
- Payment method breakdown
- Table earnings comparison
- Weekly sales chart
- Average daily earnings
- Low stock alerts
- Active waiter requests

**Exports**: Reports and data (customers, staff, payments) exportable to Excel.

---

### 10. Expense Tracking

- Create expense categories (Rent, Utilities, Supplies, etc.)
- Record expenses with amounts, dates, and receipts
- Track payment status (Pending / Paid)
- Due date management
- Receipt image upload for record-keeping

---

### 11. Printing & Receipts

**Printer Support**:
- Thermal printers: 58mm, 76mm, 80mm
- Network and USB connectivity
- ESC/POS command protocol
- Multiple printers per branch (e.g., one for receipts, one for kitchen)

**Desktop Printing App**:
- Native desktop application for Windows, macOS (Intel + Apple Silicon), and Linux
- Real-time print job distribution via Pusher
- Automatic print job pull/push mechanism
- Job status tracking (Pending, Completed, Failed)

**Receipt Customization**:
- Custom logo and branding
- Configurable footer text
- Show/hide tax details, payment info
- QR code on receipts
- Custom receipt templates

---

### 12. Real-Time Features (Pusher Integration)

- **Order Notifications**: Instant alerts when new orders are placed
- **Kitchen Display Updates**: New KOTs appear in real-time on kitchen screens
- **Customer Order Display**: Customers see live status updates
- **Print Job Distribution**: Print jobs sent instantly to the desktop app
- **Fallback**: Automatic polling fallback when Pusher is unavailable

---

### 13. Customer-Facing Website

Each restaurant gets a public-facing website where customers can:

- Browse the menu with item details and images
- Add items to cart and place orders
- Choose between delivery, takeaway, or dine-in
- Pay online using any configured payment gateway
- Create an account to save addresses and view order history
- Make table reservations
- Track active orders in real-time
- Leave reviews and ratings
- View restaurant info (About, Contact, Social links)
- Select their preferred language

---

### 14. Staff & Access Control

**Role-Based Access**:
- Admin, Manager, Cashier, Waiter, Kitchen, Delivery Executive
- Granular permissions per role (Spatie Permission system)
- Staff can be assigned to specific branches

**Staff Features**:
- User creation with role assignment
- Profile photos and contact details
- Activity tracking
- Two-Factor Authentication (2FA)

---

### 15. Subscription & Billing (Super Admin)

The platform supports SaaS billing for restaurant tenants:

- **Packages/Plans**: Free, Trial, Standard, Lifetime
- **Package Features**: Configure which features each plan includes
  - Change branch, Export reports, Table reservation, Payment gateway, Theme settings
- **Module Bundling**: Assign optional modules per package
- **Trial System**: Configurable trial period (days)
- **Subscription Management**: Track start/end dates, renewals
- **Offline Payments**: Manual payment approval workflow with invoice upload
- **Payment Gateway Webhooks**: Automated subscription activation

---

### 16. Localization & Languages

- **20+ Languages** supported (Arabic, English, and more)
- **RTL Support**: Right-to-left layout for Arabic and similar languages
- **Translatable Content**: Menu items, modifier groups, and UI elements
- **Customer Language Selection**: Customers choose their preferred language on the frontend
- **Translation Manager**: Admin interface for managing translations

---

### 17. Cloud Storage & File Management

Supports multiple storage backends:
- Local filesystem
- Amazon S3
- DigitalOcean Spaces
- Wasabi
- Any S3-compatible storage (MinIO, etc.)

Used for: menu item images, logos, receipt logos, expense receipts, user photos, QR codes.

---

### 18. Optional Modules (Plugin System)

The application uses a modular architecture allowing features to be enabled/disabled:

- Modules are built using **nwidart/laravel-modules**
- Can be bundled into subscription packages
- Super admin can verify and manage custom modules
- Known modules include: Kitchen Display, Inventory Management
- Each module can add its own routes, views, models, and permissions

---

### 19. Super Admin Panel

The platform owner has access to:

- **Restaurant Management**: Create, edit, suspend restaurants
- **Package Management**: Define subscription plans and features
- **Billing & Invoicing**: Track all restaurant payments
- **Global Settings**: App version, domain, branding, SEO
- **Landing Pages**: Customizable marketing pages
- **Module Management**: Upload, verify, and distribute modules
- **Payment Gateway Configuration**: Setup platform-level payment credentials
- **Desktop App Management**: Version control and download links

---

### 20. Additional Features

| Feature | Description |
|---------|-------------|
| **QR Codes** | Auto-generated for branches and tables |
| **Bill Splitting** | Split a single order between multiple parties |
| **Order Tips** | Customers can add tips to orders |
| **PWA Support** | Progressive Web App install prompts |
| **Email Notifications** | Configurable SMTP with event-based triggers |
| **API Access** | Laravel Sanctum token-based API |
| **Onboarding Wizard** | Step-by-step setup for new restaurants |
| **Theme Customization** | UI color/branding settings per restaurant |
| **Social Media Links** | Yelp, and other platform integration |
| **SEO Settings** | Meta tags and descriptions for customer site |
| **Contact Forms** | Customer inquiry submissions |

---

## Technology Stack

| Layer | Technology |
|-------|-----------|
| Backend Framework | Laravel 12 |
| Frontend Components | Livewire 3 + Alpine.js |
| CSS Framework | Tailwind CSS 3 |
| Authentication | Laravel Jetstream (Fortify + Sanctum) |
| Permissions | Spatie Laravel Permission |
| Real-Time | Pusher Channels |
| Module System | nwidart/laravel-modules |
| PDF Generation | dompdf |
| Excel Export | Maatwebsite/Laravel-Excel |
| QR Codes | Endroid/QR Code |
| File Storage | Laravel Filesystem (S3 compatible) |
| Database | MySQL |
| Build Tools | Vite |

---

## Summary

Snappi POS is a comprehensive, production-ready restaurant management platform that covers the entire restaurant operation lifecycle — from menu setup and order-taking to kitchen management, delivery, inventory, payments, and analytics. Its multi-tenant architecture makes it suitable as a SaaS product serving hundreds of restaurants, each with their own branches, staff, and customers.
