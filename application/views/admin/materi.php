<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <button id="btnAdd" data-toggle="modal" class="btn btn-block btn-primary" style="width: 150px"><i class="fas fa-plus-circle"></i> Tambah</button><br>
          <table id="example1" class="table table-bordered table-striped" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Kelas</th>
                    <th>Nama Materi</th>
                    <th>AKSI</th>
                  </tr>
                  </thead>
                  <tbody id="showdata">
                  <?php 
                    if ($materi->num_rows() > 0) {
                      $no=1;
                      foreach ($materi->result_object() as $r) {?>
                        <tr>
                          <td><?=$no?></td>
                          <td><?=$r->nip?></td>
                          <td><?=$r->id_kelas?></td>
                          <td><?=$r->nama_materi?></td>
                          <td>
                            <button id="btnEdit" data-toggle="modal" class="btn btn-info item-edit" title="Ubah" data-id="<?=$r->id_materi?>" data-nip="<?=$r->nip?>" data-kelas="<?=$r->id_kelas?>" data-nama_materi="<?=$r->nama_materi?>"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger item-delete" data="<?=$r->id_materi?>" title="Hapus"><i class="fas fa-trash"></i></button></td></td>
                        </tr>
                      <?php 
                      $no++;
                        }
                      }else{
                        ?>
                        <tr>
                          <td colspan="5"><center>Data Kosong</center></td>
                        </tr>
                      <?php
                      }
                      ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Kelas</th>
                    <th>Nama Materi</th>
                    <th>AKSI</th>
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
<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Modal title</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
          <form id="myForm" action="" method="post" class="form-horizontal">
          <input type="hidden" name="id" id="id" class="form-control">
          <div class="row">
            <div class="col-12">
              <label for="nip">Pengajar</label>
              <select name="nip" id="nip" class="form-control">
                <option value="">-- Pilih Pengajar : --</option>
                <?php foreach($pengajar->result_object() as $s) { ?>
                <option value="<?=$s->nip?>"><?=$s->nama_pengajar?></option>
                <?php } ?>
              </select>
            </div>  
            <div class="col-12">
              <label for="kelas">Nama Kelas</label>
              <select name="kelas" id="kelas" class="form-control">
                <option value="">-- Pilih Kelas : --</option>
                <?php foreach($kelas->result_object() as $k) { ?>
                <option value="<?=$k->id_kelas?>"><?=$k->nama_kelas?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-12">
              <label for="materi">Nama Materi</label>
                <input type="text" name="materi" id="materi" class="form-control" placeholder="Nama Materi">
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
    $('#btnAdd').click(function(){
      $('#id').val("");
      $('#nip').val("");
      $('#kelas').val("");
      $('#materi').val("");
      $('#myModal').modal('show');
      $('#myModal').find('.modal-title').text('Tambah Data Materi');
      $('#btnSave').text('SIMPAN');
    });
    //Edit
    $('#showdata').on('click', '.item-edit', function(){
      var id = $(this).data("id");
      var nip = $(this).data("nip");
      var kelas = $(this).data("kelas");
      var materi = $(this).data("nama_materi");
      $('#nip').val(nip);
      $('#kelas').val(kelas);
      $('#materi').val(materi);
      $('#id').val(id);
      $('#myModal').modal('show');
      $('#myModal').find('.modal-title').text('Edit Data Materi');
      $('#btnSave').text('EDIT');
    });


    $('#btnSave').click(function(){
      var nip = $('#nip').val();
      var id_kelas = $('#kelas').val();
      var materi = $('#materi').val();
      var id = $('#id').val();
      var tombol = $(this).text();

      var tombol = $(this).text();

      if (tombol == 'SIMPAN') {
        if (nip == "") {
          Swal.fire('NIP Harus Diisi');
        }else if (kelas == "") {
          Swal.fire('Kelas Harus Diisi');
        }else{
          $.ajax({
            type:'POST',
            url: '<?=base_url().'Materi/tambah' ?>',
            data: {
              nip: nip,
              id_kelas: id_kelas,
              nama_materi: materi,
            },
            success: function(data){
              $('#myModal').modal('hide');
              Swal.fire({
                title: 'Sukses',
                text: 'Data Berhasil diubah',
                icon: 'success',
                timer: 2000
              });
              // TampilKelas();
              window.location="<?=base_url('Materi')?>";
            }
          });
        }
      }else{
        $.ajax({
          type:'POST',
          url: '<?=base_url().'Materi/ubah' ?>',
          data: {
            nip: nip,
            id_kelas: id_kelas,
            nama_materi: materi,
            id_materi: id,
          },
          success: function(data){
            $('#myModal').modal('hide');
            Swal.fire({
              title: 'Sukses',
              text: 'Data Berhasil diubah',
              icon: 'success',
              timer: 2000
            });
            // TampilKelas();
            window.location="<?=base_url('Materi')?>";
          }
        });
      }
    });

    //delete- 
    $('#showdata').on('click', '.item-delete', function(){
      var id = $(this).attr('data');
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
            url: '<?php echo base_url() ?>Materi/hapus',
            data:{id:id},
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
                window.location="<?=base_url('Materi')?>";
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