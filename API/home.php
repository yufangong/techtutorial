<!DOCTYPE html>

<html>
    <head>
        <title>Login Page</title>
    </head>
    <body>
        <form action="loginAction" method="POST" enctype="multipart/form-data">
            First Name: <input type ="text" name="fname" id="first_name"><br><br>
            Last Name: <input type ="text" name = "lname" id="last_name"><br><br>
            Gender: <input type ="text" name ="gender" id="gender"><br><br>
            Age: <input type ="text" name ="age" id="age"><br><br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>






<!--To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.-->

<html>
    <head>
            <meta charset="utf-8"/>
            <title>Tech Tutorial</title>
            <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
            <link href="css/nivo-lightbox.css" rel="stylesheet" />
	<link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
	<link href="css/owl.carousel.css" rel="stylesheet" media="screen" />
        <link href="css/owl.theme.css" rel="stylesheet" media="screen" />
	<link href="css/flexslider.css" rel="stylesheet" />
	<link href="css/animate.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
	<link href="color/default.css" rel="stylesheet">
        </head>
        <body>
            <header>
            </header>
            <section  class="home-section section-heading text-center">
                <h2 >Welcome to Tech tutorial!</h2>
            </section>
            <section id="service" class="color-dark bg-gray">
                <h4 class="container">Get Start</h4>
                <div>
                    <div class="bg-dark h-bold container">
                        <h5><a href="upload.html"> Upload File </a></h5></div>
                    <div class="divider-header"></div>

                    <div class="bg-dark h-bold container">
                        <h5><a href="Download.php"> download File </a></h5></div>
                    <div class="divider-header"></div>
                    
                    <div class="bg-dark h-bold container">
                        <h5><a href="index.php/data/tt/tutorials">Get Tutorials</a></h5>
                    </div>
        
                    <div class="divider-header"></div>
    
                    <div class="bg-dark h-bold container">
                        <h5><a href="createDocument.php">Create new tutorial</a></h5>
                    </div>
                </div>
            </section>
            <section class="inner-section">
    <div class="col-md-12">
        <h1 class="divider"><span>Latest News</span></h1>

        
        <article>
            <h2 ><a href="/2015/03/01/version-260.html">Version 2.6.0</a></h2>
            <div>
                <p>We’ve just released version 2.6.0. This update includes a small but important fix for a potential object injection vulnerability in the <code>SessionCookie</code> class. We encourage you to update your applications as soon as possible. This update also includes several other improvements. You can read more on the GitHub release page.</p>

            </div>
        </article>
        
        <article>
            <h2><a href="/2015/02/25/slim-github-organization.html">Slim Framework GitHub Organization</a></h2>
            <div>
                <p>The Slim Framework code repositories have a new home in their very own <a href="https://github.com/slimphp">GitHub Organization</a>. As much as I’d like to keep the project beneath my own GitHub handle for the notoriety and what not, the project is best served with its own GitHub Organization. This solves several problems.</p>
            </div>
        </article>
       
    </div>
                <h5>RestApi using Slim Framework</h5>

                <h5>Support Forum and Knowledge Base</h5>
                <p>
                    Visit the <a href="http://help.slimframework.com" target="_blank">Slim support forum and knowledge base</a>
                    to read announcements, chat with fellow Slim users, ask questions, help others, or show off your cool
                    Slim Framework apps.
                </p>
                <h5>Slim Framework Extras</h5>
                <p>
                    Custom View classes for Smarty, Twig, Mustache, and other template
                    frameworks are available online in a separate repository.
                </p>
                <p><a href="https://github.com/codeguy/Slim-Extras" target="_blank">Browse the Extras Repository</a></p>
            </section>
        </body>
        <?php
        // put your code here
        ?>
</html>
