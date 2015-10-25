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
      <div id="nyuryokuTaskDv">
        <p><a href="task.php?project_id={$projectId|default:''}">タスク一覧へ戻る</a></p>
        <h2>{$projectMei|default:''}のタスク新規追加</h2>
{if isset($error)}
        <ul class="errorMessage">
  {foreach from=$error item=e}
          <li>{$e|default:''}</li>
  {/foreach}
        </ul>
{/if}
{if isset($message)}
        <p id="message">{$message|default:''}</p>
{/if}
        <form action="" method="post">
        <table id="nyuryokuTaskTbl">
          <tr>
            <th>作業者</th>
            <td><input type="text" name="frmSagyoSha" value="{$sagyoSha|default:''}" /></td>
          </tr>
          <tr>
            <th>優先度 <span class="cRed">*</span></th>
            <td>
              <label>高<input type="radio" name="frmYusenDo" value="0" {if $yusenDo|default:'' == 0}checked="checked"{/if} /></label>&nbsp;
              <label>中<input type="radio" name="frmYusenDo" value="1" {if $yusenDo|default:'' == 1}checked="checked"{/if} /></label>&nbsp;
              <label>低<input type="radio" name="frmYusenDo" value="2" {if $yusenDo|default:'' == 2}checked="checked"{/if} /></label>
            </td>
          </tr>
          <tr>
            <th>概要 <span class="cRed">*</span></th>
            <td><input type="text" name="frmGaiyo" value="{$gaiyo|default:''}" /></td>
          </tr>
          <tr>
            <th>内容</th>
            <td><textarea name="frmNaiyo">{$naiyo|default:''}</textarea></td>
          </tr>
          <tr>
            <th>備考</th>
            <td><textarea name="frmBiko">{$biko|default:''}</textarea></td>
          </tr>
          <tr>
            <th>作業開始日</th>
            <td><input type="text" id="frmStartDate" name="frmStartDate" value="{$startDate|default:''}" /></td>
          </tr>
          <tr>
            <th>作業完了日</th>
            <td><input type="text" id="frmCompleteDate" name="frmCompleteDate" value="{$completeDate|default:''}" /></td>
          </tr>
        </table>
        <p>
          <input type="submit" value="新規登録" />
          <input type="hidden" name="frmProjectId" value="{$projectId|default:''}" />
          <input type="hidden" name="frmProjectMei" value="{$projectMei|default:''}" />
        </p>
        </form>
      </div>
    </div><!-- end_content -->
{include file="template.footer.tpl"}
  </div><!-- end_container -->
</body>
</html>