const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const cors = require('cors');

const app = express();
app.use(cors());
app.use(bodyParser.json());

const db = mysql.createConnection({
    host: 'localhost',
    user: 'your_username',
    password: 'your_password',
    database: 'your_database',
});

db.connect((err) => {
    if (err) throw err;
    console.log('Connected to the database');
});

app.get('/', (req, res) => {
    const sql = 'SELECT * FROM users';
    db.query(sql, (err, result) => {
        if (err) throw err;
        res.send(result);
    });
});

app.listen(3000, () => {
    console.log('Server started on port 3000');
});