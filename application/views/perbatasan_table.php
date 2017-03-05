<h2>Jumlah Data = <?php echo $arr->num_rows(); ?>  </h2>

<ul class="responsive_table">
<li class="table_row">
<!-- <div class="table_section_small">NO. POLISI </div> -->
<div class="table_section">DATA </div>
<!-- <div class="table_section_small">NAMA PEMILIK</div>
 --></li>
                                               
 <?php  
 $total = 0 ;
foreach($arr->result() as   $row) : 
 $total++;

 
// var_dump($row);
 ?>
   <li class="table_row">
      <!-- <div class="table_section_small"><?php echo $row->NOPOL; ?></div> -->
      <div class="table_section">
      <?php echo "$total. NOMOR POLISI : " .$row->NOPOL. "<BR /> NO. RANGKA :  " .$row->NO_RANGKA
      . "<BR /> NAMA PEMILIK : " .$row->NAMA_PEMILIK; ?></div>
      <!-- <div class="table_section_small"><?php echo $row->NAMA_PEMILIK; ?></div> -->
   </li>
<?php 
endforeach;
?>     

</ul>                    
