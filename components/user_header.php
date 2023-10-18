<?php
  if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

   <img src="images/ler.png"  class="logo">

      <nav class="navbar">
      
      
         <a href="home.php">Home</a>
         <a href="about.php">Sobre Nós</a>
         
         <a href="orders.php">Agendamentos</a>
         <a href="shop.php">Estante</a>
         <a href="contact.php">Contato</a>

      </nav>

      <div class="icons">
         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="search_page.php"><i class="fas fa-magnifying-glass"></i></a>
         <a href="wishlist.php"><i class="fa-regular fa-bookmark"></i><span>(<?= $total_wishlist_counts; ?>)</span></a>
         <a href="cart.php"><i class="fas fa-book-open-reader"></i><span>(<?= $total_cart_counts; ?>)</span></a>
         <div id="user-btn" class="fa-regular fa-user"></div>
      </div>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile["name"]; ?></p>
         <a href="update_user.php" class="btn4">Atualizar Perfil</a>

         <div class="flex-btn">
         <a href="user_register.php" class="option-btn">Cadastar-se</a>
            <a href="user_login.php" class="option-btn">Login</a>
         </div>
         <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('Sair da bibliotca?');">logout</a> 
         <?php
            }else{
         ?>
         <p>Faça login ou cadastro antes!</p>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">Cadastrar-se</a>
            <a href="user_login.php" class="option-btn">Login</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>