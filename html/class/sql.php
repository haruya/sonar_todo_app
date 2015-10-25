<?php

/**
 * ログイン
 */
// ログインするユーザを取得
$userSelect = "
    SELECT
        user_id,
        user_pw,
        user_mei,
        tel,
        email,
        biko,
        create_date,
        update_date
    FROM
        m_user
    WHERE
        user_id = :user_id
    AND
        user_pw = :user_pw
";

/**
 * プロジェクト
 */
// プロジェクト一覧を取得
$projectSelect = "
    SELECT
        project_id,
        project_mei,
        seq,
        status,
        create_date,
        update_date
    FROM
        t_project
    ORDER BY
        seq
";

// プロジェクト削除(AJAX[物理削除])
$projectDelete = "
    DELETE FROM
        t_project
    WHERE
        project_id = :project_id
";

// プロジェクトstatus変更
$projectStatusUpdate = "
    UPDATE
        t_project
    SET
        status = (
            CASE
                WHEN status = 'done' THEN 'notyet'
                ELSE 'done'
            END
        )
    WHERE
        project_id = :project_id
";

// プロジェクト並び替え変更
$projectSeqUpdate = "
    UPDATE
        t_project
    SET
        seq = :seq
    WHERE
        project_id = :project_id
";

// プロジェクト名変更
$projectMeiUpdate = "
    UPDATE
        t_project
    SET
        project_mei = :project_mei
    WHERE
        project_id = :project_id
";

// プロジェクト追加の際の並び順の最後の値を取得
$projectMaxSeqSelect = "
    SELECT
        MAX(seq) + 1 as maxSeq
    FROM
        t_project
";

// プロジェクト追加
$projectInsert = "
    INSERT INTO
        t_project(
            project_mei,
            seq,
            create_date,
            update_date
        ) value (
            :project_mei,
            :seq,
            now(),
            now()
        )
";

/**
 * タスク
 */

// タスク一覧取得の際にプロジェクトの存在有無の確認&プロジェクト取得
$targetProjectSelect = "
    SELECT
        project_id,
        project_mei,
        seq,
        status,
        create_date,
        update_date
    FROM
        t_project
    WHERE
        project_id = :project_id
";

// タスク一覧を取得
$taskSelect = "
    SELECT
        task_id,
        project_id,
        gaiyo,
        naiyo,
        biko,
        seq,
        status,
        yusen_do,
        sagyo_sha,
        start_date,
        complete_date,
        create_date,
        update_date
    FROM
        t_task
    WHERE
        project_id = :project_id
    ORDER BY
        seq
";

// 変更対象のタスクを取得
$editTaskSelect = "
    SELECT
        tt.task_id as task_id,
        tt.project_id as project_id,
        tp.project_mei as project_mei,
        tt.gaiyo as gaiyo,
        tt.naiyo as naiyo,
        tt.biko as biko,
        tt.seq as seq,
        tt.status as status,
        tt.yusen_do as yusen_do,
        tt.sagyo_sha as sagyo_sha,
        tt.start_date as start_date,
        tt.complete_date as complete_date,
        tt.create_date as create_date,
        tt.update_date as update_date
    FROM
        t_task as tt
    INNER JOIN
        t_project as tp
    ON
        tt.project_id = tp.project_id
    WHERE
        tt.task_id = :task_id AND tt.project_id = :project_id
";

// タスク追加の際の並び順の最後の値を取得
$taskMaxSeqSelect = "
    SELECT
        MAX(seq) + 1 as maxSeq
    FROM
        t_task
    WHERE
        project_id = :project_id
";

// タスク追加
$taskInsert = "
    INSERT INTO
        t_task(
            project_id,
            gaiyo,
            naiyo,
            biko,
            seq,
            yusen_do,
            sagyo_sha,
            start_date,
            complete_date,
            create_date,
            update_date
        ) value (
            :project_id,
            :gaiyo,
            :naiyo,
            :biko,
            :seq,
            :yusen_do,
            :sagyo_sha,
            :start_date,
            :complete_date,
            now(),
            now()
        )
";

// 対象タスク変更
$taskUpdate = "
    UPDATE
        t_task
    SET
        gaiyo = :gaiyo,
        naiyo = :naiyo,
        biko = :biko,
        yusen_do = :yusen_do,
        sagyo_sha = :sagyo_sha,
        start_date = :start_date,
        complete_date = :complete_date,
        update_date = now()
    WHERE
        project_id = :project_id
    AND
        task_id = :task_id
";

// タスク削除(AJAX[物理削除])
$taskDelete = "
    DELETE FROM
        t_task
    WHERE
        task_id = :task_id
    AND
        project_id = :project_id
";

// タスク並び替え変更
$taskSeqUpdate = "
    UPDATE
        t_task
    SET
        seq = :seq
    WHERE
        task_id = :task_id
    AND
        project_id = :project_id
";

// タスクstatus変更
$taskStatusUpdate = "
    UPDATE
        t_task
    SET
        status = :status
    WHERE
        task_id = :task_id
    AND
        project_id = :project_id
";