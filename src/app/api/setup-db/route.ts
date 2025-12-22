import { sql } from '@/lib/db';
import { NextResponse } from 'next/server';

export async function GET() {
  try {
    // Create users table
    await sql`
      CREATE TABLE IF NOT EXISTS users (
        id SERIAL PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        password_hash VARCHAR(255) NOT NULL,
        full_name VARCHAR(100),
        recovery_code VARCHAR(5),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      )
    `;

    // Create indexes
    await sql`
      CREATE INDEX IF NOT EXISTS idx_users_email ON users(email)
    `;

    await sql`
      CREATE INDEX IF NOT EXISTS idx_users_username ON users(username)
    `;

    await sql`
      CREATE INDEX IF NOT EXISTS idx_users_recovery_code ON users(recovery_code)
    `;

    // Create or replace the updated_at trigger function
    await sql`
      CREATE OR REPLACE FUNCTION update_updated_at_column()
      RETURNS TRIGGER AS $$
      BEGIN
        NEW.updated_at = CURRENT_TIMESTAMP;
        RETURN NEW;
      END;
      $$ LANGUAGE plpgsql
    `;

    // Drop trigger if exists and create new one
    await sql`
      DROP TRIGGER IF EXISTS update_users_updated_at ON users
    `;

    await sql`
      CREATE TRIGGER update_users_updated_at
      BEFORE UPDATE ON users
      FOR EACH ROW
      EXECUTE FUNCTION update_updated_at_column()
    `;

    // Create password_reset_tokens table
    await sql`
      CREATE TABLE IF NOT EXISTS password_reset_tokens (
        id SERIAL PRIMARY KEY,
        user_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
        token VARCHAR(255) UNIQUE NOT NULL,
        expires_at TIMESTAMP NOT NULL,
        used BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      )
    `;

    // Create indexes for password_reset_tokens
    await sql`
      CREATE INDEX IF NOT EXISTS idx_password_reset_tokens_token ON password_reset_tokens(token)
    `;

    await sql`
      CREATE INDEX IF NOT EXISTS idx_password_reset_tokens_user_id ON password_reset_tokens(user_id)
    `;

    // Create characters table
    await sql`
      CREATE TABLE IF NOT EXISTS characters (
        id SERIAL PRIMARY KEY,
        user_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
        name VARCHAR(100) NOT NULL,
        level INTEGER,
        weapon_type VARCHAR(50),
        weapon_name VARCHAR(100),
        artifact VARCHAR(100),
        normal_attack_level INTEGER,
        elemental_skill_level INTEGER,
        elemental_burst_level INTEGER,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      )
    `;

    // Create indexes for characters
    await sql`
      CREATE INDEX IF NOT EXISTS idx_characters_user_id ON characters(user_id)
    `;

    await sql`
      CREATE INDEX IF NOT EXISTS idx_characters_name ON characters(name)
    `;

    // Drop trigger if exists and create new one for characters
    await sql`
      DROP TRIGGER IF EXISTS update_characters_updated_at ON characters
    `;

    await sql`
      CREATE TRIGGER update_characters_updated_at
      BEFORE UPDATE ON characters
      FOR EACH ROW
      EXECUTE FUNCTION update_updated_at_column()
    `;

    // Create weapons table
    await sql`
      CREATE TABLE IF NOT EXISTS weapons (
        id SERIAL PRIMARY KEY,
        user_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
        name VARCHAR(100) NOT NULL,
        type VARCHAR(50),
        rarity INTEGER,
        base_attack INTEGER,
        secondary_stat VARCHAR(100),
        passive_ability TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      )
    `;

    // Create indexes for weapons
    await sql`
      CREATE INDEX IF NOT EXISTS idx_weapons_user_id ON weapons(user_id)
    `;

    await sql`
      CREATE INDEX IF NOT EXISTS idx_weapons_name ON weapons(name)
    `;

    // Drop trigger if exists and create new one for weapons
    await sql`
      DROP TRIGGER IF EXISTS update_weapons_updated_at ON weapons
    `;

    await sql`
      CREATE TRIGGER update_weapons_updated_at
      BEFORE UPDATE ON weapons
      FOR EACH ROW
      EXECUTE FUNCTION update_updated_at_column()
    `;

    // Create artifacts table
    await sql`
      CREATE TABLE IF NOT EXISTS artifacts (
        id SERIAL PRIMARY KEY,
        user_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
        name VARCHAR(100) NOT NULL,
        set_name VARCHAR(100),
        rarity INTEGER,
        main_stat VARCHAR(100),
        sub_stats TEXT,
        slot_type VARCHAR(50),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      )
    `;

    // Create indexes for artifacts
    await sql`
      CREATE INDEX IF NOT EXISTS idx_artifacts_user_id ON artifacts(user_id)
    `;

    await sql`
      CREATE INDEX IF NOT EXISTS idx_artifacts_name ON artifacts(name)
    `;

    // Drop trigger if exists and create new one for artifacts
    await sql`
      DROP TRIGGER IF EXISTS update_artifacts_updated_at ON artifacts
    `;

    await sql`
      CREATE TRIGGER update_artifacts_updated_at
      BEFORE UPDATE ON artifacts
      FOR EACH ROW
      EXECUTE FUNCTION update_updated_at_column()
    `;

    return NextResponse.json({
      success: true,
      message: 'Database setup berhasil. Tabel users, password_reset_tokens, characters, weapons, dan artifacts telah dibuat.'
    });

  } catch (error) {
    console.error('Database setup error:', error);
    return NextResponse.json(
      {
        success: false,
        error: 'Gagal setup database',
        details: error instanceof Error ? error.message : 'Unknown error'
      },
      { status: 500 }
    );
  }
}
