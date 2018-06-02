<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc;
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-8">
            <div class="panel panel-primary">
                <div class="panel-heading"><span class="glyphicon glyphicon-globe"></span> Peta</div>
                <div class="panel-body" style="height:300px;" id="map-canvas">
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="panel panel-primary">
                <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> Daftar Koordinat</div>
                <div class="panel-body" style="min-height:300px;">
                    <table class="table">
                        <th>No</th>
                        <th>Lat</th>
                        <th>Long</th>
                        <th></th>
                        <tbody id="daftarkoordinat">
                            <?php if($this->cart->contents()!=null){
                                foreach ($this->cart->contents() as $koordinat) {
                                    if($koordinat['jenis']=='jalan'){
                                        echo '<tr><td>'.$koordinat["id"].'</td><td>'.$koordinat["latitude"].'</td><td>'.$koordinat["longitude"].'</td></tr>';
                                    }
                                }
                            } ?>
                        </tbody>
                    </table>
                    <form action="#">
                        <div class="form-group">
                            <label for="datajalan">Data Jalan</label>
                            <?php if (count($itemdatajalan)!=null) {
                                echo '<select name="id_jalan" id="id_jalan" class="form-control">';
                                foreach ($itemdatajalan as $datajalan) {
                                    echo "<option value='".$datajalan->id_jalan."'>".$datajalan->namajalan."</option>";
                                }
                                echo '</select>';
                            }else{
                                echo anchor('admin/jalan', '<span class="glyphicon glyphicon-plus"></span> Tambah Data Jalan', 'class="btn btn-info form-control"');
                            } ?>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info btn-sm" id="simpandaftarkoordinatjalan"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                            <button class="btn btn-info btn-sm" id="clearmap"><span class="glyphicon glyphicon-globe"></span> ClearMap</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><span class="glyphicon glyphicon-th-list"></span> Daftar Koordinat Polyline Data Jalan</div>
                <div class="panel-body" style="min-height:400px">
                    <table class="table">
                        <th>No</th>
                        <th>Data Jalan</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th></th>
                        <tbody id="daftarkoordinatjalan">
                            <?php
                            if ($itemkoordinatjalan->num_rows()!=null) {
                                $no = 1;
                                foreach ($itemdatajalan as $jalan) {
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $no++;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $jalan->namajalan;
                                    echo "</td>";
                                    echo "<td>";
                                    foreach ($itemkoordinatjalan->result() as $koordinat) {
                                        if ($koordinat->id_jalan==$jalan->id_jalan) {
                                            echo $koordinat->latitude."</br>";
                                        }
                                    }
                                    echo "</td>";
                                    echo "<td>";
                                    foreach ($itemkoordinatjalan->result() as $koordinat) {
                                        if ($koordinat->id_jalan==$jalan->id_jalan) {
                                            echo $koordinat->longitude."</br>";
                                        }
                                    }
                                    echo "</td>";
                                    echo "<td>";
                                    echo '<button class="btn-info btn btn-sm" id="viewpolylinejalan" data-iddatajalan="'.$jalan->id_jalan.'"><span class="glyphicon-globe glyphicon"></span> View Polyline</button> ';
                                    echo '<button class="btn-danger btn btn-sm" id="hapuspolylinejalan" data-iddatajalan="'.$jalan->id_jalan.'"><span class="glyphicon-remove glyphicon"></span></button>';
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }
                             ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5xedHfQY8mhyxhGmURgAiJgWkwk0yhlM&callback=initMap" async defer></script>
<script>
$(document).on('click','#clearmap',clearmap)
.on('click','#simpandaftarkoordinatjalan',simpandaftarkoordinatjalan)
.on('click','#hapuspolylinejalan',hapuspolylinejalan)
.on('click','#viewpolylinejalan',viewpolylinejalan);
    var poly;
    var map;

    function initialize() {
        var mapOptions = {
        zoom: 16,
        center: new google.maps.LatLng(-2.584199, 115.384468)
        };

        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        var polyOptions = {
        strokeColor: '#000000',
        strokeOpacity: 1.0,
        strokeWeight: 3
        };
        poly = new google.maps.Polyline(polyOptions);
        poly.setMap(map);

        // Add a listener for the click event
        google.maps.event.addListener(map, 'rightclick', addLatLng);
        google.maps.event.addListener(map, "rightclick", function(event) {
          var lat = event.latLng.lat();
          var lng = event.latLng.lng();
          var datakoordinat = {'latitude':lat, 'longitude':lng};
          $.ajax({
              url : '<?php echo site_url("Koordinat_jalan/tambahkoordinatjalan") ?>',
              data : datakoordinat,
              dataType : 'json',
              type : 'POST',
              success : function(data,status){
                  if (data.status!='error') {
                      $('#daftarkoordinat').load('<?php echo current_url()."/ #daftarkoordinat > *" ?>');
                  }else{
                      alert(data.msg);
                  }
              }
          })
        });
    }

    function addLatLng(event) {

        var path = poly.getPath();

        // Because path is an MVCArray, we can simply append a new coordinate
        // and it will automatically appear.
        path.push(event.latLng);

        // Add a new marker at the new plotted point on the polyline.
        var marker = new google.maps.Marker({
        position: event.latLng,
        title: '#' + path.getLength(),
        map: map
        });
    }
    function clearmap(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo site_url("Koordinat_jalan/hapusdaftarkoordinatjalan") ?>',
            dataType : 'json',
            type : 'POST',
            success : function(data,status){
                if (data.status!='error') {
                      $('#daftarkoordinat').load('<?php echo current_url()."/ #daftarkoordinat > *" ?>');
                  }else{
                      alert(data.msg);
                  }
            }
        })
            var mapOptions = {
            zoom: 14,
            // Center the map on Chicago, USA.
            center: new google.maps.LatLng(-2.584199, 115.384468)
          };

          map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

          var polyOptions = {
            strokeColor: '#000000',
            strokeOpacity: 1.0,
            strokeWeight: 3
          };
          poly = new google.maps.Polyline(polyOptions);
          poly.setMap(null);
          initialize();
    }
    function simpandaftarkoordinatjalan(e){
        e.preventDefault();
        var datakoordinat = {'id_jalan':$('#id_jalan').val()};
        console.log(datakoordinat);
        $.ajax({
            url : '<?php echo site_url("Koordinat_jalan/simpandaftarkoordinatjalan") ?>',
            dataType : 'json',
            data : datakoordinat,
            type : 'POST',
            success : function(data,status){
                if (data.status!='error') {
                    $('#daftarkoordinat').load('<?php echo current_url()."/ #daftarkoordinat > *" ?>');
                    $('#daftarkoordinatjalan').load('<?php echo current_url()."/ #daftarkoordinatjalan > *" ?>');
                    alert(data.msg);
                    clearmap(e);
                }else{
                    alert(data.msg);
                }
            }
        })
    }
    function hapuspolylinejalan(e){
        e.preventDefault();
        var datakoordinat = {'id_jalan':$(this).data('iddatajalan')};
        console.log(datakoordinat);
        $.ajax({
            url : '<?php echo site_url("Koordinat_jalan/hapuspolylinejalan") ?>',
            data : datakoordinat,
            dataType : 'json',
            type : 'POST',
            success : function(data,status){
                if (data.status!='error') {
                    alert(data.msg);
                    $('#daftarkoordinatjalan').load('<?php echo current_url()."/ #daftarkoordinatjalan > *" ?>');
                    clearmap(e);
                }else{
                    alert(data.msg);
                }
            }
        })
    }
    function viewpolylinejalan(e){
        e.preventDefault();
        var datakoordinat = {'id_jalan':$(this).data('iddatajalan')};
        console.log(datakoordinat);
        $.ajax({
            url : '<?php echo site_url("Koordinat_jalan/viewpolylinejalan") ?>',
            data : datakoordinat,
            dataType : 'json',
            type : 'POST',
            success : function(data,status){
                if (data.status!='error') {
                    clearmap(e);
                    //load polyline
                    $.each(data.msg,function(m,n){
                        var lat = n["latitude"];
                        var lng = n["longitude"];
                        console.log(m,n);
                        $.each(data.datajalan,function(k,v){
                            createpolylinedatajalan(data.msg,v['namajalan'],lat,lng);
                        })
                        return false;
                    })
                    //end load polyline
                }else{
                    alert(data.msg);
                }
            }
        })
    }
    function createpolylinedatajalan(datakoordinat,nama,lat,lon){
        var mapOptions = {
        zoom: 14,
        //get center latlong
        center: new google.maps.LatLng(lat, lon),
        //mapTypeId: google.maps.MapTypeId.TERRAIN
        //end get center latlong
        };

        var map = new google.maps.Map(document.getElementById('map-canvas'),
          mapOptions);

        var listkoordinat = [];
        $.each(datakoordinat,function(k,v){
          listkoordinat.push(new google.maps.LatLng(parseFloat(v['latitude']), parseFloat(v['longitude'])));
        })
        var pathKoordinat = new google.maps.Polyline({
        path: listkoordinat,
        geodesic: true,
        strokeOpacity: 1.0,
        });

        pathKoordinat.setMap(map);

    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>