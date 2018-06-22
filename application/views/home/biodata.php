<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo $javasc;
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span> Form Biodata</h3>
                </div>
                <div class="panel-body">
                    <form action="#">
                        <div class="form-group">
                            <label for="namajalan">NIK</label>
                            <input type="text" name="nik" class="form-control" id="nik" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control" id="alamat"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="button" name="simpan" id="simpan" class="btn btn-primary">Simpan</button>
                            <button type="button" name="reset"  id="reset" class="btn btn-warning">Reset</button>
                            <button type="button" name="updatejalan" id="updatejalan" class="btn btn-info" disabled="true">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> Biodata Diri</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th></th>
                        <tbody id="biodata">
                            <?php
                            $no = 1;
                            foreach ($getBiodata as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row->nik; ?></td>
                                    <td><?php echo $row->nama; ?></td>
                                    <td><?php echo $row->alamat; ?></td>
                                    <td></td>
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
    $(document).on('click', '#simpan', simpan)
            .on('click', '#reset', reset);
    function simpan() {//simpan jalan
        var dt = {'nik': $('#nik').val(), 'nama': $('#nama').val(), 'alamat': $('#alamat').val()};
        console.log(dt);
        $.ajax({
            url: '<?php echo site_url("Biodata/create"); ?>',
            data: dt,
            dataType: 'json',
            type: 'POST',
            success: function (data, status) {
                if (data.status != 'error') {
                    $('#biodata').load('<?php echo current_url() . " #biodata > *"; ?>');
                    reset();//form langsung dikosongkan pas selesai input data
                } else {
                    alert(data.msg);
                }
            },
            error: function (x, t, m) {
                alert(x.responseText);
            }
        })
    }
    
    function reset() {//reset form jalan
        $('#nik').val('');
        $('#nama').val('');
        $('#alamat').val('');
    }
   
</script>