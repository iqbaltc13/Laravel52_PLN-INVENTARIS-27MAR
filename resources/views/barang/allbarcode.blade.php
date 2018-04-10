


<!DOCTYPE html>
<html>
<body>
  	<?php
$counter=0;
?>
@foreach($barang as $item)
<table border="2">
  <tr>
    <td><img src="http://suaraumumaceh.co.id/wp-content/uploads/2016/01/pln.jpg" width="143" height="167.5"></td>
    <td><center><b>PT PLN (Persero)</b><br/><b>Area Madiun<b></center></td>
    
  </tr>
  <tr>



    <td>  {{$item->nomor_inventaris}}   </td>
    <td>  <?php
echo $codbar[$counter];
$counter=$counter+1;
?>           </td>
    
  </tr>
  
</table>
<br>
@endforeach
</body>
</html>