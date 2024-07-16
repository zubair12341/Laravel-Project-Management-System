const express = require('express')
const fs = require('fs')
const path = require('path')
const fileuploader = require('fileuploader')

var app = express();

// set static paths
app.use(express.static(__dirname + '/public'));
app.get(['/dist/*', '/examples/*', '/uploads/*'],function(a,b){var c=__dirname+a.path.replace(/\//g, '\\').replace(/^\\dist/, '\\..\\..\\dist').replace(/^\\examples/, '\\..\\..\\examples').replace(/^\\uploads/, '\\uploads');fs.existsSync(c)?b.sendFile(path.resolve(c)):(b.statusCode=404,b.write('404 not found'),b.end())});

// routing
app.get('/', function(req, res) {
    res.sendFile(__dirname + '/views/index.html');
});

app.post('/upload', function(req, res) {
    
    // initialize fileuploader
    var uploader = fileuploader('files', { uploadDir: 'uploads/' }, req, res);
    
    // call to process req.body and to upload the files
    uploader.upload(function(data) {
        res.end(JSON.stringify(data, null, 4));
    });
    
});

// init server
app.listen(8000);