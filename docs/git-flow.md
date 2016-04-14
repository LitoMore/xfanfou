### 约定
1. 文档编码格式**一定** **务必** **必须**是**UTF-8**
2. 换行符一律用`\n`，而不是Windows的`\r\n` （在开发机上直接vim开发不会存在此问题）
3. Git托管平台一律使用 [Coding](http://coding.net)
4. git版本 ≥ **2.6.3**
5. git配置

- 首先设置git用户名和邮件地址,在终端命令行下输入:

```bash
git config --global user.name "Zhang san"             # 请准确配置自己的name，姓.名，首字母大写
git config --global user.email "zhangsan@domain.com"  # 邮件地址，请 务必 使用工作邮箱
```

- 其它设置,可以直接粘贴到命令行终端:

```bash
git config --global branch.autosetuprebase always  # 重要:pull同步代码之后对本地分支进行rebase而不是merge,减少不必要的合并
git config --global pull.rebase true               # 重要:pull同步代码之后对本地分支进行rebase而不是merge,减少不必要的合并
git config --global gui.encoding utf-8             # UI采用utf-8编码
git config --global i18n.commitencoding utf-8      # 采用utf-8编码提交log
git config --global i18n.logoutputencoding utf-8   # log输出采用utf-8格式
git config --global color.ui auto                  # 打开彩色输出
git config --global core.ignoreCygwinFSTricks true # 解决windows系统下速度慢的问题
git config --global alias.lg "log --color --graph --pretty=format:'%Cred%h%Creset %C(bold blue)%an%Creset%C(yellow)%d%Creset %s %Cgreen(%cr)' --abbrev-commit" #增加git lg命令，对log输出进行美化
git config --global alias.st status                # 增加命令别名git st -> git status
git config --global alias.br branch                # 增加命令别名git br -> git branch
git config --global alias.co checkout              # 增加命令别名git co -> git checkout
git config --global alias.ci commit                # 增加命令别名git ci -> git commit
```

### git操作规范

每个新任务的开发都需要在单独的分支上进行，并且这个分支必须来源于develop分支
当这个任务完成后，这个分支将被合并到develop分支
当develop分支积攒够一定数量的功能后，它将被合并到master分支作为一个可以发布的版本
新分支的命名一定要让人一眼就能知道它是在做什么事

我们推荐的git开发模型为**git flow**，它的历史状态看起来应该如下图所示。关于它更详细的介绍猛戳[传送门](http://www.ituring.com.cn/article/56870)

![git flow](http://7xidlu.com2.z0.glb.qiniucdn.com/redmine/gitflow.png)

在我们已有项目中，使用`git lg`查看到的历史记录格式如下（这里直接借用了我以前的项目截图）：

![our git flow](http://7xidlu.com2.z0.glb.qiniucdn.com/redmine/our_gitflow.png)

### 细节操作示例

```bash
# 假设我接到一个“增加用户分组验证功能”的任务，并且我在开发服务器上的代码仓库路径是 /home/skidu/git/beyou
# 登录开发服务器

cd git/beyou

# 切换到develop分支
git checkout develop

# 开工前，先将远端的develop分支同步到我的本地仓库中来，避免将来提交的时候产生太多的冲突
git fetch
git pull origin develop

# 创建工作分支
# 命令格式：  git branch 需要创建的分支名称 基于哪个分支创建？
# 请注意，后面的origin/develop一定要加，它表示我的这个分支是基于远端的develop分支创建的
git branch feature/add-usergroup-verify origin/develop
git checkout feature/add-usergroup-verify

# 接下来就开始各种编码
# 编码的过程中，应该注意养成随时将当前工作分支推送到远端仓库的习惯，以免因为不可预估的事故出现后开发的代码损失

# 工作完成后，准备提交代码
# 查看修改记录
git status

# 将打印出来的“有改动”的文件通过git add命令添加进去
# 假设我增加了一个文件：  app/user.php
# 将这个文件/改动添加到本次提交的计划中去
git add app/user.php

# 进行本地提交
git commit

# 输入完这个命令后，将进入一个编辑界面，操作和vi一样，按i键进入编辑模式，输入好更新内容后再按ESC，然后在英文状态下输入:wq 保存退出
# 至此，本地提交完成，接下来我们将代码推送到托管平台

# push前再次更新本地分支状态
git fetch
git pull origin develop

# 到这一步，如果没有问题，我们就可以直接push了，否则，请一定先解决提示的问题

# 可以顺便使用lg命令查看一下历史提交是否有问题
#
git lg

# push代码
git push origin feature/add-usergroup-verify

# 至此，push完毕
# 在确认代码无误后，前往coding.net平台，我们的这个项目里，依次选择 代码 -> 合并请求 -> 新建MergeRequest
#
# 源分支这里选择我们刚刚push过来的分支名： feature/add-usergroup-verify
# 目标分支选择 develop
# 然后选择提交
# 至此，关于这个任务的工作完毕
```

---

下面是我在开发机上实际操作的命令记录

```bash
# 进入到工作目录
# 我的习惯是将所有在git仓库中做的事都放在一个叫做git的目录里
# 所以这个git目录是我自己手工创建的
# 另，项目目录，它来源于git clone命令，clone后将会在当前目录中生成一个跟仓库名一致的目录，便是对应仓库的工作目录了
# 第一次可能没有相关目录，请通过 git clone 命令将远端代码克隆一份到本地

[skidu@dev ~]$ cd git/beyou/

# 切换到develop分支
[skidu@dev huanlv]$ git checkout develop

# 屏幕输出如下：
Branch develop set up to track remote branch develop from origin.
Switched to a new branch 'develop'

# 基于远端的develop分支创建工作分支“feature/add-usergroup-verify”
[skidu@dev huanlv]$ git branch feature/add-usergroup-verify origin/develop

# 屏幕输出如下
Branch feature/add-usergroup-verify set up to track remote branch develop from origin.

# 切换到工作分支
[skidu@dev huanlv]$ git checkout  feature/add-usergroup-verify
Switched to branch 'feature/add-usergroup-verify'
Your branch is up-to-date with 'origin/develop'.

# 工作中。。。
[skidu@dev huanlv]$ mkdir demo
[skidu@dev huanlv]$ vim demo/test.php
# 至此，演示工作结束。创建了demo目录，并往里面增加了test.php并写入了一些内容

# 查看仓库变更
[skidu@dev huanlv]$ git status

# 此时，屏幕输出如下
# 可以得知，本次工作主要变更是增加了demo目录
On branch feature/add-usergroup-verify
Your branch is up-to-date with 'origin/develop'.
Untracked files:
  (use "git add <file>..." to include in what will be committed)

	demo/

nothing added to commit but untracked files present (use "git add" to track)

# 使用git add命令添加本次变更
[skidu@dev huanlv]$ git add demo/

# 进行一次本地提交
# 请注意，这时git会检查一下你的用户配置，比如email、username
# 如果没有的话界面中会提示出来
# 可以使用界面中给出的命令完成配置，请一定保证配置的内容是正确无误的
[skidu@dev huanlv]$ git commit

# 下面的内容是执行commit后界面中显示的内容，我在第一行输入了“本次提交是给大家演示工作流程用的”

本次提交是给大家演示工作流程用的
# Please enter the commit message for your changes. Lines starting
# with '#' will be ignored, and an empty message aborts the commit.
# On branch feature/add-usergroup-verify
# Your branch is up-to-date with 'origin/develop'.
#
# Changes to be committed:
#       new file:   demo/test.php
#

[feature/add-usergroup-verify d3417ca] 本次提交是给大家演示工作流程用的
 1 file changed, 3 insertions(+)
 create mode 100644 demo/test.php

# push前，先同步一下本地分支状态
[skidu@dev huanlv]$ git fetch
[skidu@dev huanlv]$ git pull origin develop
From coding.net:skidu/beyou
 * branch            develop    -> FETCH_HEAD
Already up-to-date.

# 确认没问题后，push
[skidu@dev huanlv]$ git push origin feature/add-usergroup-verify
Counting objects: 4, done.
Compressing objects: 100% (2/2), done.
Writing objects: 100% (4/4), 413 bytes | 0 bytes/s, done.
Total 4 (delta 0), reused 0 (delta 0)
To git@coding.net:skidu/beyou.git
 * [new branch]      feature/add-usergroup-verify -> feature/add-usergroup-verify

# 至此，工作完毕。到平台上发起一次Merge Request合并即可
```
