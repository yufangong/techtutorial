<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Create Tutorial</title>
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
        <div class="color-dark bg-gray container">
        <form action="index.php/data/tt/tutorials" method="post" enctype="multipart/form-data">
                Tutorial Id : <input type="text" size="3" name="TutorialId" id="tutorialId">
                Tutorial Category : <input type="text" name="TutorialCategory" id="tutorialCate">
                Tutorial Author : <input type="text" name="TutorialAuthor" id="tutorialAuthoR">
                <br>
                Tutorial Name : <input type="text" size="100" name="TutorialName" id="tutorialName">
                <br>
                Tutorial content : <br><textarea rows="30" cols="100" name="TutorialContent" id="tutorialContent">
                </textarea>
                <br>
                <input type="submit" value="Create new Tutorial" name="submit">        
        </form>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
