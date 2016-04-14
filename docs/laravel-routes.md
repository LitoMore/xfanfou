# 路由定义约定
## API 路由
首先请熟悉 **隐式控制器** 描述

本项目中所有URL一律使用隐式控制器定义，即每个URL需要可以明确到某个**资源**

下面以 **account** 为一个资源，对URL进行简单描述（实际项目中可能不会使用到所有的方法），还请多多理解

使用下面的命令创建控制器：

`php artisan make:controller Api\\AccountController`

路由定义：

```
Route::controller('api/account', 'Api\AccountController');
```

实际代码中可能会是这样：

```
Route::controllers([
    'api/users' => 'Api\UsersController',
    'api/account' => 'Api\AccountController'
]);
```

| 请求方法 | 请求地址 | 描述 | 默认的对应控制器方法 |
|:---:|:---|:---|:---|
| GET | /api/account/verify-credentials | 检查用户名密码是否正确 | Api\FriendshipsController::getVerifyCredentials() |
| POST | /api/account/verify-credentials | 检查用户名密码是否正确 | Api\FriendshipsControllers::postVerifyCredentials() |
| POST | /api/account/update-profile-image | 通过 API 更新用户头像 | Api\AccountController::postUpdateProfileImage() |
| GET | /api/account/rate-limit-status | 获取 API 限制 | Api\AccountController::getRateLimitStatus() |
| POST | /api/account/update-profile | 通过 API 更新用户资料 | Api\AccountController::postUpdateProfile() |
| GET | /api/account/notification | 返回未读的mentions, direct message 以及关注请求数量 | Api\AccountController::getNotification() |
| POST | /api/account/update-notify-num | 向饭否更新当前app上的新提醒数量 | Api\AccountController::postUpdateNotifiyNum() |
| GET | /api/account/notify-num | 获取当前app上的新提醒数量 | Api\AccountController::getNotifyNum() |

具体注册方法还请查阅Laravel手册中关于 `路由` 部分的描述
