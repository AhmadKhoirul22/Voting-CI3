<?php $menu = $this->uri->segment(2); ?>
<aside id="sidebar" class="sidebar">
<?php if($this->session->userdata('level')=='Admin') { 

?>
    <ul class="sidebar-nav" id="sidebar-nav">

      <!-- <li class="nav-item<?php if($menu=='index'){ echo 'active'; }?>">
        <a class="nav-link collapsed" href="<?= base_url('admin/index')?>">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>End Dashboard Nav -->
      <li class="nav-item<?php if($menu=='voting'){ echo 'active'; }?>">
        <a class="nav-link collapsed" href="<?= base_url('admin/voting')?>">
          <i class="bi bi-menu-button-wide"></i><span>Voting</span>
        </a>
      </li><!-- End Components Nav -->
      <li class="nav-item<?php if($menu=='kandidat'){ echo 'active'; }?>">
        <a class="nav-link collapsed" href="<?= base_url('admin/kandidat')?>">
          <i class="bi bi-journal-text"></i><span>Kandidat</span>
        </a>
      </li><!-- End Forms Nav -->
      <li class="nav-item<?php if($menu=='user'){ echo 'active'; }?>">
        <a class="nav-link collapsed" href="<?= base_url('admin/user') ?>">
          <i class="ri-map-pin-user-line"></i><span>User</span>
        </a>
      </li><!-- End Charts Nav -->
      
    </ul>
		<?php } ?>
  </aside>
