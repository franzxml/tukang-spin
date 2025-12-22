import { sql } from '@/lib/db';
import { NextResponse } from 'next/server';
import bcrypt from 'bcryptjs';

export async function POST(request: Request) {
  try {
    const body = await request.json();
    const { username, password, recoveryCode } = body;

    // Validation
    if (!username || !password || !recoveryCode) {
      return NextResponse.json(
        { error: 'Username, password, dan kode recovery wajib diisi' },
        { status: 400 }
      );
    }

    // Validate recovery code (5 digits)
    if (!/^\d{5}$/.test(recoveryCode)) {
      return NextResponse.json(
        { error: 'Kode recovery harus 5 digit angka' },
        { status: 400 }
      );
    }

    // Validate username (alphanumeric and underscore only)
    const usernameRegex = /^[a-zA-Z0-9_]+$/;
    if (!usernameRegex.test(username)) {
      return NextResponse.json(
        { error: 'Username hanya boleh berisi huruf, angka, dan underscore' },
        { status: 400 }
      );
    }

    if (username.length < 3 || username.length > 50) {
      return NextResponse.json(
        { error: 'Username harus 3-50 karakter' },
        { status: 400 }
      );
    }

    if (password.length < 6) {
      return NextResponse.json(
        { error: 'Password minimal 6 karakter' },
        { status: 400 }
      );
    }

    // Check if username already exists
    const existingUsername = await sql`
      SELECT id FROM users WHERE username = ${username}
    `;

    if (existingUsername.length > 0) {
      return NextResponse.json(
        { error: 'Username sudah digunakan' },
        { status: 409 }
      );
    }

    // Hash password
    const saltRounds = 10;
    const passwordHash = await bcrypt.hash(password, saltRounds);

    // Generate a unique email based on username
    const email = `${username}@genpedia.local`;

    // Insert new user
    const result = await sql`
      INSERT INTO users (username, email, password_hash, full_name, recovery_code)
      VALUES (${username}, ${email}, ${passwordHash}, null, ${recoveryCode})
      RETURNING id, username, created_at
    `;

    const user = result[0];

    return NextResponse.json(
      {
        success: true,
        message: 'Registrasi berhasil',
        user: {
          id: user.id,
          username: user.username,
          createdAt: user.created_at
        }
      },
      { status: 201 }
    );

  } catch (error) {
    console.error('Registration error:', error);

    // Check if it's a database error
    if (error instanceof Error && error.message.includes('relation "users" does not exist')) {
      return NextResponse.json(
        { error: 'Database belum disetup. Jalankan migrasi terlebih dahulu.' },
        { status: 500 }
      );
    }

    return NextResponse.json(
      {
        error: 'Terjadi kesalahan saat registrasi',
        details: error instanceof Error ? error.message : 'Unknown error'
      },
      { status: 500 }
    );
  }
}
