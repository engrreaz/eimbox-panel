<?php 
    include 'inc.php'; 
    
?>
<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="css.css?v=a3">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
    <style>
        .pic{
            width:80px; height:80px; padding:1px; border-radius:50%; border:3px solid var(--light);
        }
        
        .a{font-size:24px; font-weight:700; font-style:normal; line-height:18px; color:var(--dark);}
        .b{font-size:20px; font-weight:500; font-style:normal; line-height:22px; margin-top:5px;}
        .c{font-size:11px; font-weight:500; font-style:italic; line-height:12px; padding:3px;}
        .d{font-size:20px; font-weight:500; font-style:normal; line-height:22px; color:var(--darker);}
        
        
        .e{font-size:11px; font-weight:500; font-style:italic; line-height:11px; color:gray;}
        .ico{font-size:24px; color:var(--dark); }
    </style>
</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>
    <div class="containerx" style="width:100%;" >
        
           

        
        
        
        
    </div>
    
    <div class="container" style="width:100%;">
        <?php
            

            
            if($usr == ''){
                include 'index_guest.php';
            } else {
               // include 'index_teacher.php';
                
                if($userlevel=='Guest'){
                    include 'index_guest.php';
                } else if($userlevel=='Student'){
                    include 'index_student.php';
                } if($userlevel=='Teacher' || $userlevel=='Asstt. Teacher' || $userlevel=='Asstt. Head Teacher' || $userlevel=='Head Teacher' || $userlevel=='Administrator'|| $userlevel=='Super Administrator' ){
                    include 'index_teacher.php'; 
                    
                } else {
                    include 'index_undef.php';
                }
            }
        ?>
        
    </div>
    
    

  </main>
  <footer>

  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  
  <script>
    function go(id){
        alert(id);
        window.location.href="friend.php?id=" + id; 
    }  
    
    
    
    
        
  </script>
    
    
  
</body>

</html>