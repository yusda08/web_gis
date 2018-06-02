<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo $javasc;
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span> Form Jalan</h3>
                </div>
                <div class="panel-body">
                    <form action="#">
                        <div class="form-group">
                            <label for="namajalan">Nama Jalan</label>
                            <input type="text" class="form-control" id="namajalan" placeholder="">
                            <input type="hidden" name="id_jalan" id="id_jalan" value="">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" class="form-control" id="keterangan"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="button" name="simpanjalan" id="simpanjalan" class="btn btn-primary">Simpan</button>
                            <button type="button" name="resetjalan"  id="resetjalan" class="btn btn-warning">Reset</button>
                            <button type="button" name="updatejalan" id="updatejalan" class="btn btn-info" disabled="true">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> Daftar Jalan</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <th>No</th>
                        <th>Nama Jalan</th>
                        <th>Keterangan</th>
                        <th></th>
                        <tbody id="daftarjalan">
                            <?php
                            $no = 1;
                            foreach ($itemjalan as $jalan) {
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $jalan->namajalan; ?></td>
                                    <td><?php echo $jalan->keterangan; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info" data-idjalan="<?php echo $jalan->id_jalan; ?>" name="editjalan<?php echo $jalan->id_jalan; ?>" id="editjalan"><span class="glyphicon glyphicon-edit"></span></button>
                                        <button type="button" class="btn btn-sm btn-danger" data-idjalan="<?php echo $jalan->id_jalan; ?>" name="deletejalan<?php echo $jalan->id_jalan; ?>" id="deletejalan"><span class="glyphicon glyphicon-trash"></span></button>
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
    $(document).on('click', '#simpanjalan', simpanjalan)
            .on('click', '#resetjalan', resetjalan)
            .on('click', '#updatejalan', updatejalan)
            .on('click', '#editjalan', editjalan)
            .on('click', '#deletejalan', deletejalan);
    function simpanjalan() {//simpan jalan
        var datajalan = {'namajalan': $('#namajalan').val(),
            'keterangan': $('#keterangan').val()};
        console.log(datajalan);
        $.ajax({
            url: '<?php echo site_url("Jalan/create"); ?>',
            data: datajalan,
            dataType: 'json',
            type: 'POST',
            success: function (data, status) {
                if (data.status != 'error') {
                    $('#daftarjalan').load('<?php echo current_url() . " #daftarjalan > *"; ?>');
                    resetjalan();//form langsung dikosongkan pas selesai input data
                } else {
                    alert(data.msg);
                }
            },
            error: function (x, t, m) {
                alert(x.responseText);
            }
        })
    }
    function resetjalan() {//reset form jalan
        $('#namajalan').val('');
        $('#keterangan').val('');
        $('#id_jalan').val('');
        $('#simpanjalan').attr('disabled', false);
        $('#updatejalan').attr('disabled', true);
    }
    
    function editjalan() {//edit jalan
        var id = $(this).data('idjalan');
        var datajalan = {'id_jalan':id};console.log(datajalan);
        $('input[name=editjalan'+id+']').attr('disabled',true);//biar ga di klik dua kali, maka di disabled
        $.ajax({
            url : '<?php echo site_url("jalan/edit");?>',
            data : datajalan,
            dataType : 'json',
            type : 'POST',
            success : function(data,status){
                if (data.status!='error') {
                    $('input[name=editjalan'+id+']').attr('disabled',false);//disabled di set false, karena transaksi berhasil
                    $('#simpanjalan').attr('disabled',true);
                    $('#updatejalan').attr('disabled',false);
                    $.each(data.msg,function(k,v){
                        $('#id_jalan').val(v['id_jalan']);
                        $('#namajalan').val(v['namajalan']);
                        $('#keterangan').val(v['keterangan']);
                    })
                }else{
                    alert(data.msg);
                    $('input[name=editjalan'+id+']').attr('disabled',false);//disabled di set false, karena transaksi berhasil
                }
            },
            error : function(x,t,m){
                alert(x.responseText);
                $('input[name=editjalan'+id+']').attr('disabled',false);//disabled di set false, karena transaksi berhasil
            }
        })
    }
    
    
    function updatejalan() {//update jalan
        var datajalan = {'namajalan':$('#namajalan').val(),
        'keterangan':$('#keterangan').val(),
        'id_jalan':$('#id_jalan').val()};console.log(datajalan);
        $.ajax({
            url : '<?php echo site_url("Jalan/update");?>',
            data : datajalan,
            dataType : 'json',
            type : 'POST',
            success : function(data,status){
                if (data.status!='error') {
                    $('#daftarjalan').load('<?php echo current_url()." #daftarjalan > *";?>');
                    resetjalan();//form langsung dikosongkan pas selesai input data
                }else{
                    alert(data.msg);
                }
            },
            error : function(x,t,m){
                alert(x.responseText);
            }
        })
    }
    
    function deletejalan() {//delete jalan
        if (confirm("Anda yakin akan menghapus data jalan ini?")) {
            var id = $(this).data('idjalan');
            var datajalan = {'id_jalan':id};console.log(datajalan);
            $.ajax({
                url : '<?php echo site_url("Jalan/delete");?>',
                data : datajalan,
                dataType : 'json',
                type : 'POST',
                success : function(data,status){
                    if (data.status!='error') {
                        $('#daftarjalan').load('<?php echo current_url()." #daftarjalan > *";?>');
                        resetjalan();//form langsung dikosongkan pas selesai input data
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