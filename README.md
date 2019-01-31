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

* 自定义处理推送结果:

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
* 推送示例

![Image text](https://raw.githubusercontent.com/chanlly/dingRobot/master/resource/image/robot_text_message.png)

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
* 推送示例

![Image text](https://github.com/chanlly/dingRobot/raw/master/resource/image/robot_md_message.png)


3. 推送`ActionCard`类型消息(一)

```php
/* ======== 设置描述文本(markdown或者纯文本) ======== */
$message = DPushActionCardList::make("聊天显示概要");
$message->appendCite("审批申请！");
$message->appendCite("这是一段审批简介1");
$message->appendCite("这是一段审批简介2");
$message->appendCite(MDTextHyperlink::make('详情', 'http://www.baidu.com'));
/* ======== 设置排列方式为横向 ======== */
$message->setBtnOrientation(DPushActionCard::BTN_ORIENTATION_HORIZONTAL);
$message->appendBtn("同意","http://www.baidu.com");
$message->appendBtn("拒绝", "http://www.baidu.com");
DingRobot::get('access_token')->push($message);
```

* 横向排列示例 `$message->setBtnOrientation(DPushActionCard::BTN_ORIENTATION_HORIZONTAL);`


* 竖直排列示例 `$message->setBtnOrientation(DPushActionCard::BTN_ORIENTATION_VERTICAL);`


4. 推送`ActionCard`类型消息(二)

```php
$message = DPushActionCardOne::make("聊天显示概要");
$message->appendTitle("标题");
$message->appendCite("概要介绍1");
$message->appendCite("概要介绍2");

$message->setSingleTitle("这是跳转链接标题");
$message->setSingleURL("http://www.baidu.com");
DingRobot::get('access_token')->push($message);
```

* 推送示例


5. 推送`link`类型消息

```php
$messageUrl = 'https://image.baidu.com/search/index?tn=baiduimage&ipn=r&ct=201326592&cl=2&lm=-1&st=-1&fm=result&fr=&sf=1&fmq=1548921909883_R&pv=&ic=&nc=1&z=&hd=&latest=&copyright=&se=1&showtab=0&fb=0&width=&height=&face=0&istype=2&ie=utf-8&hs=2&word=%E7%8B%82%E4%B8%89';
$picUrl = 'https://timgsa.baidu.com/timg?image&quality=80&size=b10000_10000&sec=1548922085&di=4f7f0aa0f29792e6c5d38cc1fe29e994&src=http://b-ssl.duitang.com/uploads/item/201607/29/20160729212858_FyiLZ.jpeg';
$text = '简介，即简明扼要的介绍。是当事人全面而简洁地介绍情况的一种书面表达方式，它是应用写作学研究的一种日常应用文体。';
$message = DPushLink::make("百度一下，你就知道", $text, $messageUrl, $picUrl);
DingRobot::get('access_token')->push($message);
```

* 推送示例


6. 推送`FeedCard`类型消息

```php
$message = DPushFeedCard::make();
$message->appendLink("大标题", "http://www.baidu.com", "https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1548932526783&di=3d8345d0e2657a52310575f6a2ad47ed&imgtype=0&src=http%3A%2F%2Fs7.sinaimg.cn%2Fmw690%2F006886pozy74XL8aocu76%26690");
$message->appendLink("小标题1", "http://www.baidu.com", "http://imgsrc.baidu.com/imgad/pic/item/34fae6cd7b899e51fab3e9c048a7d933c8950d21.jpg");
$message->appendLink("小标题2", "http://www.baidu.com", "http://img15.3lian.com/2015/a1/14/d/23.jpg");
$message->appendLink("小标题3", "http://www.baidu.com", "http://f7.topitme.com/7/91/0f/11321340208bd0f917o.jpg");
DingRobot::get('access_token')->push($message);
```

* 推送示例
