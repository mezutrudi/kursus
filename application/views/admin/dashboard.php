      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-body">
                Selamat Datang <b><?php
                if ($this->fungsi->user_login()->level == "1") {
                  echo $pengajar->nama_pengajar;
                  echo $this->fungsi->user_login()->nip;
                }else if ($this->fungsi->user_login()->level == "2") {
                  echo $peserta->nama_peserta;
                }else if ($this->fungsi->user_login()->level == "0") {
                  echo $this->fungsi->user_login()->username;
                }
                ?></b>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <?=$awal ?>
              </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
          </div>        </div></div>