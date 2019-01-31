# dingRobot

#### 介绍
钉钉机器人消息推送 简单封装

#### 安装教程

1. 在`composer.json`文件中`repositories`部分加入以下配置

* `gitHub`

```json
{
    "type": "git",
    "url": "https://github.com/chanlly/dingRobot.git"
}
```

* `gitee`

```json
{
    "type": "git",
    "url": "git@gitee.com:canl/dingRobot.git"
}
```

2. 执行`composer require "chanlly/dingRobot"`

#### 推送响应说明

> `DingRobot` 该类未实现对接口响应的处理，默认`request`方法会返回curl原始的返回数据，如果需要处理响应接口。

* 自定义:

1. 继承`DingRobot`类，并重新`request`方法, 使用自定义的请求类实现并返回 

2. 新建类并实现`Chanlly\DingRobot\Contacts\IPush`接口

3. 在外部判断响应接口。注: 成功将返回`{"errmsg":"ok","errcode":0}`

* 示例

```php
$response = DingRobot::get('access_token')->push(DPushText::make('测试'));
if ($response === false) {
    // success
}else {
    $response = json_decode($response, true);
    if ($response['errcode'] === 0) {
        // success
    }else {
        // error
        $err_msg = $response['errmsg'];
        $err_code = $response['errcode'];
    }
}

```


#### 使用说明

1. 推送文本消息

```php
$message = DPushText::make('这是一条测试消息');
DingRobot::get('access_token')->push($message);
```
* 示例


2. 推送`markdown`消息

```php
$message = DPushMD::make('左侧标题');
$message->appendTitle('Title');
$message->appendCite('text: cite');
$message->appendHyperlink('百度', 'http://www.baidu.com');
$message->appendImage('https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=22102217,2573612035&fm=27&gp=0.jpg');
$message->appendItemsOrderly([' o-item1', ' o-item2', ' o-item3']);
$message->appendText(new class('自定义测试文本', 'custom') extends AbsMDText {
    
    /**
     * handle the text
     * @param string $text
     * @param array $args
     * @return string
     */
    public function handle(string $text, ... $args): string
    {
        return 'content: ' . $text . self::NEXT_LINE.
            '传入参数: ' . json_encode($args, JSON_UNESCAPED_UNICODE) . self::NEXT_LINE .
            '处理结果: ' . '* '.$text;
    }
});

DingRobot::get('access_token')->push($message);

```