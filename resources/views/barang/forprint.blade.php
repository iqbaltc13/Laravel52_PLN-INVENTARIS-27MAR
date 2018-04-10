<h4 align="left">PT.PLN (Persero)
<br>Distribusi Jawa Timur
<br>AREA MADIUN</h4>




<h2 align="center">Daftar Inventaris 
    <?php
    $flag=0;
  if(!empty($seb['area']))
  { $flag=1;
  ?>
  @foreach($area as $areas)
  Rayon {{$areas->nama_area}}
  @endforeach
  <?php
  }
  if(!empty($seb['ruang']))
  {

  ?>
  @foreach($ruang as $ruangs)
  Ruang {{$ruangs->nama_ruang}}
  @endforeach
  <?php
  }
  ?>
  <?php
  if(!empty($seb['sublokasi']))
  {
  ?>
  @foreach($sublokasi as $sublokasis)
  Sublokasi {{$sublokasis->nama_sub}}
  @endforeach
  <?php
  }
  ?>
  <?php
  if(!empty($seb['nama_barang']))
  {
  ?>
  nama barang "{{$seb['nama_barang']}}"
  <?php
  }
  ?>
    <?php
  if(!empty($seb['merek']))
  {
  ?>
  merek "{{$seb['merek']}}"
  <?php
  }
  ?>
</h2>
<?php
$counter=1;
?>


<table border="1" >
  <tr>
    <th>No.</th>
    <th>Nama Barang</th>
    <th>Merek</th>
    <th>Tahun</th>
    <th>Kode Inventaris</th>
    <th>Jum<br>lah</th>
     <th>Satuan</th>
    <th>Rayon</th>
    <th>Ruangan</th>
    <th>Sub<br>Lokasi</th>
    <th>Fisik</th>
    <th>Ket</th>
  </tr>
       @foreach($barang as $lala)
     @foreach($lala as $benda)
  <tr>



                <td>
                  <?php echo $counter;
                  $counter=$counter+1;
                  ?>
                </td>
             
                 
                 <td>
                    {{ $benda->nama_barang }}
      
                <td>
                    {{ $benda->merek }}
                </td>
                  <td>
                    {{ $benda->tahun }}
                </td>
                  <td>
                  {{$benda->nomor_inventaris}}
                </td>
                <td>
                    {{ $benda->jumlah }}
                </td>
                  <td>
                    {{ $benda->satuan }}
                </td>
                 <td>
                    {{ $benda->ruang->area->nama_area }}
                </td>
                <td>
                    {{ $benda->ruang->nama_ruang }}
                </td>
                  <td>
                    {{ $benda->sublokasi->nama_sub }}
                </td>
                <td>
                   {{ $benda->fisik }}
                </td>
               <td>
                   {{ $benda->keterangan }}
                </td>


          </tr>

    @endforeach
  @endforeach
 
</table>
