<?php echo doctype('html5');?>

<html lang="en" ng-app="itemsApp">
<head>
    <meta charset="utf-8">
    <title>Polls</title>

    <!-- Angular -->
    <script src="<?php echo base_url() ?>angularjs/scripts/angular.js"></script>
    <script src="<?php echo base_url() ?>angularjs/scripts/angular-route.js"></script>
    
    <!-- App and Controllers -->
    <script src="<?php echo base_url() ?>angularjs/js/app.js"></script>
    <script src="<?php echo base_url() ?>angularjs/js/controllers.js"></script>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    
    <!--script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular-sanitize.js"></script-->
    <link href="angularjs/css/styles.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Site Navbar -->
        <div class="masthead ">
            <h2 class="text-muted">Seng365 Polls</h2>
            <nav>
                <ul class="nav nav-justified" ng-controller='NavigationCtrl'>
                    <li ng-class="{ active: isCurrentPath('/polls') }"><a href="#/polls">Home</a></li>
                    <li ng-class="{ active: isCurrentPath('/admin') }"><a href="#/admin">Admin</a></li>
                    <li ng-class="{ active: isCurrentPath('/about') }"><a href="#">About</a></li>
                </ul>
            </nav>
        </div>
        <br><br>
        
        <!-- Main Content -->
        <div ng-view></div>
        
        <!-- Site footer -->
      <footer class="footer">
        <p>&copy; Mathew Hylkema, 2016.</p>
      </footer>
    </div>
</body>
</html>