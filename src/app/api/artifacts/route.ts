import { sql } from '@/lib/db';
import { NextResponse } from 'next/server';

// Get all artifacts for a user
export async function GET(request: Request) {
  try {
    const { searchParams } = new URL(request.url);
    const userId = searchParams.get('userId');

    if (!userId) {
      return NextResponse.json(
        { error: 'User ID diperlukan' },
        { status: 400 }
      );
    }

    const artifacts = await sql`
      SELECT id, name, set_name, rarity, main_stat, sub_stats, slot_type, created_at, updated_at
      FROM artifacts
      WHERE user_id = ${userId}
      ORDER BY created_at DESC
    `;

    return NextResponse.json({
      success: true,
      artifacts
    });

  } catch (error) {
    console.error('Get artifacts error:', error);
    return NextResponse.json(
      {
        error: 'Terjadi kesalahan saat mengambil data artifak',
        details: error instanceof Error ? error.message : 'Unknown error'
      },
      { status: 500 }
    );
  }
}

// Create a new artifact
export async function POST(request: Request) {
  try {
    const body = await request.json();
    const { userId, name, setName, rarity, mainStat, subStats, slotType } = body;

    // Validation
    if (!userId) {
      return NextResponse.json(
        { error: 'User ID diperlukan' },
        { status: 400 }
      );
    }

    if (!name || name.trim().length === 0) {
      return NextResponse.json(
        { error: 'Nama artifak wajib diisi' },
        { status: 400 }
      );
    }

    if (name.length > 100) {
      return NextResponse.json(
        { error: 'Nama artifak maksimal 100 karakter' },
        { status: 400 }
      );
    }

    // Insert artifact
    const result = await sql`
      INSERT INTO artifacts (user_id, name, set_name, rarity, main_stat, sub_stats, slot_type)
      VALUES (${userId}, ${name}, ${setName || null}, ${rarity || null}, ${mainStat || null}, ${subStats || null}, ${slotType || null})
      RETURNING id, name, set_name, rarity, main_stat, sub_stats, slot_type, created_at, updated_at
    `;

    return NextResponse.json({
      success: true,
      message: 'Artifak berhasil ditambahkan',
      artifact: result[0]
    });

  } catch (error) {
    console.error('Create artifact error:', error);
    return NextResponse.json(
      {
        error: 'Terjadi kesalahan saat menambahkan artifak',
        details: error instanceof Error ? error.message : 'Unknown error'
      },
      { status: 500 }
    );
  }
}
