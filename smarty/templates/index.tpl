<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
{include file="template.head.tpl"}
</head>
<body>
  <div id="container">
{include file="template.header.tpl"}
    <div id="content">
      <p class="r mt5">ログインユーザ: {$loginInfo['loginUser']}&nbsp;|&nbsp;<a href="logout.php">ログアウト</a></p>
      <div id="projectDv">
{if isset($error)}
        <ul class="errorMessage">
  {foreach from=$error item=e}
          <li>{$e|default:''}</li>
  {/foreach}
        </ul>
{/if}
      <p><span id="addProject">プロジェクト追加</span></p>
{if isset($projectList)}
    {if $projectList !== FALSE}
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
  {foreach from=$projectList item=pl}
            <tr id="project_{$pl['project_id']|default:''}" data-id="{$pl['project_id']|default:''}">
              <td class="c">
                <input type="checkbox" class="checkProject" {if $pl['status']|default:'' == "done"}checked="checked"{/if} />
              </td>
              <td>
              <span class="{$pl['status']|default:''}">{$pl['project_mei']|default:''}</span>
              </td>
              <td class="c">
                <a href="task.php?project_id={$pl['project_id']|default:''}">[タスク]</a>
                <span {if $pl['status']|default:'' == "notyet"}class="editProject"{/if}>[編集]</span> 
                <span class="deleteProject">[削除]</span> 
                <span class="projectDrag">[drag]</span>
              </td>
            </tr>
  {/foreach}
          </tbody>
        </table>
    {else}
        <p id="notProject">現在プロジェクトは存在しません。</p>
    {/if}
{/if}
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
{include file="template.footer.tpl"}
  </div><!-- end_container -->
</body>
</html>