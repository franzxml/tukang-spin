# Genpedia

Next.js application with Neon Database integration.

## Setup

1. Install dependencies:
```bash
npm install
```

2. Setup Neon Database:
   - Create a new project at [Neon Console](https://console.neon.tech)
   - Copy the connection string from your Neon dashboard
   - Create `.env.local` file and add your connection string:
   ```
   DATABASE_URL=your_neon_connection_string
   ```

3. Run the development server:
```bash
npm run dev
```

4. Test database connection:
   - Open [http://localhost:3000/api/test-db](http://localhost:3000/api/test-db) in your browser
   - You should see a success message with the PostgreSQL version

## Project Structure

- `/src/app` - Next.js app router pages and API routes
- `/src/lib` - Utility functions and database connection
- `/src/components` - React components (to be added)

## Database Connection

The database connection is configured in `src/lib/db.ts` using `@neondatabase/serverless` package. This package is optimized for serverless environments and works perfectly with Next.js.

## API Routes

- `/api/test-db` - Test endpoint to verify database connection

## Learn More

- [Next.js Documentation](https://nextjs.org/docs)
- [Neon Documentation](https://neon.tech/docs)
- [Deploy on Vercel](https://vercel.com/docs)
