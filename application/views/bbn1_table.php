<ul class="responsive_table">
<li class="table_row">
                                                <div class="table_section">JENIS </div>
                                                <div class="table_section_small">JUMLAH</div>
                                               
 <?php  
 $total = 0 ;
foreach($arr->result() as   $row) : 
  $total += $row->jumlah;
if($row->jenis=="") continue;
// var_dump($row);
 ?>
   <li class="table_row">
      <div class="table_section"><?php  echo $row->jenis ?></div>
      <div class="table_section_small"><?php echo ribuan($row->jumlah) ?></div>
     
   </li>
<?php 
endforeach;
?>     
<li class="table_row">
      <div class="table_section">TOTAL  </div>
      <div class="table_section_small"><?php  echo ribuan($total) ?></div>
     
   </li>                                         
</ul>
                                        