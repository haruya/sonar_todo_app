<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
{include file="template.head.tpl"}
</head>
<body>
  <div id="container">
{include file="template.header.tpl"}
    <div id="content">
      <div id="loginDv">
{if isset($error)}
        <ul class="errorMessage">
  {foreach from=$error item=e}
          <li>{$e|escape|default:''}</li>
  {/foreach}
        </ul>
{/if}
        <form action="" method="POST">
        <table id="loginTbl">
          <tr>
            <th>ID</th>
            <td><input type="text" name="frmUserId" value="{$userId|default:''}" /></td>
          </tr>
          <tr>
            <th>パスワード</th>
            <td><input type="password" name="frmUserPw" value="{$userPw|default:''}" /></td>
          </tr>
          <tr>
            <td colspan="2">
              <input type="hidden" name="frmKiokuFlag" value="0" />
              <label><input type="checkbox" name="frmKiokuFlag" value="1" {if $kiokuFlag|default:'' == 1}checked="checked"{/if} />&nbsp;IDとパスワードを記憶する</label>
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
{include file="template.footer.tpl"}
  </div><!-- end_container -->
</body>
</html>