import { sql } from '@/lib/db';
import { NextResponse } from 'next/server';

// Get all characters for a user
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

    const characters = await sql`
      SELECT id, name, level, weapon_type, weapon_name, artifact, normal_attack_level, elemental_skill_level, elemental_burst_level, created_at, updated_at
      FROM characters
      WHERE user_id = ${userId}
      ORDER BY created_at DESC
    `;

    return NextResponse.json({
      success: true,
      characters
    });

  } catch (error) {
    console.error('Get characters error:', error);
    return NextResponse.json(
      {
        error: 'Terjadi kesalahan saat mengambil data karakter',
        details: error instanceof Error ? error.message : 'Unknown error'
      },
      { status: 500 }
    );
  }
}

// Create a new character
export async function POST(request: Request) {
  try {
    const body = await request.json();
    const { userId, name, level, weaponType, weaponName, artifact, normalAttackLevel, elementalSkillLevel, elementalBurstLevel } = body;

    // Validation
    if (!userId) {
      return NextResponse.json(
        { error: 'User ID diperlukan' },
        { status: 400 }
      );
    }

    if (!name || name.trim().length === 0) {
      return NextResponse.json(
        { error: 'Nama karakter wajib diisi' },
        { status: 400 }
      );
    }

    if (name.length > 100) {
      return NextResponse.json(
        { error: 'Nama karakter maksimal 100 karakter' },
        { status: 400 }
      );
    }

    // Insert character
    const result = await sql`
      INSERT INTO characters (user_id, name, level, weapon_type, weapon_name, artifact, normal_attack_level, elemental_skill_level, elemental_burst_level)
      VALUES (${userId}, ${name}, ${level || null}, ${weaponType || null}, ${weaponName || null}, ${artifact || null}, ${normalAttackLevel || null}, ${elementalSkillLevel || null}, ${elementalBurstLevel || null})
      RETURNING id, name, level, weapon_type, weapon_name, artifact, normal_attack_level, elemental_skill_level, elemental_burst_level, created_at, updated_at
    `;

    return NextResponse.json({
      success: true,
      message: 'Karakter berhasil ditambahkan',
      character: result[0]
    });

  } catch (error) {
    console.error('Create character error:', error);
    return NextResponse.json(
      {
        error: 'Terjadi kesalahan saat menambahkan karakter',
        details: error instanceof Error ? error.message : 'Unknown error'
      },
      { status: 500 }
    );
  }
}
