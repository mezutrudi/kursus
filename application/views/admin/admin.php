<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <button id="btnAdd" data-toggle="modal" class="btn btn-block btn-primary" style="width: 150px"><i class="fas fa-plus-circle"></i> Tambah</button><br>
          <!-- <a href="<?=base_url('Peserta/formtpeserta')?>" class="btn btn-primary">Tambah</a> -->
          <table id="example1" class="table table-bordered table-striped" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama Admin</th>
                    <th>AKSI</th>
                  </tr>
                  </thead>
                  <tbody id="showdata">
                  <?php 
                    if ($admin->num_rows() > 0) {
                      $no=1;
                      foreach ($admin->result_object() as $r) {?>
                        <tr>
                          <td><?=$no?></td>
                          <td><?=$r->username?></td>
                          <td><?=$r->nama_admin?></td>
                          <td>
                            <button id="btnEdit" data-toggle="modal" class="btn btn-info item-edit" data-id_admin="<?=$r->id_admin?>" data-username="<?=$r->username?>" data-nama="<?=$r->nama_admin?>" data-nohp="<?=$r->no_hp?>" title="Ubah"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger item-delete" data-id="<?=$r->id_admin?>" data-uname="<?=$r->username?>" title="Hapus"><i class="fas fa-trash"></i></button>
                                <button class="btn btn-warning password" data-id="<?=$r->id_users?>" data-username="<?=$r->username?>" title="Reset Password"><i class="fas fa-key"></i></button></td>
                        </tr>
                      <?php 
                      $no++;
                        }
                      }else{
                        ?>
                        <tr>
                          <td colspan="3">Data Kosong</td>
                        </tr>
                      <?php
                      }
                      ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama Admin</th>
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
                <input type="hidden" name="id_admin" id="id_admin" class="form-control">
              <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Admin">
            </div>         
          </div>
          <div class="row">
            <div class="col-12">
              <label for="nohp">No Hp</label>
                <input type="text" name="nohp" id="nohp" class="form-control" placeholder="No HP" value="">
            </div>          
          </div>
          <div class="row">
            <div class="col-6">
              <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="">
            </div> 
            <div class="col-6">
              <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="">
                <input type="hidden" name="level" id="level" class="form-control" placeholder="Password" value="0">
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
<div id="myModal1" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Modal title</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
          <form id="myForm" action="" method="post" class="form-horizontal">
          <div class="row">
            <div class="col-6">
                <input type="hidden" name="id_users" id="id_users">
              <label for="username">Username</label>
                <input type="text" name="username1" id="username1" class="form-control" placeholder="Username" value="">
            </div> 
            <div class="col-6">
              <label for="password">Password</label>
                <input type="password" name="password1" id="password1" class="form-control" placeholder="Password Baru" value="">
            </div>          
          </div><br>

          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="button" id="btnSaveP" class="btn btn-primary"></button>
      </div>
    </div>
  </div>
</div>
<script>
  $(function(){
    $('#btnAdd').click(function(){
      $('#nama').val("");
      $('#nohp').val("");
      $('#username').val("");
      $('#password').val("");
      $('#id_admin').val("");
      $('#myModal').modal('show');
      $('#myModal').find('.modal-title').text('Tambah Data Admin');
      $('#btnSave').text('SIMPAN');
    });
    //Edit
    $('#showdata').on('click', '.item-edit', function(){
      var id_admin = $(this).data("id_admin");
      var nama = $(this).data("nama");
      var nohp = $(this).data("nohp");
      var username = $(this).data("username");
      $('#nama').val(nama);
      $('#nohp').val(nohp);
      $('#username').val(username);
      $('#password').val("");
      $('#id_admin').val(id_admin);
      $('#myModal').modal('show');
      $('#myModal').find('.modal-title').text('Edit Data Peserta');
      $('#btnSave').text('EDIT');
    });
    $('#showdata').on('click', '.password', function(){
      var id = $(this).data("id");
      var username = $(this).data("username");
      $('#id_users').val(id);
      $('#username1').val(username);
      $('#password1').val("");
      $('#myModal1').modal('show');
      $('#myModal1').find('.modal-title').text('Reset Password');
      $('#btnSaveP').text('RESET');
    });

    $('#btnSaveP').click(function(){
      var password = $('#password1').val();
      var id = $('#id_users').val();
      var tombol = $(this).text();

      if (tombol == 'RESET') {
        if (password == "") {
          Swal.fire('Password Belum Diisi');
        }else{
          $.ajax({
            type:'POST',
            url: '<?=base_url().'Administrator/ubahPassword' ?>',
            data: {
              id: id,
              password: password,
            },
            success: function(data){
              $('#myModal').modal('hide');
              Swal.fire({
                title: 'Sukses',
                text: 'Password Berhasil diubah',
                icon: 'success',
                timer: 2000
              });
              // TampilKelas();
              window.location="<?=base_url('Administrator')?>";
            },
            error: function(data){
              Swal.fire('Username sudah tersedia..');
            }
          });
        }
      }
    });


    $('#btnSave').click(function(){
      var nama = $('#nama').val();
      var nohp = $('#nohp').val();
      var username = $('#username').val();
      var password = $('#password').val();
      var level = $('#level').val();
      var id_admin = $('#id_admin').val();
      var tombol = $(this).text();

      var tombol = $(this).text();

      if (tombol == 'SIMPAN') {
        if (nama == "") {
          Swal.fire('Nama Harus Diisi');
        }else if (nohp == "") {
          Swal.fire('NO. HP Harus Diisi');
        }else{
          $.ajax({
            type:'POST',
            url: '<?=base_url().'Administrator/tambah' ?>',
            data: {
              nama: nama,
              nohp: nohp,
              username: username,
              password: password,
              level: level,
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
              window.location="<?=base_url('Administrator')?>";
            },
            error: function(data){
              Swal.fire('Username sudah tersedia..');
            }
          });
        }
      }else{
        $.ajax({
          type:'POST',
          url: '<?=base_url().'Administrator/ubah' ?>',
          data: {
            nama: nama,
            nohp: nohp,
            username: username,
            password: password,
            level: level,
            id_admin: id_admin,
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
            window.location="<?=base_url('Administrator')?>";
          }
        });
      }
    });

    //delete- 
    $('#showdata').on('click', '.item-delete', function(){
      var id_admin = $(this).data("id");
      var uname = $(this).data("uname");
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
            url: '<?php echo base_url() ?>Administrator/hapus',
            data:{
              id_admin:id_admin,
              uname:uname
            },
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
                window.location="<?=base_url('Administrator')?>";
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