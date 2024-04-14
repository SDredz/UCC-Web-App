const express = require('express');
const app = express();
const mysql = require('mysql');

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'your_username',
    password: 'your_password',
    database: 'your_database',
    table: ' '
});

connection.connect((err) => {
    if (err) throw err;
    console.log('Connected to the database!');
});


app.post('/login', (req, res) => {
    const { username, password } = req.body;
    
    connection.query('SELECT * FROM login_stu_cred WHERE student_id =? AND pass_word =?', [username, password], (err, results) => {
        if (err) throw err;
        if (results.length > 0) {
            res.send('Logged in!');
            
        } else {
            res.send('Invalid username or password');
        }
    });
});