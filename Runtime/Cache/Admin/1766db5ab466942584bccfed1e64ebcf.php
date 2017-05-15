<?php if (!defined('THINK_PATH')) exit();?><ul>
<?php if(is_array($reason)): $i = 0; $__LIST__ = $reason;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li><?php echo ($data); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
<ul>