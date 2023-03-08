<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Main</title>
</head>
<body>
   <div class="container">
       <h1 class="py-3">Home page</h1>
       <nav class="navbar navbar-expand-lg navbar-light bg-light">
           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav">
                   <li class="nav-item active">
                       <a class="nav-link" href="signup-form.php">SIGN UP</a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" href="login-form.php">LOG IN</a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" href="posts-form.php">ADD POST</a>
                   </li>
                   <li>
                       <a class="nav-link text-primary" href="all-posts.php">ALL POSTS</a>
                   </li>
                   <li>
                       <a class="nav-link text-danger" href="logout.php">LOG OUT</a>
                   </li>
               </ul>
           </div>
       </nav>
   </div>
</body>
</html>
