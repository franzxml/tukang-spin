import { sql } from '@/lib/db';
import { NextResponse } from 'next/server';
import bcrypt from 'bcryptjs';

export async function POST(request: Request) {
  try {
    const body = await request.json();
    const { username, recoveryCode, newPassword } = body;

    // Validation
    if (!username || !recoveryCode || !newPassword) {
      return NextResponse.json(
        { error: 'Username, kode recovery, dan password baru wajib diisi' },
        { status: 400 }
      );
    }

    if (!/^\d{5}$/.test(recoveryCode)) {
      return NextResponse.json(
        { error: 'Kode recovery harus 5 digit angka' },
        { status: 400 }
      );
    }

    if (newPassword.length < 6) {
      return NextResponse.json(
        { error: 'Password minimal 6 karakter' },
        { status: 400 }
      );
    }

    // Check if user exists with matching recovery code
    const users = await sql`
      SELECT id, username, recovery_code FROM users
      WHERE username = ${username} AND recovery_code = ${recoveryCode}
    `;

    if (users.length === 0) {
      return NextResponse.json(
        { error: 'Username atau kode recovery tidak valid' },
        { status: 401 }
      );
    }

    const user = users[0];

    // Hash new password
    const saltRounds = 10;
    const passwordHash = await bcrypt.hash(newPassword, saltRounds);

    // Update user password
    await sql`
      UPDATE users
      SET password_hash = ${passwordHash}, updated_at = CURRENT_TIMESTAMP
      WHERE id = ${user.id}
    `;

    return NextResponse.json({
      success: true,
      message: 'Password berhasil direset'
    });

  } catch (error) {
    console.error('Forgot password error:', error);
    return NextResponse.json(
      {
        error: 'Terjadi kesalahan saat memproses permintaan',
        details: error instanceof Error ? error.message : 'Unknown error'
      },
      { status: 500 }
    );
  }
}
