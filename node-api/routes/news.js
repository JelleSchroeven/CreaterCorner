import express from 'express';
import pool from '../db.js';
const router = express.Router();

// Alle news
router.get('/', async (req, res) => {
    const page = parseInt(req.query.page) || 1;
    const limit = parseInt(req.query.limit) || 10;
    const offset = (page - 1) * limit;

    try {
        const [rows] = await pool.query('SELECT * FROM news ORDER BY created_at DESC LIMIT ? OFFSET ?',
            [limit, offset]
        );

        const [totalResult] = await pool.query('SELECT COUNT(*) as count FROM news');
        const total = totalResult[0].count;

        res.json({data: rows,total,page,last_page: Math.ceil(total / limit)});
    } catch (err) {
        console.error(err);
        res.status(500).json({ error: 'Server error' });
    }
});

// News by ID
router.get('/:id', async (req, res) => {
  const id = req.params.id;
  const [rows] = await pool.query('SELECT id, title, content, created_at FROM news WHERE id=?', [id]);
  res.json(rows[0] || {});
});

// Add news
router.post('/', async (req, res) => {
  const { title, content } = req.body;
  if (!title || !content) return res.status(400).json({ error: 'Title and content are required' });
  const [result] = await pool.query('INSERT INTO news (title, content) VALUES (?, ?)', [title, content]);
  res.json({ id: result.insertId, title, content });
});

// Update news
router.put('/:id', async (req, res) => {
  const id = req.params.id;
  const { title, content } = req.body;
  await pool.query('UPDATE news SET title=?, content=? WHERE id=?', [title, content, id]);
  res.json({ id, title, content });
});

// Delete news
router.delete('/:id', async (req, res) => {
  const id = req.params.id;
  await pool.query('DELETE FROM news WHERE id=?', [id]);
  res.json({ message: 'Deleted successfully', id });
});

// Search news
router.get('/search', async (req, res) => {
  const q = req.query.q || '';
  const [rows] = await pool.query('SELECT id, title, content, created_at FROM news WHERE title LIKE ? OR content LIKE ?', [`%${q}%`, `%${q}%`]);
  res.json(rows);
});

export default router;
