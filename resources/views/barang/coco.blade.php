

   <table border="2">
  <tr>
      <th>Kode Inventaris</th>
    <th>Nama Barang</th>
    <th>Merek</th>
    <th>Tahun</th>
    <th>Jumlah</th>
     <th>Satuan</th>
    <th>Area</th>
    <th>Ruangan</th>
    <th>Fisik</th>
    <th>Keterangan</th>
  </tr>
 
 @foreach($barang as $barangs)
  <tr>

                <td>
            {{$barangs->id_barang}}
                </td>
                 
                 <td>
             {{$barangs->nama_barang}}
                 </td>

     
                <td>
               {{$barangs->merek}}
                </td>
                  <td>
                {{$barangs->tahun}}
                </td>
                <td>
             {{$barangs->jumlah}}
                </td>
                  <td>
      {{$barangs->satuan}}
                </td>
                  <td>
 {{$barangs->ruang->area->nama_area}}
                </td>
                 <td>
 {{$barangs->ruang->nama_ruang}}
                </td>
                <td>
    {{$barangs->fisik}}
                </td>
                <td>
   {{$barangs->keterangan}}
                </td>

       
 
   </tr>
   @endforeach
   



  
 
</table>

</div>
      </div>
    </div>
  </div>
</div>