import express from 'express';
import cors from 'cors';
import usersRoutes from './routes/users.js';
import newsRoutes from './routes/news.js';

const app = express();
app.use(cors());
app.use(express.json());

// Root page: documentatie van endpoints
app.get('/', (req, res) => {
  res.send(`
    <h1>API Endpoints</h1>
    <ul>
      <li>GET /users</li>
      <li>GET /users/:id</li>
      <li>POST /users</li>
      <li>PUT /users/:id</li>
      <li>DELETE /users/:id</li>
      <li>GET /users/search?q=...</li>
      <li>GET /users?limit=5&offset=0</li>
      <li>GET /news</li>
      <li>GET /news/:id</li>
      <li>POST /news</li>
      <li>PUT /news/:id</li>
      <li>DELETE /news/:id</li>
      <li>GET /news/search?q=...</li>
      <li>GET /news?limit=5&offset=0</li>
    </ul>
  `);
});

app.use('/users', usersRoutes);
app.use('/news', newsRoutes);

const PORT = 3000;
app.listen(PORT, () => console.log(`Server running at http://localhost:${PORT}`));
