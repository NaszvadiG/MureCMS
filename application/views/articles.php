<p>------------ Container ------------</p>

<br/>

<strong style="background:#ccc;padding:5px 10px;">二级栏目</strong> - <?php echo $articleName; ?>

<br><br>

<div>
  <?php foreach($datas_articleCate['result'] as $index=>$row){ ?>
    <a href="<?php echo base_url('/articles/'.$row->ArticleCate); ?>" class="list-group-item <?php if($articleCate==$row->ArticleCate) echo 'active'; ?>"><?php echo $row->ArticleTitle; ?></a>
    <ul class="list-group-child">
      <?php foreach($datas_articleCate['childList'][$index+1] as $indexChild=>$rowChild){ ?>
      <li><a class="<?php if($id == $rowChild->Id) echo 'active'; ?>" href="<?php echo base_url('/articles/'.$row->ArticleCate.'/'.$rowChild->Id); ?>"><?php echo $rowChild->ArticleTitle;?></a></li>
      <?php } ?>
    </ul>
  <?php } ?>
</div>

<br><br>

<div>
  <strong><?php echo $articleName;if(!empty($id)){ echo '<small class="text-muted"> - '.$articleChildName.'</small>';} ?></strong>
  <ul>
      <?php foreach($datas_articles as $row){ ?> 
        <li><a href="<?php echo base_url('admin/articles/edit/'.$row->ArticleCate.'/'.$row->Id); ?>"><?php echo $row->ArticleTitle; ?></a></li>
      <?php } ?>
  </ul>
</div>

<p>------------ end Container ------------</p>