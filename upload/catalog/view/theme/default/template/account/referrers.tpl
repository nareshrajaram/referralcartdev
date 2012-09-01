<?php echo $header; ?>
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>
<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <h3><?php echo $text_your_balance;?> <strong style="color: green"><?php echo $actual_currency['symbol_left'].$my_balance.$actual_currency['symbol_right']; ?></strong></h3>
  <i><?php echo $text_link_referrer.' '.$shop_url.'index.php?route=account/register&amp;ref='.$this->customer->getId();?></i>
  <br /><br />
  <div class="fb-send" style="float: left; margin-top: 2px; margin-right: 10px;" data-href="<?php echo $shop_url.'index.php?route=account/register&amp;ref='.$this->customer->getId();?>"></div>


<!-- Place this tag where you want the share button to render. -->
<div class="g-plus" data-action="share" data-annotation="bubble" data-href="http://scripts.8u.cz/examples/opencart/referral/index.php?route=account/referrers"></div>

<!-- Place this tag after the last share tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>


  <br /><br />
  <h2><?php echo $text_my_referrers; ?></h2>
    <table class="list">
    <thead>
      <tr>
        <td class="left"><?php echo $text_referer_name; ?></td>
        <td class="left"><?php echo $text_referer_register; ?></td>
        <td class="left"><?php echo $text_num_of_purchases; ?></td>
        <td class="right"><?php echo $text_profit; ?></td>
      </tr>
    </thead>
    <tbody>
    <?php foreach($referrers as $referrer){?>
      <tr>
        <td class="left"><?php echo $referrer['firstname'].' '.$referrer['lastname']; ?></td>
        <td class="left"><?php echo $referrer['date_added']; ?></td>
        <td class="right"><?php echo $all_purchases[$referrer['customer_id']]; ?></td>
        <td class="right"><?php echo $actual_currency['symbol_left'].$all_points[$referrer['customer_id']].$actual_currency['symbol_right'];?></td>
      </tr>
    <?php
          }
        if(count($referrers)==0){
    ?>
      <tr>
        <td class="center" colspan="4"><?php echo $text_no_referrers; ?></td>
      </tr>
    <?}?>
      
      
      
    </tbody>
  </table>



  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?> 