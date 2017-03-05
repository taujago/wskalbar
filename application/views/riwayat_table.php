<ul class="responsive_table">
<li class="table_row">
                                                <div class="table_section">NO. BPKB</div>
                                                <div class="table_section_small">TGL. BPKB</div>
                                               <!--  <div class="table_section">NO. RANGKA</div>  -->
                                                <div class="table_section_small">STATUS</div> 
                                             </li>
 <?php  
foreach($arr as $index => $row) : 
 ?>
   <li class="table_row">
      <div class="table_section"><?php  echo $row->NO_BPKB ?></div>
      <div class="table_section_small"><?php  echo $row->TGL_BPKB ?></div>
     <!--  <div class="table_section"><?php  echo $row->NO_RANGKA ?></div>  -->
      <div class="table_section_small"><?php  echo $row->STATUS ?></div>   
   </li>
<?php 
endforeach;
?>                                              
</ul>
                                        