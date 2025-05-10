# User Authentication System & CRUD leave request

## Overview
This project is a **User Authentication System** built with Laravel, including **API endpoints** for user registration, login, logout, profile management, and a **CRUD Leave request**.
## Features
### 1. **User Authentication**
- User **registration** with email verification.
- Secure **login** and **logout**.
- Profile management (update name, email, and password).
- Password hashing for security.
- Reset password by email

### 2. **CRUD Note Application**
- Users can **create, read, update, and delete** their own notes.
- Notes are private; each user can only access their notes.

### 3. **Security Measures**
- CSRF protection for web forms.
- Input validation to prevent SQL injection & XSS attacks.
- Secure password storage using Laravel's hashing mechanism.
- Using Gate and Policies for authentication to prevent users from editing other users' data.
  

### 4. **Api **
- Clean and structured code.
- Using Sanctum for authentication.
- Auth token is shared across all Postman requests using a script to make it easy to use.
- Using the Resource interface to customize controller responses.
  


## Installation



### 2. **Install dependencies**
```sh
composer install
npm install
```

### 3. **Environment Setup**
- Copy `.env.example` to `.env`
```sh
cp .env.example .env
```
- Generate application key:
```sh
php artisan key:generate
```
- Set up your **database credentials** in the `.env` file.

### 4. **Run Database Migrations**
```sh
php artisan migrate --seed
```

### 5. **Run the Development Server**
```sh
php artisan serve
npm run dev
```

## API Documentation
### **1. Authentication Endpoints**
| Method | Endpoint           | Description        |
|--------|------------------|------------------|
| POST   | `/api/register`   | Register a new user |
| POST   | `/api/login`      | Authenticate user |
| POST   | `/api/logout`     | Logout user (requires token) |
| POST   | `/api/profile`    | Update profile (requires token) |
| GET    | `/api/profile`    | GET profile (requires token) |
| post   | `/api/forgetpassword`    |send mail to reset password (require mail) |
| post   | `/api/resetpassword`    | reset password with new  (requires token,email,password,password_confirmation) |

### **2. Leave request API**
| Method | Endpoint           | Description        |
|--------|------------------|------------------|
| GET    | `/api/request/leave`      | Get all awn requests|
| GET    | `/api/request/leave/{id}`      | Get all specifice request |
| POST   | `/api/request/leave`      | Create new request |
| POST   | `/api/request/leave/allreviews`      | get all request for manager to review|
| POST   | `/api/request/leave/review/{id}`      |approve or reject the  request|
| POST   | `/api/request/leave/hr/` | if approve it can be  seen by hr |

## Testing
- Use **Postman** to test API endpoints. A Postman collection is provided in `leave_request.postman_collection.json` with the code .
- auth token  is update  automatically and shared across all pages in postman .



#### api notification

<img src="https://github.com/ahmedessawy10/vodoTask/blob/main/public/images/mail notification.png?raw=true">



#### Reset password by mail 

<img src="https://github.com/ahmedessawy10/vodoTask/blob/main/public/images/resetpasswordbymail.png?raw=true">
Happy Coding! 🚀

