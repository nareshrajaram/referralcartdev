<?php echo $header; ?>
<div id="content">
<div class="breadcrumb">
  <?php foreach ($breadcrumbs as $breadcrumb) { ?>
  <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
  <?php } ?>
</div>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div class="box">
  <div class="heading">
    <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content">
  <script type="text/javascript">
    function hideRefProfit(){
      var i = 1;
      while(i<=10){
        document.getElementById('ref-profit-'+i.toString()).style.display = "none";
        i++;
      }
    }
    
    function setRefProfit(){
      var referrer_level = document.getElementById('referrer_level').value;
      var i = 1;
      hideRefProfit();
      while(i<=referrer_level){
        document.getElementById('ref-profit-'+i.toString()).style.display = "";
        i++;
      }
    }
  
    function switchOrderPrice(){
      if(document.getElementById('order_price_1').checked){
        document.getElementById('min_order_price').style.display = "";
      }else{
        document.getElementById('min_order_price').style.display = "none";
      }
    }
</script>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <table class="form">
        <tr>
          <td><span class="required">*</span> <?php echo $text_profit_type;?>:</td>
          <td>
            <input type="radio" name="profit_type" value="percentage" id="profit_type_percentage" <?php if(isset($value_referrer['profit_type']) AND $value_referrer['profit_type'] == 'percentage'){echo ' checked="checked"';}?> />&nbsp;<label for="profit_type_percentage"><?php echo $text_percentage;?></label>&nbsp;
            <input type="radio" name="profit_type" value="fixed" id="profit_type_fixed" <?php if(isset($value_referrer['profit_type']) AND $value_referrer['profit_type'] == 'fixed'){echo ' checked="checked"';}?> />&nbsp;<label for="profit_type_fixed"><?php echo $text_fixed;?></label>
          </td>
        </tr>
      
        <tr>
          <td><span class="required">*</span> <?php echo $text_higher_total;?>:</td>
          <td>
            <input type="radio" name="order_price" value="1" id="order_price_1" onClick="switchOrderPrice();"<?php if(isset($value_referrer['order_price']) AND $value_referrer['order_price'] == 1){echo ' checked="checked"';}?> />&nbsp;<label for="order_price_1"><?php echo $text_yes;?></label>&nbsp;
            <input type="radio" name="order_price" value="0" id="order_price_0" onClick="switchOrderPrice();"<?php if(isset($value_referrer['order_price']) AND $value_referrer['order_price'] == 0){echo ' checked="checked"';}?> />&nbsp;<label for="order_price_0"><?php echo $text_no;?></label>
          </td>
        </tr>
        
        <tr id="min_order_price">
          <td><span class="required">*</span> <?php echo $text_min_order_total;?>:</td>
          <td><?php echo $primary_currency['symbol_left'];?><input type="text" name="min_order_price" value="<?php if(isset($value_referrer['min_order_price'])){echo $value_referrer['min_order_price'];}?>" size="7" /><?php echo $primary_currency['symbol_right'];?></td>
        </tr>
      
        <tr>
          <td><span class="required">*</span> <?php echo $text_ref_level;?>:</td>
          <td>
            <select name="referrer_level" id="referrer_level" onChange="setRefProfit();">
            <?php
              $i = 1;
              WHILE($i<=10){
                if($i == $value_referrer['referrer_level']){$selected = ' selected="selected"';}
                else{$selected = '';}
                echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
                $i++;
              }
            ?>
            </select>
          </td>
        </tr>
        <tr>
          <td><span class="required">*</span> <?php echo $text_status;?>:</td>
          <td>
            <select name="referrer_status">
              <option value="1"<?php if(isset($value_referrer['referrer_status']) AND $value_referrer['referrer_status'] == '1'){echo ' selected="selected"';}?>><?php echo $text_enable; ?></option>
              <option value="0"<?php if(isset($value_referrer['referrer_status']) AND $value_referrer['referrer_status'] == '0'){echo ' selected="selected"';}?>><?php echo $text_disable; ?></option>
             </select>
          </td>
        </tr>
        
      </table>
      
      
      <h2 style="padding-top: 25px;"><?php echo $text_ref_profit;?></h2>
      <table class="form">
        <tr>
          <td><h4 style="padding: 0px; margin: 2px;"><?php echo $text_ref_level;?></h4></td>
          <td><h4 style="padding: 0px; margin: 2px;"><?php echo $text_ref_percentage_profit;?></h4></td>
          <td><h4 style="padding: 0px; margin: 2px;"><?php echo $text_ref_fixed_profit;?></h4></td>
          <td><h4 style="padding: 0px; margin: 2px;"><?php echo $text_ref_info;?></h4></td>
        </tr>
      <?php $i=1;while($i<=10){?>
        <tr id="ref-profit-<?php echo $i;?>">
          <td style="width: 100px !important;"><label for="referrer_profit_level_<?php echo $i;?>_percentage"><b><?php echo $i;?>. <?php echo $text_referrer;?></b></label></td>
          <td style="width: 120px !important;"><input type="text" name="referrer_profit_level_<?php echo $i;?>_percentage" id="referrer_profit_level_<?php echo $i;?>_percentage" value="<?php if(isset($value_referrer['referrer_profit_level_'.$i.'_percentage'])){echo $value_referrer['referrer_profit_level_'.$i.'_percentage'];}else{echo "0";}?>" size="7" />%</td>
          <td style="width: 120px !important;"><?php echo $primary_currency['symbol_left'];?><input type="text" name="referrer_profit_level_<?php echo $i;?>_fixed" value="<?php if(isset($value_referrer['referrer_profit_level_'.$i.'_fixed'])){echo $value_referrer['referrer_profit_level_'.$i.'_fixed'];}else{echo "0";}?>" size="7" /><?php echo $primary_currency['symbol_right'];?></td>
          <td><u><?php echo $text_you;?></u> <small>&laquo;</small> <?php
            $j = 2;
            while($j <= $i){
              echo "<small>REF ".($j-1)." < </small>";
              $j++;
            }
          ?><b><?php echo $text_this_ref;?></b></td>
        </tr>
      <?php $i++;}?>
      </table>
      <input type="hidden" name="referrer_module" value="<?php echo $referrer_module; ?>" />
    </form>
  </div>
<script type="text/javascript">
  setRefProfit(document.getElementById('referrer_level').value);
  switchOrderPrice();
</script>
</div>
<script type="text/javascript">
<!--
var module_row = <?php echo $module_row; ?>;

function addModule() {	
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><select name="referrer_' + module_row + '_layout_id">';
	<?php foreach ($layouts as $layout) { ?>
	html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>';
	<?php } ?>
	html += '    </select></td>';
	html += '    <td class="left"><select name="referrer_' + module_row + '_position">';
	html += '      <option value="content_top"><?php echo $text_content_top; ?></option>';
	html += '      <option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
	html += '      <option value="column_left"><?php echo $text_column_left; ?></option>';
	html += '      <option value="column_right"><?php echo $text_column_right; ?></option>';
	html += '    </select></td>';
	html += '    <td class="left"><select name="referrer_' + module_row + '_status">';
    html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
    html += '      <option value="0"><?php echo $text_disabled; ?></option>';
    html += '    </select></td>';
	html += '    <td class="right"><input type="text" name="referrer_' + module_row + '_sort_order" value="" size="3" /></td>';
	html += '    <td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#module tfoot').before(html);
	
	module_row++;
}

$('#form').bind('submit', function() {
	var module = new Array(); 

	$('#module tbody').each(function(index, element) {
		module[index] = $(element).attr('id').substr(10);
	});
	
	$('input[name=\'referrer_module\']').attr('value', module.join(','));
});
//--></script>