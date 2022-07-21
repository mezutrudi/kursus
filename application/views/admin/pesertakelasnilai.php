<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <!-- Default box -->
      <div class="card">
        <div class="card-body"><a href="<?=base_url('Penilaian')?>" class="btn btn-success"><i class="fas fa-arrow-left"></i> Back</a><br><br>
          <form action="<?=base_url('Penilaian/add')?>" method="post">
            <select name="materi" id="materi" class="form-control">
                <option value="">--Pilih Materi--</option>
              <?php
              if ($peserta->num_rows() > 0) {
                foreach ($materi->result_object() as $m){ ?>
                  <option value="<?=$m->id_materi?>"><?=$m->nama_materi?></option>
               <?php }
              }else{
                ?>
                <option value="">--Tidak Ada Materi--</option>
             <?php } ?>            
            </select><br>
          <table class="table table-bordered table-striped" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th width="35%">Nilai</th>
                  </tr>
                  </thead>
                  <tbody id="showdata">
                  <?php 
                    if ($peserta->num_rows() > 0) {
                      $no=1;
                      foreach ($peserta->result_object() as $r) { $kelas=$r->id_kelas;?>
                        <tr>
                          <td><?=$no?></td>
                          <td><?=$r->nama_peserta?></td><input type="hidden" name="peserta[]" id="peserta" value="<?=$r->id_peserta?>">
                          <td><input type="number" name="nilai[]" id="nilai" class="form-control"></td>
                        </tr>
                      <?php 
                      $no++;
                        }
                      }else{
                        ?>
                        <tr>
                          <td colspan="5">Data Kosong</td>
                        </tr>
                      <?php
                      }
                      ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Nilai</th>
                  </tr>
                  </tfoot>
                </table>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <?=$awal ?>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    </div>        </div></div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Modal title</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
          <form id="myForm" action="" method="post" class="form-horizontal">
          <div class="row">
            <div class="col-12">
                <input type="hidden" name="id_peserta" id="id_peserta" class="form-control">
              <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Peserta">
            </div>         
          </div>
          <div class="row col-12">
              <label for="alamat">Alamat</label>
              <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat"></textarea>
          </div>
          <div class="row">
            <div class="col-12">
              <label for="nohp">No Hp</label>
                <input type="text" name="nohp" id="nohp" class="form-control" placeholder="No HP" value="">
            </div>          
          </div><br>

          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="button" id="btnSave" class="btn btn-primary"></button>
      </div>
    </div>
  </div>
</div>
<script>
  $(function(){
    $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
    //Money Euro
    $('[data-mask]').inputmask()

    //delete- 
    $('#showdata').on('click', '.item-delete', function(){
      var id_kp = $(this).data("id_kp");
      var kelas = $(this).data("kelas");
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data yang terhapus tidak dapat dikembalikan !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: 'ajax',
            method: 'get',
            async: false,
            url: '<?php echo base_url() ?>Kelaspeserta/hapus',
            data:{id_kp:id_kp},
            dataType: 'json',
            success: function(response){
              if(response.success){
                $('#deleteModal').modal('hide');
                // $('.alert-success').html('Employee Deleted successfully').fadeIn().delay(4000).fadeOut('slow');
                Swal.fire({
                  title: 'Sukses!',
                  text: 'Data Berhasil Terhapus',
                  icon: 'success',
                  timer: 2000
                });
                // TampilKelas();
                window.location="<?=base_url('kelaspeserta/pesertakelas/'.$kelas)?>";
              }else{
                alert('Error');
              }
            },
            error: function(){
              Swal.fire('Error');
              // alert('Hapus Setting Wali Kelas Terlebih Dahulu');
            }
          });
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          Swal.fire({
            title: 'Dibatalkan',
            text: 'Data Anda masih Aman :)',
            icon: 'error',
            timer: 2000
          });
        }
      });
    });

  });
</script>