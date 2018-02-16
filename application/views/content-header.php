<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo isset($title) ? $title: "Dashboard" ?>
        <!-- <small>Control panel</small> -->
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
      <div class="content-header-buttons">
        <!-- <button type="button" class="btn btn-sm">New</button> -->
        <?php if (isset($ch_btns)) $this->layout->btn_sm($ch_btns); ?>
      </div>
      <?php if (isset($head_notes)) : ?>
      <small class="text-muted h5"><?php echo $head_notes ?></small>
      <?php endif; ?>
    </section>