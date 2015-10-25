<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-10-17 14:06:29
         compiled from "..\smarty\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:192455599d066c9aaa1-50733313%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8dae6f80b4af5f78e7c3da45196b49dd3dcdc091' => 
    array (
      0 => '..\\smarty\\templates\\index.tpl',
      1 => 1436285486,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '192455599d066c9aaa1-50733313',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5599d066da0656_25498861',
  'variables' => 
  array (
    'loginInfo' => 0,
    'error' => 0,
    'e' => 0,
    'projectList' => 0,
    'pl' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5599d066da0656_25498861')) {function content_5599d066da0656_25498861($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
      <div id="projectDv">
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
      <p><span id="addProject">プロジェクト追加</span></p>
<?php if (isset($_smarty_tpl->tpl_vars['projectList']->value)) {?>
    <?php if ($_smarty_tpl->tpl_vars['projectList']->value!==false) {?>
        <table id="projects" style="border-collapse: collapse;">
          <thead>
            <tr style="visibility: collapse">
              <th style="width: 10%"></th>
              <th style="width: 60%"></th>
              <th style="width: 30%"></th>
            </tr>
            <tr>
              <th>完了</th>
              <th>プロジェクト名</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
  <?php  $_smarty_tpl->tpl_vars['pl'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pl']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['projectList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pl']->key => $_smarty_tpl->tpl_vars['pl']->value) {
$_smarty_tpl->tpl_vars['pl']->_loop = true;
?>
            <tr id="project_<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['pl']->value['project_id'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
" data-id="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['pl']->value['project_id'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
">
              <td class="c">
                <input type="checkbox" class="checkProject" <?php if ((($tmp = @$_smarty_tpl->tpl_vars['pl']->value['status'])===null||$tmp==='' ? '' : $tmp)=="done") {?>checked="checked"<?php }?> />
              </td>
              <td>
              <span class="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['pl']->value['status'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['pl']->value['project_mei'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
</span>
              </td>
              <td class="c">
                <a href="task.php?project_id=<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['pl']->value['project_id'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
">[タスク]</a>
                <span <?php if ((($tmp = @$_smarty_tpl->tpl_vars['pl']->value['status'])===null||$tmp==='' ? '' : $tmp)=="notyet") {?>class="editProject"<?php }?>>[編集]</span> 
                <span class="deleteProject">[削除]</span> 
                <span class="projectDrag">[drag]</span>
              </td>
            </tr>
  <?php } ?>
          </tbody>
        </table>
    <?php } else { ?>
        <p id="notProject">現在プロジェクトは存在しません。</p>
    <?php }?>
<?php }?>
      </div>
    </div><!-- end_content -->
    <!-- ui-dialog -->
    <div id="projectAddDialog" title="プロジェクト新規追加">
      <p>プロジェクト名</p>
      <p><input type="text" id="frmProjectMei" value="" style="width: 100%" /></p>
      <p><input type="button" id="frmProjectAdd" class="mt5" value="追加" /></p>
    </div>
    <div id="projectEditDialog" title="プロジェクト編集">
      <p>プロジェクト名</p>
      <p><input type="text" id="frmProjectMei" value="" style="width: 100%" /></p>
      <p>
        <input type="hidden" id="frmProjectId" value="" />
        <input type="button" id="frmProjectEdit" class="mt5" value="編集" />
      </p>
    </div>
<?php echo $_smarty_tpl->getSubTemplate ("template.footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

  </div><!-- end_container -->
</body>
</html><?php }} ?>
