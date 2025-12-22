import { sql } from '@/lib/db';
import { NextResponse } from 'next/server';

export async function GET() {
  try {
    const result = await sql`SELECT version()`;
    return NextResponse.json({
      success: true,
      message: 'Database connected successfully',
      version: result[0].version
    });
  } catch (error) {
    console.error('Database connection error:', error);
    return NextResponse.json(
      {
        success: false,
        error: 'Failed to connect to database',
        details: error instanceof Error ? error.message : 'Unknown error'
      },
      { status: 500 }
    );
  }
}
