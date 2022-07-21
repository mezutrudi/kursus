<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <a href="<?=base_url('Nilaipeserta/cetak')?>" class="btn btn-primary" style="float: right;">Cetak</a><br><br>
          <table class="table table-bordered table-striped" width="100%">
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
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <?=$awal ?>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    </div>        </div></div>
