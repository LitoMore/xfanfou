# 模板开发约定

本文主要描述项目中各模板文件及相关 section 使用进行描述

## 主题

针对访问者的浏览器类型，项目中简单将模板分为 **f7ios** 和 **material** 两类

与各主题相关的模板一律放在项目 `resources/views/主题名` 为名的目录中，比如 `resources/views/f7ios`

在此目录下的目录结构则根据实际 **控制器**、**请求方法** 进行命名，模板文件名后缀一律为 **.blade.php**

例如，`Home\IndexController::getIndex()` 对应主题（这里暂定为**f7ios**）的模板应该存放于`resources/views/f7ios/index.blade.php`

所有 **主题** 的 **基础模板** 一律存放在 `resources/views/主题名/layout` 目录并以 **模板名** +  `.blade.php` 命名，比如 `base.blade.php`（可根据实际使用情况进行调整）

## 调用

控制器基类中定义了成员变量 `$theme` 用于记录模板类型（ **f7ios** 或者 **material** 或其它 ），一个 `view()` 调用可能如下：

```php
<?php

namespace App\Http\Controller\Home;

class IndexController extends BaseController
{

    public function index()
    {
        // ....业务代码
        return view( $this->theme . '.index', $params );
    }
}
```

## 代码注释

模板文件中的注释一律使用 **blade** 语法，即使用 `{{--` 和 `--}}` 包含需要被注释部分的代码，**严禁**使用 html 自己的注释 `<!-- -->` 语法

## 静态资源

### CSS

全局性的样式请在 `public/assets/主题名/css/app.css` 中描写

只跟当前页面相关的样式需编写在 `public/assets/主题名/css/pages/具体模板.css` 中，比如 `Home\SettingsController::index` 对应模板的局部样式，请命名为 `settings_index.css`，完整路径为 `public/assets/主题名/css/pages/settings_index.css`

> 原则上只允许在 `css` yield 中引入 css 文件

### JavaScript

全局性的功能方法请在 `public/assets/主题名/js/app.js` 中编写

当前页面使用的 js 请在 `public/assets/主题名/js/pages/具体模板.js` 中开发，命名方式参照上文 css 中相关描述

> 原则上只允许在 `js` yield中引入 js 文件
