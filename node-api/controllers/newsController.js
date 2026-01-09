import pool from '../db.js';

async function getNewsById(id) {
  const [rows] = await pool.query('SELECT * FROM news WHERE id = ?', [id]);
  return rows[0];
}

// CREATE news 
export async function createNews(req, res) {
  try {
    const { title, content, published_at, image, user_id } = req.body;

    if (!user_id) return res.status(400).json({ error: 'user_id required' });

    const [userCheck] = await pool.query('SELECT id FROM users WHERE id = ?', [user_id]);
    if (userCheck.length === 0) {
      return res.status(400).json({ error: 'Ongeldige user_id' });
    }

    const now = new Date();
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

// GET all news 
export async function getAllNews(req, res) {
  const limit = parseInt(req.query.limit) || 10;
  const page = parseInt(req.query.page) || 1;
  const offset = (page - 1) * limit;

  try {
    const [rows] = await pool.query(
      'SELECT * FROM news ORDER BY created_at DESC LIMIT ? OFFSET ?',
      [limit, offset]
    );

    const [totalResult] = await pool.query('SELECT COUNT(*) as count FROM news');
    const total = totalResult[0].count;

    res.json({
      data: rows,
      total,
      page,
      last_page: Math.ceil(total / limit)
    });
  } catch (err) {
    console.error(err);
    res.status(500).json({ error: 'Kon nieuws niet ophalen', details: err.message });
  }
}

// GET news by ID
export async function getNews(req, res) {
  const id = req.params.id;
  try {
    const news = await getNewsById(id);
    if (!news) return res.status(404).json({ error: 'News not found' });
    res.json(news);
  } catch (err) {
    console.error(err);
    res.status(500).json({ error: 'Kon news niet ophalen', details: err.message });
  }
}

// UPDATE news
export async function updateNews(req, res) {
  const id = req.params.id;
  const { title, content, published_at, image } = req.body;

  try {
    const now = new Date();
    const [result] = await pool.query(
      'UPDATE news SET title = ?, content = ?, published_at = ?, image = ?, updated_at = ? WHERE id = ?',
      [title, content, published_at || null, image || null, now, id]
    );

    if (result.affectedRows === 0) return res.status(404).json({ error: 'News not found' });

    const updatedNews = await getNewsById(id);
    res.json(updatedNews);
  } catch (err) {
    console.error(err);
    res.status(500).json({ error: 'Kon news niet updaten', details: err.message });
  }
}

// DELETE news
export async function deleteNews(req, res) {
  const id = req.params.id;
  try {
    const [result] = await pool.query('DELETE FROM news WHERE id = ?', [id]);
    if (result.affectedRows === 0) return res.status(404).json({ error: 'News not found' });
    res.json({ message: 'News deleted', id });
  } catch (err) {
    console.error(err);
    res.status(500).json({ error: 'Kon news niet verwijderen', details: err.message });
  }
}

// SEARCH news
export async function searchNews(req, res) {
  const q = req.query.q || '';
  try {
    const [rows] = await pool.query(
      'SELECT * FROM news WHERE title LIKE ? OR content LIKE ?',
      [`%${q}%`, `%${q}%`]
    );
    res.json(rows);
  } catch (err) {
    console.error(err);
    res.status(500).json({ error: 'Kon news niet zoeken', details: err.message });
  }
}
