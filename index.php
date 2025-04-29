<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KoratWalk</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        background-color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px;
    }

    .screen {
        max-width: 400px;
        width: 100%;
        background-color: white;
        border-radius: 20px;
        margin-bottom: 30px;
    }

    .screen img {
        width: 100%;
        max-width: 500px;
        margin: 0 auto 20px;
        display: block;
    }

    .btn {
        width: fit-content;
        padding: .5rem 2rem;
        border: none;
        border-radius: 30px;
        background-color: #5371cb;
        color: white;
        font-size: 30px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #5371cb;
    }
    </style>
</head>

<body>
    <div class="screen">
        <img src="img/Home.jpg" alt="elderly">
        <form action="login.php" style="text-align: center;">
            <button class="btn">เริ่ม</button>
        </form>
    </div>
</body>

</html>