import { sql } from '@/lib/db';
import { NextResponse } from 'next/server';

// Get all weapons for a user
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

    const weapons = await sql`
      SELECT id, name, type, rarity, base_attack, secondary_stat, passive_ability, created_at, updated_at
      FROM weapons
      WHERE user_id = ${userId}
      ORDER BY created_at DESC
    `;

    return NextResponse.json({
      success: true,
      weapons
    });

  } catch (error) {
    console.error('Get weapons error:', error);
    return NextResponse.json(
      {
        error: 'Terjadi kesalahan saat mengambil data senjata',
        details: error instanceof Error ? error.message : 'Unknown error'
      },
      { status: 500 }
    );
  }
}

// Create a new weapon
export async function POST(request: Request) {
  try {
    const body = await request.json();
    const { userId, name, type, rarity, baseAttack, secondaryStat, passiveAbility } = body;

    // Validation
    if (!userId) {
      return NextResponse.json(
        { error: 'User ID diperlukan' },
        { status: 400 }
      );
    }

    if (!name || name.trim().length === 0) {
      return NextResponse.json(
        { error: 'Nama senjata wajib diisi' },
        { status: 400 }
      );
    }

    if (name.length > 100) {
      return NextResponse.json(
        { error: 'Nama senjata maksimal 100 karakter' },
        { status: 400 }
      );
    }

    // Insert weapon
    const result = await sql`
      INSERT INTO weapons (user_id, name, type, rarity, base_attack, secondary_stat, passive_ability)
      VALUES (${userId}, ${name}, ${type || null}, ${rarity || null}, ${baseAttack || null}, ${secondaryStat || null}, ${passiveAbility || null})
      RETURNING id, name, type, rarity, base_attack, secondary_stat, passive_ability, created_at, updated_at
    `;

    return NextResponse.json({
      success: true,
      message: 'Senjata berhasil ditambahkan',
      weapon: result[0]
    });

  } catch (error) {
    console.error('Create weapon error:', error);
    return NextResponse.json(
      {
        error: 'Terjadi kesalahan saat menambahkan senjata',
        details: error instanceof Error ? error.message : 'Unknown error'
      },
      { status: 500 }
    );
  }
}
