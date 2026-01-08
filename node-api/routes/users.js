import express from 'express';
import pool from '../db.js';
const router = express.Router();

// Alle users ophalen met limit & offset
router.get('/', async (req, res) => {
  const limit = parseInt(req.query.limit) || 100;
  const offset = parseInt(req.query.offset) || 0;
  try {
    const [rows] = await pool.query('SELECT id, name, email, username, role FROM users LIMIT ? OFFSET ?', [limit, offset]);
    res.json(rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// User ophalen op ID
router.get('/:id', async (req, res) => {
  const id = req.params.id;
  const [rows] = await pool.query('SELECT id, name, email, username, role FROM users WHERE id = ?', [id]);
  res.json(rows[0] || {});
});

// Nieuwe user toevoegen
router.post('/', async (req, res) => {
  const { name, email, username, role } = req.body;
  if (!name || !email || !role) return res.status(400).json({ error: 'Name, email and role are required' });
  try {
    const [result] = await pool.query('INSERT INTO users (name, email, username, role) VALUES (?, ?, ?, ?)', [name, email, username || null, role]);
    res.json({ id: result.insertId, name, email, username, role });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// User updaten
router.put('/:id', async (req, res) => {
  const id = req.params.id;
  const { name, email, username, role } = req.body;
  try {
    await pool.query('UPDATE users SET name=?, email=?, username=?, role=? WHERE id=?', [name, email, username, role, id]);
    res.json({ id, name, email, username, role });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// User verwijderen
router.delete('/:id', async (req, res) => {
  const id = req.params.id;
  try {
    await pool.query('DELETE FROM users WHERE id=?', [id]);
    res.json({ message: 'Deleted successfully', id });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// Search
router.get('/search', async (req, res) => {
  const q = req.query.q || '';
  try {
    const [rows] = await pool.query('SELECT id, name, email, username, role FROM users WHERE name LIKE ? OR email LIKE ? OR username LIKE ?', [`%${q}%`, `%${q}%`, `%${q}%`]);
    res.json(rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

export default router;
