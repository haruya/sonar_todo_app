$(function() {
  
  /**
   * datepicker
   */
  // 日本語を有効化
  $.datepicker.setDefaults($.datepicker.regional['ja']);
  // 日付選択ボックスを生成
  $('#frmStartDate, #frmCompleteDate').datepicker({
    dateFormat: 'yy-mm-dd',
    showOn: 'both'
  });

  /**
   * messageフェードアウト
   */
  setTimeout(function() {
    $('#message').fadeOut("slow");
  }, 800);
  
  /**
   * プロジェクト
   */
  // プロジェクト管理(新規)dialogオープン
  $('#addProject').click(function() {
    $('#projectAddDialog').dialog("open");
  });
  
  // プロジェクト新規追加処理
  $('#frmProjectAdd').click(function() {
    $('#frmProjectAdd').attr("disabled", "disabled");
    $('#projectMeiErr').remove();
    var error = false;
    var projectMei = $('#projectAddDialog #frmProjectMei').val();
    if (projectMei.length == 0) {
      $('#projectAddDialog #frmProjectMei').after('<p id="projectMeiErr" style="color: red">「プロジェクト名」は入力必須です。</p>');
      error = true;
      $('#frmProjectAdd').removeAttr("disabled");
    } else if (projectMei.length >= 32) {
      $('#projectAddDialog #frmProjectMei').after('<p id="projectMeiErr" style="color: red">「プロジェクト名」は32文字以下で入力してください。</p>');
      error = true;
      $('#frmProjectAdd').removeAttr("disabled");
    }
    if (error == false) {
      $.post('_ajax_add_project.php', {
        projectMei: projectMei
      }, function(rs) {
        if ($('#projects').length) {
          var e = $(
            '<tr id="project_' +rs+'" data-id="'+rs+'">' +
            '<td class="c"><input type="checkbox" class="checkProject"></td>' +
            '<td><span></span></td>' +
            '<td class="c"><a href="task.php?project_id='+rs+'">[タスク]</a> <span class="editProject">[編集]</span> <span class="deleteProject">[削除]</span> <span class="projectDrag">[drag]</span></td>' +
            '</tr>'
          );
          $('#projects').append(e).find('tr:last td:eq(1) span:first-child').text(projectMei);
        } else {
          $('#notProject').remove();
          var e = $(
            '<table id="projects" style="border-collapse: collapse;" border="1">' +
            '<thead><tr><th>完了チェック</th><th>プロジェクト名</th><th>操作</th></tr></thead>' +
            '<tbody>' +
            '<tr id="project_' +rs+'" data-id="'+rs+'">' +
            '<td class="c"><input type="checkbox" class="checkProject"></td>' +
            '<td><span></span></td>' +
            '<td class="c"><a href="task.php?project_id='+rs+'">[タスク]</a> <span class="editProject">[編集]</span> <span class="deleteProject">[削除]</span> <span class="projectDrag">[drag]</span></td>' +
            '</tr></tbody></table>'
          );
          $('#content').append(e).find('tr:last td:eq(1) span:first-child').text(projectMei);
        }
        $('#projectAddDialog').dialog("close");
        $('#frmProjectAdd').removeAttr("disabled");
      });
    }
  });

  // プロジェクト管理(編集)dialogオープン
  $(document).on('click', '.editProject', function() {
    var projectId = $(this).parent().parent().data('id');
    var projectMei = $(this).parent().prev().children('span:first-child').text();
    $('#projectEditDialog #frmProjectMei').val(projectMei);
    $('#projectEditDialog #frmProjectId').val(projectId);
    $('#projectEditDialog').dialog("open");
  });

  // プロジェクト編集処理
  $('#frmProjectEdit').click(function() {
    $('#frmProjectEdit').attr("disabled", "disabled");
    $('#projectMeiErr').remove();
    var error = false;
    var projectId = $('#projectEditDialog #frmProjectId').val();
    var projectMei = $('#projectEditDialog #frmProjectMei').val();
    if (projectMei.length == 0) {
      $('#projectEditDialog #frmProjectMei').after('<p id="projectMeiErr" style="color: red">「ユーザ名」は入力必須です。</p>');
      error = true;
      $('#frmProjectEdit').removeAttr("disabled");
    } else if (projectMei.length >= 32) {
      $('#projectEditDialog #frmProjectMei').after('<p id="projectMeiErr" style="color: red">「ユーザ名」は32文字以下で入力してください。</p>');
      error = true;
      $('#frmProjectEdit').removeAttr("disabled");
    }
    if (error == false) {
      $.post('_ajax_update_project.php', {
        projectId: projectId,
        projectMei: projectMei
      }, function(rs) {
        $('#project_'+projectId).append().find('td:eq(1) span:first-child').text(projectMei);
        $('#projectEditDialog').dialog("close");
        $('#frmProjectEdit').removeAttr("disabled");
      });
    }
  });

  // プロジェクト管理(新規、編集)dialog設定
  $('#projectAddDialog, #projectEditDialog').dialog({
    autoOpen: false,
    width: "auto",
    height: "auto",
    show: "drop",
    hide: "drop",
    modal: true,
    close: function() {
      $('#projectMeiErr').remove();
      $('#frmProjectMei').val('');
      $('#frmProjectId').val('');
    }
  });

  $('#projects tbody').sortable({ // プロジェクト並び替え処理
    axis: 'y',
    opacity: 0.2,
    handle: '.projectDrag',
    update: function() {
      $.post('_ajax_sort_project.php', {
        project: $(this).sortable('serialize')
      });
    }
  });

  $(document).on('click', '.checkProject', function() { // プロジェクトstatus変更処理
    var id = $(this).parent().parent().data('id');
    var projectMei = $(this).parent().next().children();
    $.post('_ajax_check_project.php', {
      id: id
    }, function(rs) {
      if (projectMei.hasClass('done')) {
        projectMei.removeClass('done').parent().next().children('span:eq(0)').addClass('editProject');
      } else {
        projectMei.addClass('done').parent().next().children('span:eq(0)').removeClass('editProject');
      }
    });
  });

  $(document).on('click', '.deleteProject', function() { // プロジェクト削除処理
    if (confirm('本当に削除しますか？')) {
      var id = $(this).parent().parent().data('id');
      $.post('_ajax_delete_project.php', {
        id: id
      }, function(rs) {
        $('#project_' + id).fadeOut(800);
      });
    }
  });
    
  /**
   * タスク
   */
  $('#tasks tbody').sortable({ // タスク並び替え処理
    axis: 'y',
    opacity: 0.2,
    handle: '.taskDrag',
    update: function() {
      $.post('_ajax_sort_task.php', {
        task: $(this).sortable('serialize'),
        projectId: $('#projectId').val()
      });
    }
  });

  $(document).on('change', '.checkStatus', function() {
    var status = $(this).val();
    var taskId = $(this).parent().parent().data('id');
    var projectId = $('#projectId').val();
    $.post('_ajax_status_task.php', {
      status: status,
      taskId: taskId,
      projectId: projectId
    }, function(rs) {
      $('#task_' + taskId).removeClass().addClass(status);
    });
  });

  $(document).on('click', '.deleteTask', function() { // タスク削除処理
    if (confirm('本当に削除しますか？')) {
      var taskId = $(this).parent().parent().data('id');
      var projectId = $('#projectId').val();
      $.post('_ajax_delete_task.php', {
        taskId: taskId,
        projectId: projectId
      }, function(rs) {
        $('#task_' + taskId).fadeOut(800);
      });
    }
  });
});