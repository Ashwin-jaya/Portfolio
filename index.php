<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyPortfolio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            overflow-x: hidden;
        }

        .MainContainer {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .Rightside {
            flex: 1;
            padding: 3rem;
        }

        .leftside {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .leftside img {
            width: 100%;
            max-width: 500px;
            height: auto;
        }

        #hello {
            font-size: 1.5rem;
            padding: 10px;
        }

        #Name {
            font-size: 4rem;
            padding: 10px;
        }

        #Occ {
            font-size: 2rem;
            padding: 10px;
        }

        .KnowMe {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            padding: 10px;
        }

        #aboutme,
        #contactme {
            width: 180px;
            height: 45px;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 30px;
            border: none;
        }

        #aboutme {
            background-color: rgba(0, 110, 255, 0.5);
        }

        #aboutme:hover {
            border: 2px solid #111;
        }

        #contactme {
            background-color: transparent;
            border: 2px solid rgba(0, 110, 255, 0.5);
        }

        #contactme:hover {
            border-color: rgba(0, 110, 255, 0.9);
        }

        .ContactIcons {
            padding-top: 25px;
            display: flex;
            gap: 20px;
        }

        .ContactIcons a {
            font-size: 2rem;
            color: rgb(0, 100, 172);
        }

        /* MOBILE MODE: Show background image */
        @media (max-width: 768px) {
            .MainContainer {
                background-image: url('uploads/229383837_11060576.jpg');
                background-size: cover;
                background-position: center;
                flex-direction: column;
                padding: 4rem 2rem;
            }

            .leftside {
                display: none;
            }

            .Rightside {
                background-color: rgba(255, 255, 255, 0.7);
                padding: 2rem;
                border-radius: 20px;
                width: 100%;
                text-align: center;
            }

            #Name {
                font-size: 2.5rem;
            }

            #Occ {
                font-size: 1.5rem;
            }

            .KnowMe {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>
    <?php
    include 'Navbar.php';
    ?>
    <div class="MainContainer">
        <div class="Rightside">
            <div class="Into">
                <H2 id="hello">Hello There,</h2>
                <p id="Name">I'm Ashwin</p>
                <p id="Occ"> A Web Developer</p>
            </div>
            <div class="KnowMe">
                <a href="about.php"><Button id="aboutme">About Me</Button></a>
                <a href="contact.php"><button id="contactme">Contact Me</button></a>
                <div class="ContactIcons">
                    <a href=""><i class="fa-brands fa-linkedin"></i></a>
                    <a href=""><i class="fa-brands fa-square-instagram"></i></a>
                    <a href=""><i class="fa-solid fa-at"></i></a>
                    <a href=""><i class="fa-brands fa-facebook"></i></a>
                    <a href=""><i class="fa-brands fa-github"></i></a>
                </div>
            </div>
        </div>
        <div class="leftside">
            <img src="uploads/229383837_11060576.jpg" alt="img">
        </div>
    </div>
</body>

</html>