<?= $javasc;?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span> Form Jembatan</h3>
              </div>
              <div class="panel-body">
                  <form action="#">
                      <div class="form-group">
                        <label for="namajembatan">Nama Jembatan</label>
                        <input type="text" class="form-control" id="namajembatan" placeholder="">
                        <input type="hidden" name="id_jembatan" id="id_jembatan" value="">
                      </div>
                      <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" class="form-control" id="keterangan"></textarea>
                      </div>
                      <div class="form-group">
                        <button type="button" name="simpanjembatan" id="simpanjembatan" class="btn btn-primary">Simpan</button>
                        <button type="button" name="resetjembatan"  id="resetjembatan" class="btn btn-warning">Reset</button>
                        <button type="button" name="updatejembatan" id="updatejembatan" class="btn btn-info" disabled="true">Update</button>
                      </div>
                  </form>
              </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-8">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> Daftar Jembatan</h3>
              </div>
              <div class="panel-body">
                  <table class="table table-bordered">
                      <th>No</th>
                      <th>Nama Jembatan</th>
                      <th>Keterangan</th>
                      <th></th>
                      <tbody id="daftarjembatan">
                          <?php
                          $no = 1;
                          foreach ($itemjembatan as $jembatan) {
                              ?>
                              <tr>
                                  <td><?php echo $no;?></td>
                                  <td><?php echo $jembatan->namajembatan;?></td>
                                  <td><?php echo $jembatan->keterangan;?></td>
                                  <td>
                                      <button type="button" class="btn btn-sm btn-info" data-idjembatan="<?php echo $jembatan->id_jembatan;?>" name="editjembatan<?php echo $jembatan->id_jembatan;?>" id="editjembatan"><span class="glyphicon glyphicon-edit"></span></button>
                                      <button type="button" class="btn btn-sm btn-danger" data-idjembatan="<?php echo $jembatan->id_jembatan;?>" name="deletejembatan<?php echo $jembatan->id_jembatan;?>" id="deletejembatan"><span class="glyphicon glyphicon-trash"></span></button>
                                  </td>
                              </tr>
                              <?php
                              $no++;
                          }
                           ?>
                      </tbody>
                  </table>
              </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click','#simpanjembatan',simpanjembatan)
    .on('click','#resetjembatan',resetjembatan)
    .on('click','#updatejembatan',updatejembatan)
    .on('click','#editjembatan',editjembatan)
    .on('click','#deletejembatan',deletejembatan);
    function simpanjembatan() {//simpan jembatan
        var datajembatan = {'namajembatan':$('#namajembatan').val(),
        'keterangan':$('#keterangan').val()};console.log(datajembatan);
        $.ajax({
            url : '<?php echo site_url("Jembatan/create");?>',
            data : datajembatan,
            dataType : 'json',
            type : 'POST',
            success : function(data,status){
                if (data.status!='error') {
                    $('#daftarjembatan').load('<?php echo current_url()." #daftarjembatan > *";?>');
                    resetjembatan();//form langsung dikosongkan pas selesai input data
                }else{
                    alert(data.msg);
                }
            },
            error : function(x,t,m){
                alert(x.responseText);
            }
        })
    }
    function resetjembatan() {//reset form jembatan
        $('#namajembatan').val('');
        $('#keterangan').val('');
        $('#id_jembatan').val('');
        $('#simpanjembatan').attr('disabled',false);
        $('#updatejembatan').attr('disabled',true);
    }
    function updatejembatan() {//update jembatan
        var datajembatan = {'namajembatan':$('#namajembatan').val(),
        'keterangan':$('#keterangan').val(),
        'id_jembatan':$('#id_jembatan').val()};console.log(datajembatan);
        $.ajax({
            url : '<?php echo site_url("Jembatan/update");?>',
            data : datajembatan,
            dataType : 'json',
            type : 'POST',
            success : function(data,status){
                if (data.status!='error') {
                    $('#daftarjembatan').load('<?php echo current_url()." #daftarjembatan > *";?>');
                    resetjembatan();
                }else{
                    alert(data.msg);
                }
            },
            error : function(x,t,m){
                alert(x.responseText);
            }
        })
    }
    function editjembatan() {//edit jembatan
        var id = $(this).data('idjembatan');
        var datajembatan = {'id_jembatan':id};console.log(datajembatan);
        $('input[name=editjembatan'+id+']').attr('disabled',true);
        $.ajax({
            url : '<?php echo site_url("Jembatan/edit");?>',
            data : datajembatan,
            dataType : 'json',
            type : 'POST',
            success : function(data,status){
                if (data.status!='error') {
                    $('input[name=editjembatan'+id+']').attr('disabled',false);
                    $('#simpanjembatan').attr('disabled',true);
                    $('#updatejembatan').attr('disabled',false);
                    $.each(data.msg,function(k,v){
                        $('#id_jembatan').val(v['id_jembatan']);
                        $('#namajembatan').val(v['namajembatan']);
                        $('#keterangan').val(v['keterangan']);
                    })
                }else{
                    alert(data.msg);
                    $('input[name=editjembatan'+id+']').attr('disabled',false);//disabled di set false, karena transaksi berhasil
                }
            },
            error : function(x,t,m){
                alert(x.responseText);
                $('input[name=editjembatan'+id+']').attr('disabled',false);//disabled di set false, karena transaksi berhasil
            }
        })
    }
    function deletejembatan() {//delete jembatan
        if (confirm("Anda yakin akan menghapus data jembatan ini?")) {
            var id = $(this).data('idjembatan');
            var datajembatan = {'id_jembatan':id};console.log(datajembatan);
            $.ajax({
                url : '<?php echo site_url("Jembatan/delete");?>',
                data : datajembatan,
                dataType : 'json',
                type : 'POST',
                success : function(data,status){
                    if (data.status!='error') {
                        $('#daftarjembatan').load('<?php echo current_url()." #daftarjembatan > *";?>');
                        resetjembatan();//form langsung dikosongkan pas selesai input data
                    }else{
                        alert(data.msg);
                    }
                },
                error : function(x,t,m){
                    alert(x.responseText);
                }
            })
        }
    }
</script>