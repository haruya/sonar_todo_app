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
      <div id="taskDv">
{if isset($error)}
        <ul class="errorMessage">
  {foreach from=$error item=e}
          <li>{$e|escape|default:''}</li>
  {/foreach}
        </ul>
{/if}
{if isset($targetProject)}
        <p><a href="index.php">プロジェクト一覧へ戻る</a></p>
        <h2>{$targetProject[0]['project_mei']|default:''}のタスク一覧</h2>
        <p><a href="addTask.php?project_id={$targetProject[0]['project_id']|default:''}">新規追加</a></p>
        <input type="hidden" id="projectId" value="{$targetProject[0]['project_id']|default:''}" />
{/if}
{if isset($taskList)}
    {if $taskList !== FALSE}
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
  {foreach from=$taskList item=tl}
            <tr id="task_{$tl['task_id']|default:''}" class="{$tl['status']|default:''}" data-id="{$tl['task_id']|default:''}">
              <td class="c">
                <select class="checkStatus">
                  <option value="before_work" {if $tl['status']|default:'' == "before_work"}selected="selected"{/if}>作業前</option>
                  <option value="working" {if $tl['status']|default:'' == "working"}selected="selected"{/if}>作業中</option>
                  <option value="after_work" {if $tl['status']|default:'' == "after_work"}selected="selected"{/if}>完了</option>
                </select>
              </td>
              <td class="c">{$tl['create_date']|default:''|date_format:'%Y.%m.%d'}</td>
              <td class="c">{$tl['start_date']|default:''|date_format:'%Y.%m.%d'}</td>
              <td class="c">{$tl['complete_date']|default:''|date_format:'%Y.%m.%d'}</td>
              <td>{$tl['sagyo_sha']|default:''}</td>
              <td class="c">
    {if $tl['yusen_do']|default:'' == 0}
                高
    {elseif $tl['yusen_do']|default:'' == 1}
                中
    {else}
                低
    {/if}
              </td>
              <td>{$tl['gaiyo']|default:''}</td>
              <td>{$tl['naiyo']|default:''}</td>
              <td>{$tl['biko']|default:''}</td>
              <td class="c">
                <a href="editTask.php?project_id={$targetProject[0]['project_id']|default:''}&task_id={$tl['task_id']|default:''}">[編集]</a> 
                <span class="deleteTask">[削除]</span> 
                <span class="taskDrag">[drag]</span>
              </td>
            </tr>
  {/foreach}
          </tbody>
        </table>
    {else}
        <p id="notTask">現在タスクは存在しません。</p>
    {/if}
{/if}
      </div>
    </div><!-- end_content -->
{include file="template.footer.tpl"}
  </div><!-- end_container -->
</body>
</html>