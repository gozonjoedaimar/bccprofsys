<?php defined('BASEPATH') OR exit('No direct script access allowed');

$listing = $this->notifications->listing(5);
?>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">

            	  <?php if ($listing) : ?>


            	  	<?php foreach ($listing as $notif) : ?>
	                  <li>
	                    <a href="<?php echo "#!"; ?>">
	                      <i class="fa <?php echo isset($notif['icon']) ? $notif['icon']:"fa-info-circle" ?> text-<?php echo isset($notif['color']) ? $notif['color']: "grey"; ?>"></i> <?php echo isset($notif['message']) ? $notif['message']: "No message" ?>
	                    </a>
	                  </li>
            	  	<?php endforeach; ?>

            	  <?php else: ?>
	                  <li>
	                    <a href="<?php echo "#!"; ?>">
	                      <i class="fa <?php echo "fa-info-circle" ?> text-<?php echo "grey"; ?>"></i> <?php echo "No message found" ?>
	                    </a>
	                  </li>
            	  <?php endif; ?>

                  <!-- <li>
                    <a href="#">
                      <i class="fa fa-area-chart text-aqua"></i> Grades were updated
                    </a>
                  </li> -->
                  <!-- <li>
                    <a href="#">
                      <i class="fa fa-book text-yellow"></i> Subject schedule was updated
                    </a>
                  </li> -->
                  <!-- <li>
                    <a href="#">
                      <i class="fa fa-slideshare text-blue"></i> New Teacher has been added
                    </a>
                  </li> -->
                  <!-- <li>
                    <a href="#">
                      <i class="fa fa-area-chart text-aqua"></i> Grades were updated
                    </a>
                  </li> -->
                  <!-- <li>
                    <a href="#">
                      <i class="fa fa-slideshare text-blue"></i> New Teacher has been added
                    </a>
                  </li> -->
                  <!-- <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li> -->
                  <!-- <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li> -->
                  <!-- <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li> -->
                  <!-- <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li> -->
                </ul>