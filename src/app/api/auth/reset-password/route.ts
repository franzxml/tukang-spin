import { sql } from '@/lib/db';
import { NextResponse } from 'next/server';
import bcrypt from 'bcryptjs';

export async function POST(request: Request) {
  try {
    const body = await request.json();
    const { token, password } = body;

    if (!token || !password) {
      return NextResponse.json(
        { error: 'Token dan password wajib diisi' },
        { status: 400 }
      );
    }

    if (password.length < 6) {
      return NextResponse.json(
        { error: 'Password minimal 6 karakter' },
        { status: 400 }
      );
    }

    // Find valid reset token
    const resetTokens = await sql`
      SELECT id, user_id, expires_at, used
      FROM password_reset_tokens
      WHERE token = ${token}
    `;

    if (resetTokens.length === 0) {
      return NextResponse.json(
        { error: 'Token reset password tidak valid' },
        { status: 400 }
      );
    }

    const resetToken = resetTokens[0];

    // Check if token is already used
    if (resetToken.used) {
      return NextResponse.json(
        { error: 'Token sudah digunakan' },
        { status: 400 }
      );
    }

    // Check if token is expired
    const now = new Date();
    const expiresAt = new Date(resetToken.expires_at);

    if (now > expiresAt) {
      return NextResponse.json(
        { error: 'Token sudah kadaluarsa' },
        { status: 400 }
      );
    }

    // Hash new password
    const saltRounds = 10;
    const passwordHash = await bcrypt.hash(password, saltRounds);

    // Update user password
    await sql`
      UPDATE users
      SET password_hash = ${passwordHash}, updated_at = CURRENT_TIMESTAMP
      WHERE id = ${resetToken.user_id}
    `;

    // Mark token as used
    await sql`
      UPDATE password_reset_tokens
      SET used = true
      WHERE id = ${resetToken.id}
    `;

    return NextResponse.json({
      success: true,
      message: 'Password berhasil direset'
    });

  } catch (error) {
    console.error('Reset password error:', error);
    return NextResponse.json(
      {
        error: 'Terjadi kesalahan saat reset password',
        details: error instanceof Error ? error.message : 'Unknown error'
      },
      { status: 500 }
    );
  }
}
