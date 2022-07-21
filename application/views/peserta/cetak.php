Nama : <?=$this->fungsi->user_login()->nama_peserta;?><br>
Alamat	: <?=$this->fungsi->user_login()->alamat;?>
<table border="1" width="100%">
          <thead>
          <tr>
            <th>No</th>
            <th>Pengajar</th>
            <th>Materi</th>
            <th>Nilai</th>
          </tr>
          </thead>
          <tbody id="showdata">
          <?php 
            if ($nilai->num_rows() > 0) {
              $no=1;
              foreach ($nilai->result_object() as $r) {?>
                <tr>
                  <td><?=$no?></td>
                  <td><?=$r->nama_pengajar?></td>
                  <td><?=$r->nama_materi?></td>
                  <td><?=$r->nilai?></td>
                </tr>
              <?php 
              $no++;
                }
              }else{
                ?>
                <tr>
                  <td colspan="4">Data Kosong</td>
                </tr>
              <?php
              }
              ?>
          </tbody>
          <tfoot>
          <tr>
            <th>No</th>
            <th>Pengajar</th>
            <th>Materi</th>
            <th>Nilai</th>
          </tr>
          </tfoot>
</table>