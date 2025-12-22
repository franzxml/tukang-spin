# Setup Guide - Genpedia

## Prerequisites

1. Node.js 18+ installed
2. Neon database account (https://console.neon.tech)
3. Environment variables configured

## Installation Steps

### 1. Install Dependencies

```bash
npm install
```

### 2. Configure Environment Variables

Copy `.env.example` to `.env.local` and fill in your Neon database connection string:

```bash
DATABASE_URL=postgresql://username:password@host.region.aws.neon.tech/dbname?sslmode=require
```

Your current connection string is already configured in `.env.local`.

### 3. Setup Database

Run the database setup to create the required tables:

**Option A: Via Browser (Easiest)**

1. Start the development server:
```bash
npm run dev
```

2. Open your browser and navigate to:
```
http://localhost:3000/api/setup-db
```

3. You should see a success message confirming the database tables were created.

**Option B: Via SQL File (Manual)**

You can also run the migration file manually through Neon's SQL editor:

1. Go to https://console.neon.tech
2. Select your database
3. Go to SQL Editor
4. Copy and paste the contents of `migrations/001_create_users_table.sql`
5. Run the query

### 4. Test the Setup

1. Visit http://localhost:3000 to see the login page
2. Click "Sign up" to create a new account
3. Fill in the registration form
4. After successful registration, you'll be redirected to login

## Project Structure

```
genpedia/
├── src/
│   ├── app/
│   │   ├── api/
│   │   │   ├── auth/
│   │   │   │   └── register/    # Registration API endpoint
│   │   │   ├── setup-db/        # Database setup endpoint
│   │   │   └── test-db/         # Test database connection
│   │   ├── signup/              # Sign up page
│   │   ├── layout.tsx           # Root layout
│   │   ├── page.tsx             # Home page (login)
│   │   └── globals.css          # Global styles
│   ├── components/
│   │   ├── Header.tsx           # Header component
│   │   ├── Footer.tsx           # Footer component
│   │   ├── LoginForm.tsx        # Login form
│   │   └── SignUpForm.tsx       # Sign up form
│   └── lib/
│       └── db.ts                # Database connection
├── migrations/
│   └── 001_create_users_table.sql  # Users table migration
├── .env.local                   # Environment variables (local)
├── .env.example                 # Environment variables template
└── package.json                 # Dependencies
```

## Database Schema

### Users Table

| Column | Type | Constraints |
|--------|------|-------------|
| id | SERIAL | PRIMARY KEY |
| username | VARCHAR(50) | UNIQUE, NOT NULL |
| email | VARCHAR(255) | UNIQUE, NOT NULL |
| password_hash | VARCHAR(255) | NOT NULL |
| full_name | VARCHAR(100) | NULL |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP |

**Indexes:**
- `idx_users_email` on `email`
- `idx_users_username` on `username`

**Triggers:**
- `update_users_updated_at` - Automatically updates `updated_at` on row update

## Features

### Current Features
- User registration with validation
- Password hashing using bcryptjs
- Database integration with Neon PostgreSQL
- Responsive UI with Tailwind CSS
- Form validation (client and server-side)

### Registration Validation Rules
- Username: 3-50 characters, alphanumeric and underscore only
- Email: Valid email format
- Password: Minimum 6 characters
- Username and email must be unique

## API Endpoints

### POST /api/auth/register
Register a new user account.

**Request Body:**
```json
{
  "username": "johndoe",
  "email": "john@example.com",
  "password": "password123",
  "fullName": "John Doe"
}
```

**Response (Success):**
```json
{
  "success": true,
  "message": "Registrasi berhasil",
  "user": {
    "id": 1,
    "username": "johndoe",
    "email": "john@example.com",
    "fullName": "John Doe",
    "createdAt": "2024-01-01T00:00:00.000Z"
  }
}
```

**Response (Error):**
```json
{
  "error": "Email sudah terdaftar"
}
```

### GET /api/setup-db
Setup database tables (run once).

### GET /api/test-db
Test database connection.

## Troubleshooting

### "Database belum disetup" Error
- Run the database setup: http://localhost:3000/api/setup-db

### "Username sudah digunakan" Error
- Try a different username

### "Email sudah terdaftar" Error
- This email is already registered. Try logging in or use a different email.

### Database Connection Error
- Verify your `DATABASE_URL` in `.env.local`
- Make sure your Neon database is active
- Check that `sslmode=require` is in the connection string

## Next Steps

1. Setup database by visiting `/api/setup-db`
2. Create your first account via the sign-up page
3. Implement login functionality (coming soon)
4. Add authentication middleware
5. Create protected routes

## Development

```bash
# Start development server
npm run dev

# Build for production
npm run build

# Start production server
npm start

# Run linter
npm run lint
```

## Security Notes

- Passwords are hashed using bcryptjs with 10 salt rounds
- Never commit `.env.local` to version control
- Always use HTTPS in production
- Implement rate limiting for API endpoints (recommended)
- Add CSRF protection (recommended)

## Support

For issues or questions:
- GitHub: @franzxml
- Instagram: @franzxml
