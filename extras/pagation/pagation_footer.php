<?php
 if(!isset($get_var)){ 
  $get_var = '';
  //variable for adding get variables to pagation
  } 
?>
<div class="row">
                            <div class="col-md-12">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination  justify-content-start">
    
    <li <?php if($page_no <= 1){ echo " class='disabled page-item'"; } else echo "class='page-item'"; ?>>
    <a class='page-link' <?php if($page_no > 1){ echo " href='?page_no=$previous_page$get_var'"; } ?>>Previous </a>
    </li>
       
    <?php 
    if ($total_no_of_pages <= 10){       
        for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
            if ($counter == $page_no) {
           echo "<li class='active page-item'><a class='page-link'>$counter</a></li>";  
                }else{
           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter$get_var'>$counter</a></li>";
                }
        }
    }
    elseif($total_no_of_pages > 10){
        
    if($page_no <= 4) {         
     for ($counter = 1; $counter < 8; $counter++){       
            if ($counter == $page_no) {
           echo "<li class='active page-item'><a>$counter</a></li>";  
                }else{
           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter$get_var'>$counter</a></li>";
                }
        }
        echo "<li><a>...</a></li>";
        echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last$get_var'>$second_last</a></li>";
        echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages$get_var'>$total_no_of_pages</a></li>";
        }

     elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {         
        echo "<li class='page-item'><a class='page-link' href='?page_no=1$get_var'>1</a></li>";
        echo "<li class='page-item'><a class='page-link' href='?page_no=2$get_var'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {         
           if ($counter == $page_no) {
           echo "<li class='active page-item'><a class='page-link'>$counter</a></li>";  
                }else{
           echo "<li><a class='page-link' href='?page_no=$counter$get_var'>$counter</a></li>";
                }                  
       }
       echo "<li><a>...</a></li>";
       echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last$get_var'>$second_last</a></li>";
       echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages$get_var'>$total_no_of_pages</a></li>";      
            }
        
        else {
        echo "<li class='page-item'><a class='page-link' href='?page_no=1$get_var'>1</a></li>";
        echo "<li class='page-item'><a class='page-link' href='?page_no=2$get_var'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
           echo "<li class='active page-item'><a>$counter</a></li>";  
                }else{
           echo "<li><a class='page-link' href='?page_no=$counter$get_var'>$counter</a></li>";
                }                   
                }
            }
    }
?>
    
    <li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled page-item'"; } else echo "class='page-item'"; ?>>
    <a class='page-link' <?php if($page_no < $total_no_of_pages) { echo "  href='?page_no=$next_page$get_var'"; } ?>>Next</a>
    </li>
    <?php if($page_no < $total_no_of_pages){
        echo "<li><a class='page-link' href='?page_no=$total_no_of_pages$get_var'>Last &rsaquo;&rsaquo;</a></li>";
        } ?>
</ul>
                                </nav>
                            </div>
                        </div>