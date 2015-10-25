<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-10-17 14:06:43
         compiled from "..\smarty\templates\task.tpl" */ ?>
<?php /*%%SmartyHeaderCode:104145599d0758dd064-88392924%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c929543266447755d12f88d17ac7838014fb1703' => 
    array (
      0 => '..\\smarty\\templates\\task.tpl',
      1 => 1436285202,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104145599d0758dd064-88392924',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5599d075a57f34_62321995',
  'variables' => 
  array (
    'loginInfo' => 0,
    'error' => 0,
    'e' => 0,
    'targetProject' => 0,
    'taskList' => 0,
    'tl' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5599d075a57f34_62321995')) {function content_5599d075a57f34_62321995($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\pleiades\\xampp\\htdocs\\Smarty-3.1.21\\libs\\plugins\\modifier.date_format.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
      <div id="taskDv">
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
<?php if (isset($_smarty_tpl->tpl_vars['targetProject']->value)) {?>
        <p><a href="index.php">プロジェクト一覧へ戻る</a></p>
        <h2><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['targetProject']->value[0]['project_mei'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
のタスク一覧</h2>
        <p><a href="addTask.php?project_id=<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['targetProject']->value[0]['project_id'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
">新規追加</a></p>
        <input type="hidden" id="projectId" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['targetProject']->value[0]['project_id'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
" />
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['taskList']->value)) {?>
    <?php if ($_smarty_tpl->tpl_vars['taskList']->value!==false) {?>
        <table id="tasks" style="border-collapse: collapse;" border="1">
          <thead>
            <tr style="visibility: collapse">
              <th style="width: 7%"></th>
              <th style="width: 6%"></th>
              <th style="width: 6%">/th>
              <th style="width: 6%">/th>
              <th style="width: 6%">/th>
              <th style="width: 4%">/th>
              <th style="width: 12%">/th>
              <th style="width: 21%">/th>
              <th style="width: 21%">/th>
              <th style="width: 11%">/th>
            </tr>
            <tr>
              <th>ステータス</th>
              <th>登録日</th>
              <th>作業開始日</th>
              <th>作業完了日</th>
              <th>作業者</th>
              <th>優先度</th>
              <th>概要</th>
              <th>内容</th>
              <th>備考</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
  <?php  $_smarty_tpl->tpl_vars['tl'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tl']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['taskList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tl']->key => $_smarty_tpl->tpl_vars['tl']->value) {
$_smarty_tpl->tpl_vars['tl']->_loop = true;
?>
            <tr id="task_<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['tl']->value['task_id'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
" class="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['tl']->value['status'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
" data-id="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['tl']->value['task_id'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
">
              <td class="c">
                <select class="checkStatus">
                  <option value="before_work" <?php if ((($tmp = @$_smarty_tpl->tpl_vars['tl']->value['status'])===null||$tmp==='' ? '' : $tmp)=="before_work") {?>selected="selected"<?php }?>>作業前</option>
                  <option value="working" <?php if ((($tmp = @$_smarty_tpl->tpl_vars['tl']->value['status'])===null||$tmp==='' ? '' : $tmp)=="working") {?>selected="selected"<?php }?>>作業中</option>
                  <option value="after_work" <?php if ((($tmp = @$_smarty_tpl->tpl_vars['tl']->value['status'])===null||$tmp==='' ? '' : $tmp)=="after_work") {?>selected="selected"<?php }?>>完了</option>
                </select>
              </td>
              <td class="c"><?php echo htmlspecialchars(smarty_modifier_date_format((($tmp = @$_smarty_tpl->tpl_vars['tl']->value['create_date'])===null||$tmp==='' ? '' : $tmp),'%Y.%m.%d'), ENT_QUOTES, 'UTF-8');?>
</td>
              <td class="c"><?php echo htmlspecialchars(smarty_modifier_date_format((($tmp = @$_smarty_tpl->tpl_vars['tl']->value['start_date'])===null||$tmp==='' ? '' : $tmp),'%Y.%m.%d'), ENT_QUOTES, 'UTF-8');?>
</td>
              <td class="c"><?php echo htmlspecialchars(smarty_modifier_date_format((($tmp = @$_smarty_tpl->tpl_vars['tl']->value['complete_date'])===null||$tmp==='' ? '' : $tmp),'%Y.%m.%d'), ENT_QUOTES, 'UTF-8');?>
</td>
              <td><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['tl']->value['sagyo_sha'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
</td>
              <td class="c">
    <?php if ((($tmp = @$_smarty_tpl->tpl_vars['tl']->value['yusen_do'])===null||$tmp==='' ? '' : $tmp)==0) {?>
                高
    <?php } elseif ((($tmp = @$_smarty_tpl->tpl_vars['tl']->value['yusen_do'])===null||$tmp==='' ? '' : $tmp)==1) {?>
                中
    <?php } else { ?>
                低
    <?php }?>
              </td>
              <td><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['tl']->value['gaiyo'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
</td>
              <td><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['tl']->value['naiyo'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
</td>
              <td><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['tl']->value['biko'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
</td>
              <td class="c">
                <a href="editTask.php?project_id=<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['targetProject']->value[0]['project_id'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
&task_id=<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['tl']->value['task_id'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
">[編集]</a> 
                <span class="deleteTask">[削除]</span> 
                <span class="taskDrag">[drag]</span>
              </td>
            </tr>
  <?php } ?>
          </tbody>
        </table>
    <?php } else { ?>
        <p id="notTask">現在タスクは存在しません。</p>
    <?php }?>
<?php }?>
      </div>
    </div><!-- end_content -->
<?php echo $_smarty_tpl->getSubTemplate ("template.footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

  </div><!-- end_container -->
</body>
</html><?php }} ?>
