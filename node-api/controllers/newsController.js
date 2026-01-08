import pool from '../db.js';

export async function getAllNews(limit = 10, offset = 0) {
  const [rows] = await pool.query(
    'SELECT * FROM news ORDER BY published_at DESC LIMIT ? OFFSET ?',
    [limit, offset]
  );
  return rows;
}

export async function getNewsById(id) {
  const [rows] = await pool.query(
    'SELECT * FROM news WHERE id = ?',
    [id]
  );
  return rows[0];
}
