const mysql = require('mysql');

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'your_username',
    password: 'your_password',
    database: 'your_database_name',
});

connection.connect((err) => {
    if (err) throw err;
    console.log('Connected to the database!');
});

const express = require('express');
const app = express();

app.get('/courses', (req, res) => {
  connection.query('SELECT * FROM courses', (err, results) => {
    if (err) throw err;
    res.json(results);
    });
});