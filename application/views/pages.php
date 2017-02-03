<p>------------ Container ------------</p>

<br/>

<strong style="background:#ccc;padding:5px 10px;">二级栏目</strong> - <?php echo $pageName; ?>


<?php foreach($datas_pages->result() as $row){ ?>
  <ul>
    <?php if($row->PageCate==$pageCate) { ?> 
      <li><a href="<?php echo base_url('pages/'.$pageCate.'/'.$row->Id) ?>"><?php echo $row->PageTitle; ?></a></li>
    <?php } ?>
  </ul>
<?php } ?>
<br><br>



<strong style="background:#ccc;padding:5px 10px;">内容</strong>
<div style="background:#eee;padding:5px;">
  <?php echo $pageContent; ?>
</div>
<br><br>


<p>------------ end Container ------------</p>