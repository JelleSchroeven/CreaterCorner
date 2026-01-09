import express from 'express';
import cors from 'cors';
import usersRoutes from './routes/users.js';
import newsRoutes from './routes/news.js';

const app = express();
app.use(cors());
app.use(express.json());

app.use(express.static('public'));

app.get('/', (req, res) => {
  res.send(`
    <h1>Node.js API Documentation</h1>
    <p>Click on an endpoint to see its response.</p>

    <h2>Users</h2>
      algemene pagina met alle crud functies => <a href="/user_crud_page.html" target="_blank">GET /user_crud_page.html</a>
    <ul>
      <li><a href="/users" target="_blank">GET /users</a> – List all users</li>
      <li><a href="/users/1" target="_blank">GET /users/:id</a> – Get user by ID (example: 1)</li>
      <li>POST /users – Create a new user (use Postman or curl)</li>
      <li>PUT /users/:id – Update user (use Postman or curl)</li>
      <li>DELETE /users/:id – Delete user (use Postman or curl)</li>
      <li><a href="/users/search?q=test" target="_blank">GET /users/search?q=...</a> – Search users</li>
      <li><a href="/users?limit=5&offset=0" target="_blank">GET /users?limit=5&offset=0</a> – Pagination example</li>
    </ul>

    <h2>News</h2>
      algemene pagina met alle crud functies => <a href="/news_crud_page.html" target="_blank">GET /news_crud_page.html</a>
    <ul>
      <li><a href="/news" target="_blank">GET /news</a> – List all news</li>
      <li><a href="/news/1" target="_blank">GET /news/:id</a> – Get news by ID (example: 1)</li>
      <li>POST /news – Create news (use Postman or curl)</li>
      <li>PUT /news/:id – Update news (use Postman or curl)</li>
      <li>DELETE /news/:id – Delete news (use Postman of curl)</li>
      <li><a href="/news/search?q=test" target="_blank">GET /news/search?q=...</a> – Search news</li>
      <li><a href="/news?limit=5&offset=0" target="_blank">GET /news?limit=5&offset=0</a> – Pagination example</li>
    </ul>
  `);
});

app.use('/users', usersRoutes);
app.use('/news', newsRoutes);

const PORT = 3000;
app.listen(PORT, () => console.log(`Server running at http://localhost:${PORT}`));