<div class="container-fluid">
  <div class="row">
          <?php foreach($kelas->result_object() as $r) { ?>
          <div class="col-lg-4 col-6">
              <!-- small card -->
              <a href="<?=base_url('Penilaian/pesertakelas/'.$r->id_kelas)?>" title="<?=$r->nama_kelas?>">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?=$r->nama_kelas?></h3>
                    <br>
                    <p>kkk</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                  </div>
                </div>
            </a>
          </div>
          <?php } ?>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <?=$awal ?>
        </div>
        <!-- /.card-footer-->
      </div>