<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Bibliotec</title>
   <link rel="icon" type="image/x-icon" href="images/flat.png">
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<style>
        *{
         margin:0; 
   box-sizing: border-box;
   outline: none;

        }        
        body{
         font-family: 'Poppins', sans-serif;
            background-color: #b8a0fa;
            overflow-x: hidden;
            text-decoration: none;

        }
       
        .wrapper{
            height: 100vh;
            overflow: hidden;
        }
        ::-webkit-scrollbar{
   height: .5rem;
   width: 1rem;
}

::-webkit-scrollbar-track{
   background-color: transparent;
}

::-webkit-scrollbar-thumb{
   background-color:  #a868f1;
}

html{
   font-size: 62.5%;
   overflow-x: hidden;
}
.delete-btn,
.option-btn{
   display: block;
   width: 100%;
   margin-top: 1rem;
   border-radius:25px;
   text-decoration:none;
   padding:1rem 3rem;
   font-size: 1.7rem;
   text-transform: capitalize;
   color:#fff;
   cursor: pointer;
   text-align: center;
}


.delete-btn:hover,
.option-btn:hover{
   background-color: #333;
}                          


.option-btn{
   background-color:  #a868f1;
}

.delete-btn{
   background-color: #eb6c88;
}

.flex-btn{
   display: flex;
   gap:1rem;
}

.btn4{
   display: block;
   width: 100%;
   margin-top: 1rem;
   border-radius:25px;
   padding:1rem 3rem;
   font-size: 1.7rem;
   text-decoration:none;
   text-transform: capitalize;
   color:#fff;
   cursor: pointer;
   text-align: center;
}

.btn4{
   background-color:  #72a4ee;

}

header{
 display: flex;
 align-items: center;
 justify-content: space-between;
position: center;
 top:0; left:0; right:0;
  background-color:#fff;
  box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
z-index: 1000;
}

.heading{
   font-size: 1rem;
   color:#333;
   align-items: center;

   margin-bottom: 1rem;
   text-align: center;
   text-transform: uppercase;
}


.header .flex{
   display: flex;
   align-items: center;
   justify-content: space-between;
   position: relative;
}

.header .flex .logo{
   width: 120px;
   height: 120px;
   background: radial-gradient(50px, #600ae98c, transparent 50%);
   margin-top: -25px;
}



.header .flex .navbar a{
   margin:0 1rem;
   font-size: 2rem;
   list-style: none;
   text-decoration:none;
   color:#333;
   text-decoration: none;

}

li { list-style-type: none; } 
.header .flex .navbar ul ul{
   margin:0 1rem;
   font-size: 2rem;
   list-style: none;
   text-decoration:none;
   color:#333;
   text-decoration: none;
}
.header .flex .navbar a:hover{
   color:#8244e7;
}


.header .flex .icons > *{
   margin-left: 1rem;
   font-size: 2.5rem;
   text-decoration: none;
   cursor: pointer;
   color:#333;
}

.header .flex .icons > *:hover{
   color:#8244e7;
}

.header .flex .icons a span{
   font-size: 2rem;
   text-decoration: none;

}

.header .flex .profile{
   position: absolute;
   top:120%; right:2rem;
   background-color:#fff;
   border-radius: .5rem;
   box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
   border: .1rem solid #333;
   padding:2rem;
   width: 30rem;
   padding-top: 1.2rem;
   display: none;
   animation:fadeIn .2s linear;
}

.header .flex .profile.active{
   display: inline-block;
}

.header .flex .profile p{
   text-align: center;
   color:#333;
   font-size: 2rem;
   margin-bottom: 1rem;
}

#menu-btn{
   display: none;
}


        .content{
            display: flex;
            flex-wrap: wrap;
            margin-top:30px;
            justify-content: space-between;
            padding: 50px 100px 0;
        }
        .text{
            width: 45%;
            padding-right: 145x;
        }
        .text p{
            font-size: 29px;
            line-height: 46px;
            color: #080808;
        }
        .text p span{
            color: #7553f0;
        }
        .text .btn{
            position: relative;
            display: inline-block;
            font-size: 18px;
            text-transform: uppercase;
            color: #0f0e0e;
            text-decoration: none;
            padding: 18px 30px;
            letter-spacing: 2px;
            font-weight: 400;
            margin-top: 60px;
        }
        .text .btn:before{
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 60px;
            height: 60px;
            border-radius: 50px;
            background-color:  #d284e6;
            z-index: -1;
            transition: all ease 0.6s;
        }
        .text .btn:hover:before{
            width: 100%;}

        .img{
            position: relative;
            width: 500px;
            height: 500px;
            background: radial-gradient(520px, #600ae98c, transparent 50%);
            margin-top: -50px;
        }
        .email-icon{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .social-icons{
            height: 100%;
            animation: rotation 60s linear infinite;
        }
        @keyframes rotation {
            100%{
                transform: rotate(360deg);
            }
        }
        .social-icons img{
            position: absolute;
        }
        .social-icons img:nth-child(1){
            top: 0;
            left: 42%;
        }
        .social-icons img:nth-child(2){
            top: 25%;
            right: 0;
        }
        .social-icons img:nth-child(3){
            top: 70%;
            left: 70%;
        }
        .social-icons img:nth-child(4){
            top: 25%;
            left: 0;
        }
        .social-icons img:nth-child(5){
            top: 70%;
            left: 10%;
        }


@media (max-width:991px){

   html{
      font-size: 55%;
   }

}

@media (max-width:768px){

   #menu-btn{
      display: inline-block;
   }

   .header .flex .navbar{
      position: absolute;
      top:99%; left:0; right:0;
      border-top:  .1rem solid #333;
      border-bottom:  .1rem solid #333;
      background-color: #fff;
      transition: .2s linear;
      clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
   }

   .header .flex .navbar.active{
      clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
   }

   .header .flex .navbar a{
      display: block;
      margin:2rem;
   }



}

@media (max-width:450px){

   html{
      font-size: 50%;
   }

   .heading{
      font-size: 3rem;
   }

   .flex-btn{
      flex-flow: column;
      gap:0;
   }

   

}

    .logo img { width: 100px;}
        .wave{
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            line-height: 0;
        }
        .wave:before{
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url(images/wave1.svg) repeat-x;
            background-size: cover;
            background-position: -1000px 0;
            opacity: .2;
            animation: waveOne 60s linear infinite; 
        }
        @keyframes waveOne {
            50%{
                background-position: 0 0;
            }
        }
        .flex-btn{
   display: flex;
   gap:1rem;
}


                .wave:after{
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url(images/wave1.svg) repeat-x;
            background-size: cover;
            background-position: 2732px 0;
            opacity: .3;
            animation: waveOne 120s linear infinite; 
        }

        ul ul{
            max-width: 250px;
            position: absolute;
            padding: 10px 0;
            list-style: none;
            text-decoration:none;
            opacity: 0;
            z-index: -9999;
            transition: all ease 0.5s;
        }
        ul li:hover ul{
            opacity: 1;
            z-index: 9;
            padding: 30px 0;
        }
        ul li ul{
            margin: 0;
            list-style: none;
            text-decoration:none;  
            width: 100%;
        }
        ul li ul a{
            width: 100%;
            display: inline-block;
            list-style: none;
            text-decoration:none;
            padding: 20px;
            background-color: #a38bf8;
            color: #0f0707;
        }
        ul ul li:first-child a{
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        ul ul li:last-child a{
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        ul ul li a:hover{
            background-color: #6439ff;
            color: #0c0b0b;
}
    </style>

<?php include 'components/user_header.php'; ?>


    <div class="content">
        <div class="text">
            <p>A Bibliotec <span>Nossa Biblioteca Virtual </span> É o lugar em que você encontra todos os livros do acervo da Etec de Carapicuiba!.</p>
            
        </div>
        <div class="img">
            <div class="social-icons">
                <img src="images/e-book.png" alt="">
                <img src="images/e-book.png" alt="">
                <img src="images/e-book.png" alt="">
                <img src="images/e-book.png" alt="">
                <img src="images/e-book.png" alt="">
                
            </div>
            <img class="email-icon" src="images/ler.png" alt="">
        </div>
    </div>

<div class="wave">
    <img src="images/wave1.svg" alt="">
</div>

</div>











<script src="javascript/script2.js"></script>

<

</body>
</html>