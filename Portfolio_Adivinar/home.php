<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adivinar</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css\style.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/signup.css">
     <link rel="stylesheet" type="text/css" href="css/project_pop.css">
     <link rel="stylesheet" type="text/css" href="css/animation.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="./js/application.js"></script>
     <link rel="icon" href="./images/LogoMak.png">
    <!-- button_colors -->
    <script>
        window.console = window.console || function (t) { };
    </script>
    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>

    <!-- BCend -->
</head>

<body>
    
    <div class="site-main-wrapper">
        <button class="hamberger">
        <img src="./images/hamberger.svg">
    </button>
    <div class="mobile-nav">
        <button class="times">
            <img src="./images/times.svg" alt="">
        </button>
        <ul> 
            <img src="images\adivinar3.png" alt="" id="mobile-image"> <hr> 
             <li><a href="#">Home</a></li>
             <li><a href="#about">About us</a></li>
             <li><a href="#projects">Projects</a></li>
          
             <li><a href="#contact">Contact</a></li>
             <li><a href="#login-page">Log in</a></li>
            <li><a href="#signup-page">Sign Up</a></li>
        </ul>
    </div>
        <header id="home">
            <div class="container">
                <nav id="main-nav" class="flexbox items-center justify-between">
                    <div class="left">
                        <img src="images\adivinar3.png" alt="Logo">
                       
                    </div>
                    <div class="right flexbox">
                        <a href="#">Home</a>
                        <a href="#about">About us</a>
                        <a href="#projects">Projects</a>
                       
                        <a href="#contact">Contact</a>
                        <a href="#login-page">log in</a>
                        <a href="#signup-page">Sign Up</a>
                    </div>
                      
                </nav>
                <div class="first flexbox items-center justify-between">
                    <div class="left flexbox-1 flexbox justify-center float-image-left" >
                        <img src="./images/mans.png" alt="" id="man-image">
                    </div>
                    
                    <div class="right flexbox-1 float-right" id="title-width">
                         <h6>Ashok Lora</h6>
                        <h1>I'm UI Designer <br> <span>Developer</span> </h1>
                        <p>Uses Interface designes with a passion for desigining beautiful<br> an factional uses
                            experiances.<br>
                            Minimalist who lulieves that less is more. </p>
                      
                    </div>
                </div>
            </div>

        <div class="login-one" id="login-page">
        
        <div class="login-two">
            <div class="close">
                <a href="home.php">CLOSE</a>
                
            </div>
            <div class="alert">
            <?php
                include 'connection.php';
                if(isset($_POST['login']))
                {
                    $email=mysqli_real_escape_string($con,$_POST['email']);
                    $password=mysqli_real_escape_string($con,$_POST['password']);
                    $check= mysqli_query($con,"select * from register where Email='$email'");
                    $res=mysqli_num_rows($check);
                    if($res)
                    {
                        $getvalue=mysqli_fetch_assoc($check);
                        $db_pass=$getvalue['Password'];
                        
                        $checkpass= password_verify($password, $db_pass);
                        if($checkpass)
                        {
                            //echo "Loged in Successfully";
                            $_SESSION['username']=$getvalue['Name'];
                            
                            ?>
                            <script>
                            location.replace('homelogged.php');
                            </script>
                            <?php
                        }
                        else
                        {
                            echo "Invalid Email or Password";
                        }

                    }
                    else
                    {
                        {
                            echo "Invalid Email or Password";
                        }
                    }
                }
            ?>
            </div>
            <h2>User Log In</h2>
            <form method="POST">
                <input type="email" name="email" placeholder="Email Address">
                <input type="password" name="password" placeholder="Password">
                <input type="submit" name="login" value="Log In" id="login">
            </form>
            <h3> Not Registered <a href="#signup-page">Click Here</a> </h3>
        </div>
    </div>
    <div class="signup-one" id="signup-page">
        <div class="signup-two">
            <div class="close">
                <a href="home.php">CLOSE</a>
                
            </div>
            
            <div class="alert">
            <?php
             include 'connection.php';
             if(isset($_POST['signup']))
             {  
             $name = mysqli_real_escape_string($con,$_POST['name']);
             $email = mysqli_real_escape_string($con,$_POST['email']);
             $password =mysqli_real_escape_string($con, $_POST['password']);
             $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);
             $e_query = "select * from register where Email = '$email'";
             $equery=mysqli_query($con,$e_query);
             $row = mysqli_num_rows($equery);
             if(!$row)
             {
                 if($password===$cpassword)
                 {  
                    $pass=password_hash($password, PASSWORD_BCRYPT);
                    $insertquery= "INSERT INTO register(Name, Email, Password) VALUES ('$name','$email','$pass')";
                    $iquery= mysqli_query($con,$insertquery);

                    if($iquery)
                    {
                        echo "Registered Successfully";
                        
                        //header('location:#signup-page');
                    }
                 }
                 else
                 {
                 echo "Password Mismatch";
                }
             }
             else
             {
                echo "User Already Exists";
             }
            }

            ?>
            </div>

            <h2>User Registration </h2>
            <form method="POST">
            
                <input type="text" name="name" placeholder="Full Name" required >
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="cpassword" placeholder="Confirm Password" required>
                <input type="submit" name="signup" value="Sign Up" id="signup">
            </form>
            <h3> Already Registered <a href="#login-page">Login</a> </h3>
            


        </div>
    </div>
        </header>
        
      <section id="about" class="about">
        <div class="container flexbox items-center about-my">
            <div class="flexbox-1">
                <img class="about-me-image" src="./images/men_suit.webp" alt="man">
            </div>
            <div class="flexbox-1 hand">
                <h1>About <span>Me</span></h1>
                <h3>Hello I'm Ashok Lora</h3>
                <p>Every person has their own unique Story<br>
                    Here is the glimps into mine
                    I enjoy to taking complex problems and turning them into simple and beautiful interface designs.
                    <br>
                    I also love the logic and structure of coding and always strive to write elegant and efficient
                    code,whether it be HTML, CSS, Javascript,
                    and PHP.
                </p>

            </div>
        </div>
    </section>
    <section id="services" class="services">
        <div class="container">

            <div class="card-wrapper">
                <div class="card">
                    <img src="./images/education.png" class="edu-image">
                    <h2>Education</h2> <br>
                    <p>B.S Web Development
                        (California state university). <br>
                        AA Programming
                        (Fullerton College). <br>
                        Certified Java Programmer. <br>
                        Certified Python Programmer.</p>
                </div>
                <div class="card">
                    <img src="./images/technical.png" class="tech-image">
                    <h2>Technical Skills</h2> <br>
                    <p>Wordpress, HTML, CSS, JS, LinkedIn Advertising, Google Webmaster Tools, Google Analysis, Critical
                        Thinking, Active listening, Problem solving, Collaboration, Photoshopping, Wireframe. </p>
                </div>
                <div class="card">
                    <img src="./images/interest.jpg" class="in-image">
                    <h2>Interest</h2> <br>
                    <p>Climbing,
                        Snowboarding,
                        Paragliding,
                        Bungee jumping,
                        Rafting,
                        Reading,
                        Coding,
                        Cycling.</p>
                </div>
                <div class="card">
                    <img src="./images/achievement.png" class="achieve-image">
                    <h2>Achievements</h2> <br>
                    <p>Webby Award for technical Achievement.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="projects" class="projects">
        <div class="container">
            <h1 class="section-heading">My <span>Projects</span></h1>
            <p>“It does not take much strength to do things, but it requires a great deal of strength to decide what to
                do.”         ― Elbert Hubbard
            </p>
            <div class="card-wrapper">
                <div class="card">
                    <div class="overlay">
                        <span>Category</span>
                        <a href="#project-one">Web Development : Internet
                            Banking</a>

                    </div>
                    <img src="./images/webD.png">
                </div>
                <div class="card">
                    <div class="overlay">
                        <span>Category</span>
                        <a href="#project-two">Python Development : Tripleesencia</a>
                    </div>
                    <img src="./images/Python-011.png">
                </div>
                <div class="card">
                    <div class="overlay">
                        <span>Category</span>
                        <a href="#project-three">Java Development : Blinking Smily </a>
                    </div>
                    <img src="./images/java2.png">
                </div>
                <div class="card">
                    <div class="overlay">
                        <span>Category</span>
                        <a href="#project-four">Java Development : Calculator</a>
                    </div>
                    <img src="./images/java3.png">
                </div>
                <div class="card">
                    <div class="overlay">
                        <span>Category</span>
                        <a href="#project-five">Java Development : Tic Tac Toe</a>
                    </div>
                    <img src="./images/java4.png">
                </div>
                <div class="card">
                    <div class="overlay">
                        <span>Category</span>
                        <a href="#project-six">Java Development : All in one Application </a>
                    </div>
                    <img src="./images/java.png">
                </div>
            </div>
        </div>


        <div class="pop-project" id="project-one">
            <div class="inner-pop">
                <a href="#projects">
                    <div class="pop-close">Close</div>
                </a>
                <h2>Internet Banking</h2>
                <p>
                    Online banking, also known as internet banking or web banking, is an electronic payment system that
                    enables customers of a bank or other financial institution to conduct a range of financial
                    transactions through the financial institution's website.


                </p>
                <div class=pop-image><img src="images/inter.jpg"></div>
            </div>
        </div>

        <div class="pop-project" id="project-two">
            <div class="inner-pop">
                <a href="#projects">
                    <div class="pop-close">Close</div>
                </a>
                <h2>Tripleesencia</h2>
                <p>
                    Our project’s title “TRIPLEESENCIA” indicate the combination of three main tools to complete the
                    target of our project.

                    Our project targets the inclusion of some basic mathematical tools that people often need in their
                    day-to-day life.
                    




                </p>
                <div class=pop-image><img src="images/triplessencia.png"></div>
            </div>
        </div>

        <div class="pop-project" id="project-three">
            <div class="inner-pop">
                <a href="#projects">
                    <div class="pop-close">Close</div>
                </a>
                <h2>Blinking Smily</h2>
                <p>
                    This project consist of the basic staring with the java applet. In this project we had tried to show out creativity throught the build this smily face  whose eyes closed and mouth open the we hover on the face. 

                </p>
                <div class=pop-image><img src="images/smily.jpg"></div>
            </div>
        </div>

        <div class="pop-project" id="project-four">
            <div class="inner-pop">
                <a href="#projects">
                    <div class="pop-close">Close</div>
                </a>
                <h2>Calculator</h2>
                <p>
                    This Calculator is build with the Java. We have used the Action Listener and Mouse click Event to target the button. The Calculator performs the baisc calculation like addition , subtraction, multiplication, division. We have also add the reset key. The Calculator is sufficient  for the student who need it in the basic calculation for thier work.

                </p>
                <div class=pop-image><img src="images/cal.jpg"></div>
            </div>
        </div>

        <div class="pop-project" id="project-five">
            <div class="inner-pop">
                <a href="#projects">
                    <div class="pop-close">Close</div>
                </a>
                <h2>Tic Tac To Game</h2>
                <p>
                   We all have played this game many times. But the means we used to play the game by using the pen and paper. This is what we do when we where child. Apart from that it also harm the ecosystem by the wastage of paper for our enjoyment.
                   <br>
                   But we bring the solution for the by building the this game. This the Multiplayer type game. This how the we can enjoy the it like the real game.
                   With the color change property that has been used to and it also display the winner who make it faster.


                </p>
                <div class=pop-image><img src="images/tic.jpg"></div>
            </div>
        </div>

        <div class="pop-project" id="project-six">
            <div class="inner-pop">
                <a href="#projects">
                    <div class="pop-close">Close</div>
                </a>
                <h2>All In One Application</h2>
                <p>
                    In our day to day life we require may tools to fulfill our needs.
                    This tool may be physical tools or a virtual tool. That can be used to make our life much easier and helpful. <br>
                    The need for the fast work and the accuracy in this fast growing modern world give rise to many development. In this we have tried to make our All pourpose Tool Application that consists of the calculator, games, healths moniter and convert. With all new way to protect yourself with the COVID 19.

                </p>
                <div class=pop-image><img src="images/all.jpg"></div>
            </div>
        </div>




    </section>
    <section class="freelancer">
        <h1>I am available for Freelancer.</h1>
        <p>“Some writers aren't writers, they are mere escapees' and refugees' on an exile from the jungle of thoughts.”
        </p>
        <a href="./images/CV.pdf" target="_blank"><button class="btn btn-first">Download CV</button></a>

    </section>


    <section id="contact" class="contact">
        <div class="container">
            <h1 class="section-heading">Contact <span>Us</span></h1>
            <p>Feel free to contact me at any time by email or phone.</p>
            <div class="card-wrapper">
                <div class="card">
                    <a href="#"><img src="./images/mobile.png"></a>
                    <h2>Call Us On</h2>
                    <h6>+335 269 7480</h6>
                </div>
                <div class="card">
                    <a href="https://mail.google.com/mail/u/0/?ogbl#inbox?compose=new" target="_blank"><img
                            src="./images/mail.webp"></a>
                    <h2>Email Us At</h2>
                    <h6>ashokLora965@gmail.com</h6>

                </div>
                <div class="card">
                    <a href="https://web.whatsapp.com/" target="_blank"><img src="./images/whatsapp.svg"></a>
                    <h2>Connect in Whatsapp</h2>
                    <h6>336 845 1967</h6>
                </div>
            </div>
            <form action="#">
                <div class="text-box">
                    <input type="text" placeholder="Your Name">
                    <input type="email" placeholder="Your Email">
                </div>
                <div class="text-box-2">
                    <input type="text" placeholder="Your Subject...">
                    <textarea name="" placeholder="Your Message..." id="" cols="30" rows="10"></textarea>
                </div>
                <div class="btn-guard">
                    <button class="btn btn-last">Send Message</button>
                </div>
            </form>

        </div>
    </section>

    <footer>
        <a href="#home"><img id="home" class="footer-logo" src="images\adivinar3.png"></a>
        <div class="footer-social">
            <a href="https://www.linkedin.com/" target="_blank"><img src="./images/linkedin.png" alt=""></a>
            <a href="https://twitter.com/" target="_blank"><img src="./images/twitter.png" alt=""></a>
            <a href="https://www.instagram.com/" target="_blank"><img src="./images/instagram.png" alt=""></a>
            <a href="https://www.facebook.com/" target="_blank"><img src="./images/facebook.png" alt=""></a>
            <a href="https://in.pinterest.com/" target="_blank"><img src="./images/pinterest.png" alt=""></a>
        </div>
        <div class="reserved">
            Copyright © 2020-2024 Adivinar. All rights reserved.
        </div>
    </footer>
    <div class="theme">

        <ul>
            <li><button value="orange" class="button-four"></button></li>
            <li><button value="black" class="button-two"></button></li>
            <li><button value="grey" class="button-five"></button></li>
            <li><button value="blue" class="button-one"></button></li>
            <li><button value="green" class="button-three"></button></li>
            <li><button value="red" class="button-six"></button></li>
        </ul>

    </div>
    </div>
    <script>
        const root = document.documentElement;
        const themeBtns = document.querySelectorAll('.theme ul li > button');

        themeBtns.forEach(btn => {
            btn.addEventListener('click', handleThemeUpdate);
        });

        function handleThemeUpdate(e) {
            switch (e.target.value) {
                case 'blue':
                    root.style.setProperty('--skyblue', '#00ddff');
                    root.style.setProperty('--header', '#0049b7');
                    root.style.setProperty('--white', 'white');
                    root.style.setProperty('--grey', '');
                    root.style.setProperty('--lightgrey', '#F2F2F2');
                    root.style.setProperty('--darkblack', '');
                    root.style.setProperty('--about', '');
                    root.style.setProperty('--aboutblack', '');
                    root.style.setProperty('--freelancerwhite', '');
                    break;
                case 'black':
                    root.style.setProperty('--skyblue', '#00ddff');
                    root.style.setProperty('--header', '#FF6347');
                    root.style.setProperty('--white', '#ffffff');
                    root.style.setProperty('--grey', '');
                    root.style.setProperty('--lightgrey', '');
                    root.style.setProperty('--darkblack', '#000000');
                    root.style.setProperty('--about', '');
                    root.style.setProperty('--aboutblack', '');
                    root.style.setProperty('--freelancerwhite', '');
                    break;
                case 'green':
                    root.style.setProperty('--skyblue', '#00a6c0');
                    root.style.setProperty('--header', '#a5e65a');
                    root.style.setProperty('--white', '#ffffff');
                    root.style.setProperty('--grey', '');
                    root.style.setProperty('--lightgrey', '');
                    root.style.setProperty('--darkblack', '#a5e65a');
                    root.style.setProperty('--about', '');
                    root.style.setProperty('--aboutblack', '');
                    root.style.setProperty('--freelancerwhite', '');
                    break;
                case 'orange':
                    root.style.setProperty('--skyblue', '#000000');
                    root.style.setProperty('--header', 'orange');
                    root.style.setProperty('--white', '#ffffff');
                    root.style.setProperty('--grey', '');
                    root.style.setProperty('--lightgrey', '');
                    root.style.setProperty('--darkblack', 'orange');
                    root.style.setProperty('--about', '');
                    root.style.setProperty('--aboutblack', '');
                    root.style.setProperty('--freelancerwhite', '');
                    break;
                case 'grey':
                    root.style.setProperty('--skyblue', '#000000');
                    root.style.setProperty('--header', '#82a53e');
                    root.style.setProperty('--white', '#ffffff');
                    root.style.setProperty('--grey', '');
                    root.style.setProperty('--lightgrey', '');
                    root.style.setProperty('--darkblack', '#3f843e');
                    root.style.setProperty('--about', '');
                    root.style.setProperty('--aboutblack', '');
                    root.style.setProperty('--freelancerwhite', '');
                    break;
                case 'red':
                    root.style.setProperty('--skyblue', '#000000');
                    root.style.setProperty('--header', '#455A64');
                    root.style.setProperty('--white', '#ffffff');
                    root.style.setProperty('--grey', '');
                    root.style.setProperty('--lightgrey', '');
                    root.style.setProperty('--darkblack', '#161616');
                    root.style.setProperty('--about', '');
                    root.style.setProperty('--aboutblack', '');
                    root.style.setProperty('--freelancerwhite', '');
                    break;
            }

        }
    </script>

</body>

</html>