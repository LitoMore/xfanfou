# xfanfou

## 代码规范
- [基本代码规范][1]
- [代码风格规范][2]
- [git 操作规范][3]
- [模板开发约定][4]
- [路由定义约定][5]

## 基本框架
### 结构
```
.
├── app
│   └── Http
│   │   ├── Controllers 控制器目录
│   │   │   └── Home    页面控制器
│   │   └── routes.php  路由   
├── config              配置文件
├── public              站点根目录
├── resource            视图
├── util            
│   ├── api             API方法
│   ├── helper          通用方法
│   ├── network         HTTP方法
│   ├── oauth
│   └── xauth
└── .env                Laravel配置文件
```

[1]:https://coding.net/u/angelito/p/xfanfou/git/blob/develop/docs/psr-1.md
[2]:https://coding.net/u/angelito/p/xfanfou/git/blob/develop/docs/psr-2.md
[3]:https://coding.net/u/angelito/p/xfanfou/git/blob/develop/docs/git-flow.md
[4]:https://coding.net/u/angelito/p/xfanfou/git/blob/develop/docs/laravel-views.md
[5]:https://coding.net/u/angelito/p/xfanfou/git/blob/develop/docs/laravel-routes.md