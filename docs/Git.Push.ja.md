# `Git::Push()` の current 挙動

## 概要

`Git::Push()` は、1 つの local branch を 1 つの remote に push します。

責務を持つ file:

`asset/unit/git/Git.class.php`

今回関係する主な呼び出し元:

`asset/unit/cd/CD_2024.trait.php`

## current の push flow

current 実装は、次を受け取ります。

- remote 名
- branch 名
- force flag
- result output の参照

まず local branch の commit ID を取得します。

次に、remote-tracking branch の commit ID を次の形式で取得しようとします。

```text
<remote>/<branch>
```

例:

```text
origin/uqunie
```

local と remote-tracking の commit ID が一致していれば、`git push` を実行せずに
`true` を返します。

一致していなければ、次を実行します。

```text
git push <remote> <branch>
```

## remote-tracking branch が存在しない場合

As-Is では、remote-tracking branch が存在しないこと自体では push は止まりません。

`origin/<branch>` が存在しない場合、`Git::CommitID()` は次のような notice を出します。

```text
This branch name is not exists. ('origin/uqunie')
```

そして空文字を返します。

`Git::Push()` は、この空の remote commit ID を現在 hard failure として扱っていません。
local commit ID と remote commit ID を比較するだけです。

値が一致しないため、処理は次へ進みます。

```text
git push origin uqunie
```

Git はこれを remote branch の作成または更新要求として扱います。

そのため、current の As-Is 挙動は次です。

- `origin/<branch>` 不在の notice が表示されることがある
- その後の push は成功し得る
- その push によって remote branch が作成され得る

## `op-unit-cd` との関係

`op-unit-cd` は、CD 側の branch 公開可否チェックを行った後に `Git::Push()` を呼びます。

CD 側の `isCanPushToGithub()` は、branch 名を GitHub に push してよいかどうかを判定します。

しかし current 実装では、remote-tracking branch が既に存在するかどうかまでは確認していません。

したがって、CD が branch 名を許可した場合、`Git::Push()` は上記の通り、存在しない remote branch を
作成する push まで進み得ます。

## 設計上の位置づけ

これは current 実装の挙動として記録しています。

実装変更を求めるものではありません。
