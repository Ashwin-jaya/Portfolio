<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        .images {
            display: flex;
            display: flex;
            justify-content: space-evenly;
            flex-wrap: wrap;
            align-content: center;
            gap: 50px;
            padding: 3rem;

            row-gap: 7rem;
        }

        i {
            font-size: 6rem;
            color: cornflowerblue;
            padding-left: 3rem;
            padding-right: 3rem;
        }

        h1 {
            padding: 5rem;
            font-size: 3rem;
            font-family: 'Poppins', 'Roboto', sans-serif;


        }

        p {
            font-size: 2rem;
            padding-left: 5rem;
            padding-right: 5rem;

            font-size: 2rem;
            color: cornflowerblue;
            font-family: 'Poppins', 'Roboto', sans-serif;

        }
    </style>

</head>

<body>
    <?php
    include 'Navbar.php';
    ?>
    <div class="cont">
        <h1>About Myself:</h1>
        <p>I am Ashwin Jayasankar, a passionate and dedicated individual seeking a position in a reputed tech company where I can apply my technical skills, learn new technologies, and contribute to innovative projects. <br> <br> My goal is to grow professionally while helping the organization achieve its objectives through hard work and smart solutions.</p>
        <h1>Education:</h1>
        <p>Govt. Engineering College, Daman</p>
        <p style=>2022-2026</p>
        <h1>Technologies Known:</h1>
        <div class="images">
            <i class="fa-brands fa-html5"></i>
            <i class="fa-brands fa-css3-alt"></i>
            <i class="fa-brands fa-js"></i>
            <i class="fa-brands fa-bootstrap"></i>
            <i class="fa-brands fa-angular"></i>
            <i class="fa-brands fa-react"></i>
            <i class="fa-brands fa-vuejs"></i>
            <i class="fa-brands fa-node"></i>
            <i class="fa-brands fa-java"></i>
            <i class="fa-brands fa-python"></i>
            <i class="fa-brands fa-golang"></i>
            <i class="fa-brands fa-rust"></i>
            <i class="fa-brands fa-swift"></i>
        </div>
    </div>
</body>

</html>