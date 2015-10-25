<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-07-07 18:41:30
         compiled from "..\smarty\templates\editTask.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8925599f2c8a98c09-95788247%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '52312b7023174254d73fa6b4e5510195db3c5f3c' => 
    array (
      0 => '..\\smarty\\templates\\editTask.tpl',
      1 => 1436285301,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8925599f2c8a98c09-95788247',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5599f2c8b8edb4_17678392',
  'variables' => 
  array (
    'loginInfo' => 0,
    'projectId' => 0,
    'projectMei' => 0,
    'error' => 0,
    'e' => 0,
    'message' => 0,
    'sagyoSha' => 0,
    'yusenDo' => 0,
    'gaiyo' => 0,
    'naiyo' => 0,
    'biko' => 0,
    'startDate' => 0,
    'completeDate' => 0,
    'taskId' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5599f2c8b8edb4_17678392')) {function content_5599f2c8b8edb4_17678392($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<?php echo $_smarty_tpl->getSubTemplate ("template.head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</head>
<body>
  <div id="container">
<?php echo $_smarty_tpl->getSubTemplate ("template.header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <div id="content">
      <p class="r mt5">ログインユーザ: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['loginInfo']->value['loginUser'], ENT_QUOTES, 'UTF-8');?>
&nbsp;|&nbsp;<a href="logout.php">ログアウト</a></p>
      <div id="nyuryokuTaskDv">
        <p><a href="task.php?project_id=<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['projectId']->value)===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
">タスク一覧へ戻る</a></p>
        <h2><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['projectMei']->value)===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
のタスク編集</h2>
<?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
        <ul class="errorMessage">
  <?php  $_smarty_tpl->tpl_vars['e'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['e']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['error']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['e']->key => $_smarty_tpl->tpl_vars['e']->value) {
$_smarty_tpl->tpl_vars['e']->_loop = true;
?>
          <li><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['e']->value)===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
</li>
  <?php } ?>
        </ul>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['message']->value)) {?>
        <p id="message"><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['message']->value)===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
</p>
<?php }?>
        <form action="" method="post">
        <table id="nyuryokuTaskTbl">
          <tr>
            <th>作業者</th>
            <td><input type="text" name="frmSagyoSha" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['sagyoSha']->value)===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
" /></td>
          </tr>
          <tr>
            <th>優先度 <span class="cRed">*</span></th>
            <td>
              <label>高<input type="radio" name="frmYusenDo" value="0" <?php if ((($tmp = @$_smarty_tpl->tpl_vars['yusenDo']->value)===null||$tmp==='' ? '' : $tmp)==0) {?>checked="checked"<?php }?> /></label>&nbsp;
              <label>中<input type="radio" name="frmYusenDo" value="1" <?php if ((($tmp = @$_smarty_tpl->tpl_vars['yusenDo']->value)===null||$tmp==='' ? '' : $tmp)==1) {?>checked="checked"<?php }?> /></label>&nbsp;
              <label>低<input type="radio" name="frmYusenDo" value="2" <?php if ((($tmp = @$_smarty_tpl->tpl_vars['yusenDo']->value)===null||$tmp==='' ? '' : $tmp)==2) {?>checked="checked"<?php }?> /></label>
            </td>
          </tr>
          <tr>
            <th>概要 <span class="cRed">*</span></th>
            <td><input type="text" name="frmGaiyo" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['gaiyo']->value)===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
" /></td>
          </tr>
          <tr>
            <th>内容</th>
            <td><textarea name="frmNaiyo"><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['naiyo']->value)===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
</textarea></td>
          </tr>
          <tr>
            <th>備考</th>
            <td><textarea name="frmBiko"><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['biko']->value)===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
</textarea></td>
          </tr>
          <tr>
            <th>作業開始日</th>
            <td><input type="text" id="frmStartDate" name="frmStartDate" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['startDate']->value)===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
" /></td>
          </tr>
          <tr>
            <th>作業完了日</th>
            <td><input type="text" id="frmCompleteDate" name="frmCompleteDate" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['completeDate']->value)===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
" /></td>
          </tr>
        </table>
        <p>
          <input type="submit" value="編集" />
          <input type="hidden" name="frmTaskId" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['taskId']->value)===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
" />
          <input type="hidden" name="frmProjectId" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['projectId']->value)===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
" />
          <input type="hidden" name="frmProjectMei" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['projectMei']->value)===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
" />
        </p>
        </form>
      </div>
    </div><!-- end_content -->
<?php echo $_smarty_tpl->getSubTemplate ("template.footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

  </div><!-- end_container -->
</body>
</html><?php }} ?>
