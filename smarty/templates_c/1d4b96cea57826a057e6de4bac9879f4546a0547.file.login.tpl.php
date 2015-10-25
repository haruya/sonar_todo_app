<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-10-25 02:31:14
         compiled from "..\smarty\templates\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:279455599d067e8eea7-94051689%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1d4b96cea57826a057e6de4bac9879f4546a0547' => 
    array (
      0 => '..\\smarty\\templates\\login.tpl',
      1 => 1436280958,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '279455599d067e8eea7-94051689',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5599d067f00345_81133614',
  'variables' => 
  array (
    'error' => 0,
    'e' => 0,
    'userId' => 0,
    'userPw' => 0,
    'kiokuFlag' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5599d067f00345_81133614')) {function content_5599d067f00345_81133614($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<?php echo $_smarty_tpl->getSubTemplate ("template.head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</head>
<body>
  <div id="container">
<?php echo $_smarty_tpl->getSubTemplate ("template.header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <div id="content">
      <div id="loginDv">
<?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
        <ul class="errorMessage">
  <?php  $_smarty_tpl->tpl_vars['e'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['e']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['error']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['e']->key => $_smarty_tpl->tpl_vars['e']->value) {
$_smarty_tpl->tpl_vars['e']->_loop = true;
?>
          <li><?php echo htmlspecialchars((($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['e']->value, ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
</li>
  <?php } ?>
        </ul>
<?php }?>
        <form action="" method="POST">
        <table id="loginTbl">
          <tr>
            <th>ID</th>
            <td><input type="text" name="frmUserId" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['userId']->value)===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
" /></td>
          </tr>
          <tr>
            <th>パスワード</th>
            <td><input type="password" name="frmUserPw" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['userPw']->value)===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
" /></td>
          </tr>
          <tr>
            <td colspan="2">
              <input type="hidden" name="frmKiokuFlag" value="0" />
              <label><input type="checkbox" name="frmKiokuFlag" value="1" <?php if ((($tmp = @$_smarty_tpl->tpl_vars['kiokuFlag']->value)===null||$tmp==='' ? '' : $tmp)==1) {?>checked="checked"<?php }?> />&nbsp;IDとパスワードを記憶する</label>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <input type="submit" value="ログイン" />
            </td>
          </tr>
        </table>
        </form>
      </div>
    </div><!-- end_content -->
<?php echo $_smarty_tpl->getSubTemplate ("template.footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

  </div><!-- end_container -->
</body>
</html><?php }} ?>
