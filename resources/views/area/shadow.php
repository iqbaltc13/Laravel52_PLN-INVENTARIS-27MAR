

<html>
    <head>
        <title>My Laravel</title>
    </head>
    <body>
        <div>
            <div>
                <a href="barang/create">Tambah</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Merek</th>
                        <th>Tahun</th>
                        <th>Nomor Inventaris</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Fisik</th>
                        <th>Keterangan<th>
                    </tr>
                </thead>
            <tbody>
             <?php   $counter=1; ?>
            @foreach ( $barang as $item )
            <tr>
                <td>
                    {{ $counter }}
                </td>
                <td>
                    {{ $item->nama_barang }}
                </td>
                <td>
              
                   <img src="{{URL::to(substr($item->gambar,0))}}" style="width:50%">
                </td>
                <td>
                    {{ $item->merek }}
                </td>
                  <td>
                    {{ $item->tahun }}
                </td>
                <td>
                    {{ $item->nomor_inventaris }}
                </td>
                <td>
                    {{ $item->jumlah }}
                </td>
                  <td>
                    {{ $item->satuan }}
                </td>
                 <td>
                    {{ $item->fisik }}
                </td>
                <td>
                    {{ $item->keterangan }}
                </td>
                <td>
                    <a href="barang/update/{{ $item['id_barang'] }}">Ubah</a>
                    <a href="barang/delete/{{ $item['id_barang'] }}">Hapus</a>
                </td>
            </tr>
            <?php   $counter++; ?>
            @endforeach

            </tbody>
            </table>   
        </div>
    </body>
</html>