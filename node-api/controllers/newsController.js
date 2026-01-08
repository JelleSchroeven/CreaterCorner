import pool from '../db.js';

// Deze staat bovenaan
async function getNewsById(id) {
  const [rows] = await pool.query('SELECT * FROM news WHERE id = ?', [id]);
  return rows[0];
}

// Daarna de route handler
export async function createNews(req, res) {
  try {
    const { title, content, published_at, image, user_id } = req.body;

    if (!user_id) return res.status(400).json({ error: 'user_id required' });

    const [userCheck] = await pool.query('SELECT id FROM users WHERE id = ?', [user_id]);
    if (userCheck.length === 0) {
      return res.status(400).json({ error: 'Ongeldige user_id' });
    }

    // Hier komt de aangepaste INSERT
    const now = new Date(); // huidige tijd
    const [result] = await pool.query(
      'INSERT INTO news (title, content, published_at, image, user_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)',
      [title, content, published_at || null, image || null, user_id, now, now]
    );

    const news = await getNewsById(result.insertId);

    return res.status(201).json({ data: news });
  } catch (err) {
    console.error(err);
    return res.status(500).json({ error: 'Kon nieuws niet aanmaken', details: err.message });
  }
}

