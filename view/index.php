<html>
    <head>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="./public/js/musicspace.js"></script>

        <link rel="stylesheet" href="./public/styles.css">


    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/mediadb/index.php?controller=Dashboard&action=index">Music Space <span class="glyphicon glyphicon-play"></span></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <?php if (Engine::IsUserHasRole(UserDb::_Admin)): ?>
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Management <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/mediadb/index.php?controller=User&action=index">User Management</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php endif; ?>
                    <?php if (Engine::isAuthorized("Album", "index")): ?>
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My basket <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/mediadb/index.php?controller=Bag&action=index">Content</a></li>
                                    <li><a href="/mediadb/index.php?controller=Bag&action=process">Process my basket</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Albums<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/mediadb/index.php?controller=Album&action=index">List</a></li>
                                    <li><a href="/mediadb/index.php?controller=Album&action=add">Post an Album</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php endif; ?>


                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Artists<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/mediadb/index.php?controller=Artist&action=show&offset=1&limit=25">Show</a></li>                          
                            </ul>
                        </li>
                    </ul>
                    <div class="col-sm-4 col-md-4">
                        <form class="navbar-form" method="post" action="/mediadb/index.php?controller=Dashboard&action=search" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="info" id="srch-term">
                                <div class="input-group-btn">
                                    <input class="btn btn-default" type="submit" value="Search" />
                                </div>
                            </div>
                        </form>
                    </div>

                    <?php if (!Engine::HasUser()): ?>
                        <form class="navbar-form navbar-right" method="post" action="/mediadb/index.php?controller=User&action=login">
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    <?php else: ?>
                        <form class="navbar-form navbar-right" method="post" action="/mediadb/index.php?controller=User&action=logout">
                            <button type="submit" class="btn btn-default">Logout</button>
                        </form>
                    <?php endif; ?>

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <h1>Music Space <span class="glyphicon glyphicon-play"></span></h1>

                <p></p>

            </div>
        </div>

        <div class="container">

            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-12">
                    <?php if (isset($data->message)): ?>
                        <div class="alert alert-info" role="alert">
                            <?= $data->message ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="container">
                <?php include($content) ?>
            </div>
            <hr>
            <footer>
                <p>TechnofuturTic - LaboWeb 2017</p>
            </footer>
        </div> 
       
    </body>
</html>

