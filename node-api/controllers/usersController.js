import pool from '../db.js'; 

// GET all users 
export const getAllUsers = async (req, res) => {
  const limit = parseInt(req.query.limit) || 100;
  const offset = parseInt(req.query.offset) || 0;

  try {
    const [rows] = await pool.query(
      'SELECT id, name, email, username, role FROM users LIMIT ? OFFSET ?',
      [limit, offset]
    );
    res.json(rows);
  } catch (err) {
    console.error(err);
    res.status(500).json({ message: 'Server error', error: err.message });
  }
};

// GET user by ID
export const getUserById = async (req, res) => {
  const id = req.params.id;
  try {
    const [rows] = await pool.query(
      'SELECT id, name, email, username, role FROM users WHERE id = ?',
      [id]
    );
    if (rows.length === 0) return res.status(404).json({ message: 'User not found' });
    res.json(rows[0]);
  } catch (err) {
    console.error(err);
    res.status(500).json({ message: 'Server error', error: err.message });
  }
};

// CREATE user
export const createUser = async (req, res) => {
  const { name, email, username, role } = req.body;
  if (!name || !email || !role) {
    return res.status(400).json({ message: 'Name, email, and role are required' });
  }

  try {
    const [result] = await pool.query(
      'INSERT INTO users (name, email, username, role) VALUES (?, ?, ?, ?)',
      [name, email, username || null, role]
    );
    res.status(201).json({ id: result.insertId, name, email, username, role });
  } catch (err) {
    console.error(err);
    res.status(500).json({ message: 'Server error', error: err.message });
  }
};

// UPDATE user
export const updateUser = async (req, res) => {
  const id = req.params.id;
  const { name, email, username, role } = req.body;
  try {
    const [result] = await pool.query(
      'UPDATE users SET name = ?, email = ?, username = ?, role = ? WHERE id = ?',
      [name, email, username, role, id]
    );
    if (result.affectedRows === 0) return res.status(404).json({ message: 'User not found' });
    res.json({ id, name, email, username, role });
  } catch (err) {
    console.error(err);
    res.status(500).json({ message: 'Server error', error: err.message });
  }
};

// DELETE user
export const deleteUser = async (req, res) => {
  const id = req.params.id;
  try {
    const [result] = await pool.query('DELETE FROM users WHERE id = ?', [id]);
    if (result.affectedRows === 0) return res.status(404).json({ message: 'User not found' });
    res.json({ message: 'User deleted', id });
  } catch (err) {
    console.error(err);
    res.status(500).json({ message: 'Server error', error: err.message });
  }
};

// SEARCH users
export const searchUsers = async (req, res) => {
  const q = req.query.q || '';
  try {
    const [rows] = await pool.query(
      'SELECT id, name, email, username, role FROM users WHERE name LIKE ? OR email LIKE ? OR username LIKE ?',
      [`%${q}%`, `%${q}%`, `%${q}%`]
    );
    res.json(rows);
  } catch (err) {
    console.error(err);
    res.status(500).json({ message: 'Server error', error: err.message });
  }
};
