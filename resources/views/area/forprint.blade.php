<h4 align="left">PT.PLN (Persero)
<br>Distribusi Jawa Timur
<br>AREA MADIUN</h4>


<h2 align="center">Daftar Inventaris Rayon {{$area->nama_area}}  </h2>


 
<table border="1" align="center">
  <tr>
    <th>Kode Inventaris</th>
    <th>Nama Barang</th>
    <th>Merek</th>
    <th>Tahun</th>
    <th>Jumlah</th>
     <th>Satuan</th>
    <th>Ruangan</th>
    <th>Fisik</th>
    <th>Keterangan</th>
  </tr>
     @foreach($barang as $benda)
  <tr>



   
               <td>
                  {{$benda->nomor_inventaris}}
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
                    {{ $benda->jumlah }}
                </td>
                  <td>
                    {{ $benda->satuan }}
                </td>
                <td>
                    {{ $benda->ruang->nama_ruang }}
                </td>
                <td>
                   {{ $benda->fisik }}
                </td>
                <td>
                    {{ $benda->keterangan }}
                </td>


          </tr>

    @endforeach
  
 
</table>
