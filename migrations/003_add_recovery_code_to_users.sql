-- Add recovery_code column to users table
ALTER TABLE users ADD COLUMN IF NOT EXISTS recovery_code VARCHAR(5);

-- Create index for recovery_code
CREATE INDEX IF NOT EXISTS idx_users_recovery_code ON users(recovery_code);
