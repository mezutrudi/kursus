<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Pengajar</th>
                    <th>Materi</th>
                    <th>Nilai</th>
                    <th>AKSI</th>
                  </tr>
                  </thead>
                  <tbody id="showdata">
                  <?php 
                    if ($nilai->num_rows() > 0) {
                      $no=1;
                      foreach ($nilai->result_object() as $r) {?>
                        <tr>
                          <td><?=$no?></td>
                          <td><?=$r->nama_peserta?></td>
                          <td><?=$r->nama_pengajar?></td>
                          <td><?=$r->nama_materi?></td>
                          <td><?=$r->nilai?></td>
                          <td>
                            <button id="btnEdit" data-toggle="modal" class="btn btn-info item-edit" title="Ubah" data-id_nilai="<?=$r->id_nilai?>" data-nama="<?=$r->nama_peserta?>" data-materi="<?=$r->nama_materi?>" data-nilai="<?=$r->nilai?>"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger item-delete" data="<?=$r->id_nilai?>" title="Hapus"><i class="fas fa-trash"></i></button></td></td>
                        </tr>
                      <?php 
                      $no++;
                        }
                      }else{
                        ?>
                        <tr>
                          <td colspan="6">Data Kosong</td>
                        </tr>
                      <?php
                      }
                      ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Pengajar</th>
                    <th>Materi</th>
                    <th>Nilai</th>
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
          <div class="row">
            <div class="col-12">
                <input type="hidden" name="id_nilai" id="id_nilai" class="form-control">
              <label for="nama">Peserta</label>
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Peserta" disabled>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <label for="materi">Materi</label>
                <input type="text" name="materi" id="materi" class="form-control" placeholder="materi" value="" disabled>
            </div>  
            <div class="col-6">
              <label for="nilai">Nilai</label>
                <input type="number" name="nilai" id="nilai" class="form-control" placeholder="nilai" value="">
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
    //Edit
    $('#showdata').on('click', '.item-edit', function(){
      var id_nilai = $(this).data("id_nilai");
      var nama = $(this).data("nama");
      var materi = $(this).data("materi");
      var nilai = $(this).data("nilai");
      $('#nama').val(nama);
      $('#materi').val(materi);
      $('#nilai').val(nilai);
      $('#id_nilai').val(id_nilai);
      $('#myModal').modal('show');
      $('#myModal').find('.modal-title').text('Edit Data Nilai');
      $('#btnSave').text('EDIT');
    });


    $('#btnSave').click(function(){
      var nama = $('#nama').val();
      var materi = $('#materi').val();
      var nilai = $('#nilai').val();
      var id_nilai = $('#id_nilai').val();
      var tombol = $(this).text();

      var tombol = $(this).text();

      if (tombol == 'EDIT') {
        if (nilai == "") {
          Swal.fire('Nilai Harus Diisi');
        }else{
          $.ajax({
            type:'POST',
            url: '<?=base_url().'Penilaian/ubahnilaikelas' ?>',
            data: {
              nama: nama,
              materi: materi,
              nilai: nilai,
              id_nilai: id_nilai,
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
              window.location="<?=base_url('Penilaian/lihatnilai')?>";
            }
          });
        }
      }
    });

    //delete- 
    $('#showdata').on('click', '.item-delete', function(){
      var id_nilai = $(this).attr('data');
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
            url: '<?php echo base_url() ?>Penilaian/hapusnilaikelas',
            data:{id_nilai:id_nilai},
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
                window.location="<?=base_url('Penilaian/lihatnilai')?>";
              }else{
                alert('Error');
              }
            },
            error: function(){
              Swal.fire('Error');
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