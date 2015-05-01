<!DOCTYPE html>

<?php
session_start();
include 'lib/db_connect.php';
include '/lib/Meta.php';
include '/lib/Dandv.php';
include '/lib/CustomDAO.php';

if(isset($_SESSION['uname']))
	$u = $_SESSION['uname'];
?>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"
        rel="stylesheet" type="text/css">
        <link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css"
        rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/css.css" style="text/css"/>
    </head>
    
    <body>
        <div class="navbar navbar-default navbar-fixed-top navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><span>YouTube+</span></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                    <ul class="nav navbar-nav navbar-right"></ul>
                    <form class="navbar-form navbar-left text-center" role="search" name="search_form"
                    id="search_form" action="browse.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <div class="btn-group btn-group-sm" data-toggle="buttons">
                            <select class="form-control">
                                <option value="Category">Category</option>
                                <option value="Sports">Sports</option>
                                <option value="Music">Music</option>
                                <option value="Kids">Kids</option>
                                <option value="Action">Action</option>
                                <option value="Education">Education</option>
                                <option value="Movies">Movies</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="btn-group btn-group-sm" data-toggle="buttons">
                            <select class="form-control" name="search_by_type">
                                <option value="Type">Type</option>
                                <option value="video">video</option>
                                <option value="audio">audio</option>
                                <option value="image">image</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default">Search</button>
                    </form>
                    <ul class="hidden-md hidden-sm hidden-xs nav navbar-nav navbar-right">
                        <li>
                            <p class="navbar-text">Welcome
                                <!--?php if(isset($_SESSION['uname'])) echo "Welcome ".$_SESSION['uname'];
                                else echo "Welcome guest";?-->
                            </p>
                        </li>
                        <li>
                            <a href="#">Upload</a>
                        </li>
                        <li>
                            <a href="#">Sign in</a>
                        </li>
                        <li>
                            <a href="#">Sign up</a>
                        </li>
                        <li>
                            <a href="#">Sign out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
       
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="sidebar-fixed">
                        <div class="btn-group btn-group-lg btn-group-vertical hidden-sm hidden-xs"
                        data-toggle="buttons">
                            <a href="#" class="btn btn-block btn-lg btn-success" data-toggle="button">My Profile</a>
                            <a href="#" class="btn btn-block btn-lg btn-success" data-toggle="button">My Channel</a>
                            <div class="btn-group btn-group-lg" data-toggle="buttons">
                                <a class="btn btn-lg btn-success dropdown-toggle" data-toggle="dropdown"> Messages <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#">Inbox</a>
                                    </li>
                                    <li>
                                        <a href="#">Sent Messages</a>
                                    </li>
                                </ul>
                            </div>
                            <a class="btn btn-block btn-lg btn-success" data-toggle="button">Subscriptions</a>
                            <a class="btn btn-block btn-lg btn-success" data-toggle="button">Uploads</a>
                            <a href="#" class="btn btn-block btn-lg btn-success" data-toggle="button">History</a>
                            <a class="btn btn-block btn-lg btn-success" data-toggle="button">Playlists</a>
                            <a class="btn btn-block btn-lg btn-success" data-toggle="button">Friends</a>
                            <a class="btn btn-block btn-lg btn-success" data-toggle="button">Blocked Users</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>