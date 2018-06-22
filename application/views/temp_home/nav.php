
<div class="navbar-header">
    <a href="<?= base_url(); ?>index.php/home.html" class="navbar-brand"><b></b></a>
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
        <i class="fa fa-bars"></i>
    </button>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
    <ul class="nav navbar-nav">
        <li class="active"><a href="<?=base_url();?>index.php/Home.html">Home</a></li>
              <li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'><span class="glyphicon glyphicon-list"></span> Data <b class='caret'></b></a>
                  <ul class='dropdown-menu'>
                      <li><?php echo anchor('jalan','Jalan') ?></li>
                      <li><?php echo anchor('jembatan','Jembatan') ?></li>
                  </ul>
              </li>
              <li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'><span class="glyphicon glyphicon-globe"></span> Koordinat <b class='caret'></b></a>
                  <ul class='dropdown-menu'>
                      <li><?php echo anchor('Koordinat_jalan','Koordinat Jalan') ?></li>
                      <li><?php echo anchor('Koordinat_jembatan','Koordinat Jembatan') ?></li>
                  </ul>
              </li>
              
              <li><?php echo anchor('Biodata','Biodata Diri') ?></li>
 
            </ul>
 
    </ul>
</div>
<!-- /.navbar-collapse -->
<!-- Navbar Right Menu -->
<!--<div class="navbar-custom-menu bg-gray">
    <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php if (empty($foto)) { ?>
                    <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <?php } else { ?>
                    <img src="<?php echo base_url(); ?>assets/img/user/<?= $foto; ?>" class="user-image" alt="<?= $nama; ?>">
                <?php } ?>
                <span class="hidden-xs"><?=$nm_admin;?></span>
            </a>
            <ul class="dropdown-menu">
                 The user image in the menu 
                <li class="user-header bg-gray">
                    
                    <?php if (empty($foto)) { ?>
                    <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                <?php } else { ?>
                    <img src="<?php echo base_url(); ?>assets/img/user/<?= $foto; ?>" class="img-circle" alt="<?= $nama; ?>">
                <?php } ?>
                    <img src="../../dist/img/user2-160x160.jpg"  alt="User Image">

                    <p>
                        <?=$nm_admin;?>
                        <small>Member since Nov. 2012</small>
                    </p>
                </li>

                <li class="user-footer">
                    <div class="pull-left">
                        <a href="<?=base_url();?>index.php/admin/Setting/edit_profil.html?id_user=<?=$id;?>" class="btn btn-success btn-flat">Profil</a>
                    </div>
                    <div class="pull-right">
                        <a href="<?=base_url();?>index.php/Login/logout.html" class="btn btn-danger btn-flat">Sign out</a>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</div>-->