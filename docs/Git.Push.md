# `Git::Push()` Current Behavior

## Overview

`Git::Push()` pushes one local branch to one remote.

Owner file:

`asset/unit/git/Git.class.php`

Current caller of interest:

`asset/unit/cd/CD_2024.trait.php`

## Current Push Flow

The current implementation receives:

- remote name
- branch name
- force flag
- result output reference

It first reads the local branch commit ID.

It then tries to read the remote-tracking branch commit ID using:

```text
<remote>/<branch>
```

For example:

```text
origin/uqunie
```

If the local and remote-tracking commit IDs are equal, the method returns `true`
without running `git push`.

If they are not equal, the method runs:

```text
git push <remote> <branch>
```

## Remote-Tracking Branch Missing

As-Is, a missing remote-tracking branch does not block the push.

When `origin/<branch>` does not exist, `Git::CommitID()` emits a notice like:

```text
This branch name is not exists. ('origin/uqunie')
```

and returns an empty string.

`Git::Push()` does not currently treat that empty remote commit ID as a hard
failure. It only compares the local commit ID with the remote commit ID.

Because the values differ, it proceeds to run:

```text
git push origin uqunie
```

Git then treats this as a request to create or update the remote branch.

Therefore, the current As-Is behavior is:

- the missing `origin/<branch>` notice can be printed
- the subsequent push can still succeed
- the remote branch may be created by that push

## Relationship To `op-unit-cd`

`op-unit-cd` calls `Git::Push()` after its own branch publication check.

The CD-side check `isCanPushToGithub()` controls whether a branch name may be
pushed to GitHub.

It does not currently verify that the remote-tracking branch already exists.

So, if CD allows the branch name, `Git::Push()` can still create the missing
remote branch as described above.

## Design Status

This is documented as current implementation behavior.

It is not a request to change the implementation.
