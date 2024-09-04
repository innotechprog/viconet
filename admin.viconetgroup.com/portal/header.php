  <div class="page-header">
   <div class="search-form">
      <form action="#" method="GET">
         <div class="input-group">
            <input class="form-control search-input" name="search" placeholder="Type something..." type="text"/>
            <span class="input-group-btn">
            <span id="close-search"><i class="ion-ios-close-empty"></i></span>
            </span>
         </div>
      </form>
   </div>
   <!--================================-->
   <!-- Page Header  Start -->
   <!--================================-->
   <nav class="navbar navbar-expand-lg">
      <ul class="list-inline list-unstyled mg-r-20">
         <!-- Mobile Toggle and Logo -->
         <li class="list-inline-item align-text-top"><a class="hidden-md hidden-lg" href="#" id="sidebar-toggle-button"><i class="ion-navicon tx-20"></i></a></li>
         <!-- PC Toggle and Logo -->
         <li class="list-inline-item align-text-top"><a class="hidden-xs hidden-sm" href="#" id="collapsed-sidebar-toggle-button"><i class="ion-navicon tx-20"></i></a></li>
      </ul>
      <!--================================-->
      <!-- Mega Menu Start -->
      <!--================================-->
      <div class="collapse navbar-collapse">
         <ul class="navbar-nav mr-auto">
          
           
         </ul>
      </div>
      <!--/ Mega Menu End-->
      <!--/ Brand and Logo End -->
      <!--================================-->
      <!-- Header Right Start -->
      <!--================================-->
      <div class="header-right pull-right">
         <ul class="list-inline justify-content-end">
            <li class="list-inline-item align-middle"><a  href="#" id="search-button"><i class="ion-ios-search-strong tx-20"></i></a></li>               
           
            
            <!--================================-->
            <!-- Profile Dropdown Start -->
            <!--================================-->
            <li class="list-inline-item dropdown">
                <span class="select-profile" style="margin-top:-5px">
               <?php echo $staff->getSurname().' '.$staff->getName(); ?></span>
               <a  href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php 
                  if(empty($staff->getPP()))
                  {
                     ?>
         			    <label class="header-pp" id=""> <?php echo substr(strtoupper($staff->getName()),0,1).substr(strtoupper($staff->getSurname()),0,1); ?></label>
                      <?php
                   }
                   else{
                        ?>
                         <img src="assets/images/<?php echo $staff->getPP(); ?>" class="img-fluid wd-35 ht-35 rounded-circle" alt="">
                         <?php
                      }
                      ?>
			   </a>
               <div class="dropdown-menu dropdown-menu-right dropdown-profile shadow-2">
                  <div class="user-profile-area">
                     <div class="user-profile-heading">
                        <div class="profile-thumbnail">

                           <img src="https://via.placeholder.com/100x100" class="img-fluid wd-35 ht-35 rounded-circle" alt="">
                        </div>
                        <div class="profile-text">
                           <h6><?php echo $staff->getSurname().' '.$staff->getName(); ?></h6>
                           <span><?php echo $staff->getPos() ?></span>
                        </div>
                     </div>
                     <a href="profile" class="dropdown-item"><i class="icon-user" aria-hidden="true"></i> My profile</a>
                    
                     <a href="" class="dropdown-item"><i class="icon-settings" aria-hidden="true"></i> settings</a>
                  
                    
                    
                     <a href="logout" class="dropdown-item"><i class="icon-power" aria-hidden="true"></i> Sign-out</a>
                  </div>
               </div>
            </li>
            <!-- Profile Dropdown End -->
            
         </ul>
      </div>
      <!--/ Header Right End -->
   </nav>
</div>
<!--/ Page Header End -->
<!--================================-->