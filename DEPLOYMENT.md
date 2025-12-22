# Deployment Guide - Vercel + Neon Database

## Prerequisites
- GitHub account
- Vercel account (sign up at https://vercel.com)
- Neon database already created

## Step 1: Push Code to GitHub

```bash
git add .
git commit -m "Initial commit"
git push origin main
```

## Step 2: Deploy to Vercel

### Option A: Via Vercel Dashboard (Recommended)

1. Go to https://vercel.com/new
2. Import your GitHub repository (genpedia)
3. Configure project:
   - Framework Preset: Next.js (auto-detected)
   - Root Directory: ./
   - Build Command: `npm run build`
   - Output Directory: .next

4. Add Environment Variable:
   - Click "Environment Variables"
   - Add the following:
     - **Name:** `DATABASE_URL`
     - **Value:** `postgresql://neondb_owner:npg_bB6rvEGoxJ9k@ep-ancient-sky-a185lvkw-pooler.ap-southeast-1.aws.neon.tech/neondb?sslmode=require`
   - Select all environments (Production, Preview, Development)

5. Click "Deploy"

### Option B: Via Vercel CLI

```bash
# Install Vercel CLI
npm i -g vercel

# Login to Vercel
vercel login

# Deploy
vercel

# Set environment variable
vercel env add DATABASE_URL
# Paste the connection string when prompted:
# postgresql://neondb_owner:npg_bB6rvEGoxJ9k@ep-ancient-sky-a185lvkw-pooler.ap-southeast-1.aws.neon.tech/neondb?sslmode=require

# Deploy to production
vercel --prod
```

## Step 3: Verify Deployment

After deployment completes:

1. Visit your deployment URL (e.g., `https://genpedia.vercel.app`)
2. Test the database connection: `https://your-app.vercel.app/api/test-db`
3. You should see a success message with PostgreSQL version

## Environment Variables

The following environment variable is required:

| Variable | Description | Example |
|----------|-------------|---------|
| `DATABASE_URL` | Neon PostgreSQL connection string | `postgresql://user:pass@host/db?sslmode=require` |

## Troubleshooting

### Database Connection Error

If you get a database connection error:
- Verify the `DATABASE_URL` is correctly set in Vercel dashboard
- Check that Neon database is active
- Ensure `sslmode=require` is in the connection string

### Build Failed

If build fails:
- Check build logs in Vercel dashboard
- Ensure all dependencies are in `package.json`
- Verify TypeScript types are correct

## Updates

To deploy updates:

```bash
git add .
git commit -m "Your update message"
git push origin main
```

Vercel will automatically deploy when you push to main branch.

## Neon Database Info

- Host: `ep-ancient-sky-a185lvkw-pooler.ap-southeast-1.aws.neon.tech`
- Database: `neondb`
- User: `neondb_owner`
- Region: `ap-southeast-1` (Singapore)

## Links

- Vercel Dashboard: https://vercel.com/dashboard
- Neon Console: https://console.neon.tech
- GitHub Repository: https://github.com/franzxml/genpedia (adjust as needed)
