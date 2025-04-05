<?php
header("Content-Type: text/html; charset=UTF-8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Play-Metin2 - Best Private Server</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0f0f0f !important;
            color: white;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #181818;
            padding: 25px;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 0 20px rgba(255, 165, 0, 0.3);
            border: 1px solid rgba(255, 165, 0, 0.3);
        }
        h1 {
            font-size: 28px;
            color: #f39c12;
            font-weight: 600;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        p {
            font-size: 14px;
            color: #bbb;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            font-size: 18px;
            font-weight: bold;
            background: #f39c12;
            color: #111;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 5px 15px rgba(255, 165, 0, 0.4);
            border: none;
            cursor: pointer;
        }
        .button:hover {
            background: #e67e22;
            transform: scale(1.05);
        }
        .status {
            margin-top: 20px;
            font-size: 14px;
            color: #bbb;
        }
        .online {
            color: #4CAF50;
            font-weight: bold;
        }
        .offline {
            color: #e74c3c;
            font-weight: bold;
        }
        .footer {
            margin-top: 15px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>WELCOME TO PLAY-METIN2</h1>
        <p>The best private server with custom updates and an active community!</p>
        
        <a href="download.php" class="button">Download Client</a>

        <div class="status">
            Server Status: <span class="online">Online</span> <br>
            Players Online: <span class="online">345</span>
        </div>

        <div class="footer">
            &copy; 2025 Play-Metin2. All Rights Reserved.
        </div>
    </div>

</body>
</html>
