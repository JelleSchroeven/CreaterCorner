const mysql = require('mysql2');

const connection = mysql.createConnection({
  host: '127.0.0.1',
  user: 'root',
  password: '',
  database: 'creator_corner'
});

connection.connect(err => {
  if (err) throw err;
  console.log('Connected to DB!');
});
