<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\www\twothink\public/../application/user/view/default/login\index.html";i:1542070647;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <div class="container">
    <h2>用户登录</h2>

    <link href="/static/home/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/home/css/style.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <style>
      .main{margin-bottom: 60px;}
      .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
    </style>
  </div>
</head>

<section>
  <div class="main">
    <!--导航部分-->
    <nav class="navbar navbar-default navbar-fixed-bottom">
      <div class="container-fluid text-center">
        <div class="col-xs-3">
          <p class="navbar-text"><a href="index.html" class="navbar-link">首页</a></p>
        </div>
        <div class="col-xs-3">
          <p class="navbar-text"><a href="#" class="navbar-link">服务</a></p>
        </div>
        <div class="col-xs-3">
          <p class="navbar-text"><a href="#" class="navbar-link">发现</a></p>
        </div>
        <div class="col-xs-3">
          <p class="navbar-text"><a href="#" class="navbar-link">我的</a></p>
        </div>
      </div>
    </nav>
    <!--导航结束-->
    <div class="container-fluid">
    <form action="" method="post">
        <div class="form-group">
          <label>您的姓名(必填):</label>
          <input type="text" id="inputEmail"  class="form-control"  placeholder="请输入用户名"  ajaxurl="/member/checkUserNameUnique.html" errormsg="请填写1-16位用户名" nullmsg="请填写用户名" datatype="*1-16" value="" name="username">
        </div>

      <div class="form-group">
        <label for="inputPassword">密码</label>
        <div class="form-group">
          <input type="password" id="inputPassword" placeholder="请输入密码"  errormsg="密码为6-20位" nullmsg="请填写密码" datatype="*6-20" name="password" class="form-control">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputPassword">验证码</label>
        <div class="controls">
          <input type="text" id="inputPassword" placeholder="请输入验证码"  errormsg="请填写5位验证码" nullmsg="请填写验证码" datatype="*5-5" name="verify" class="form-control">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label"></label>
        <div class="controls verifyimg">
          <?php echo captcha_img(); ?>
        </div>
        <div class="controls Validform_checktip text-warning"></div>
      </div>
        <div  class="form-group">
          <button class="btn btn-primary onlineBtn">登 陆</button>
        </div>

      <p><span><span class="pull-right"><span>还没有账号? <a href="<?php echo url('login/register'); ?>" class="btn btn-sm btn-warning">立即注册</a></span> </span></p>
    </form>
  </div>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="/static/home/jquery-1.11.2.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="/static/home/bootstrap/js/bootstrap.min.js"></script>
</section>
<body>
<script type="text/javascript">

    $(document)
        .ajaxStart(function(){
            $("button:submit").addClass("log-in").attr("disabled", true);
        })
        .ajaxStop(function(){
            $("button:submit").removeClass("log-in").attr("disabled", false);
        });


    $("form").submit(function(){
        var self = $(this);
        $.post(self.attr("action"), self.serialize(), success, "json");
        return false;

        function success(data){
            if(data.code){
                window.location.href = data.url;
            } else {
                self.find(".Validform_checktip").text(data.msg);
                //刷新验证码
                $(".verifyimg img").click();
            }
        }
    });

    $(function(){
        //刷新验证码
        var verifyimg = $(".verifyimg img").attr("src");
        $(".verifyimg img").click(function(){
            if( verifyimg.indexOf('?')>0){
                $(".verifyimg img").attr("src", verifyimg+'&random='+Math.random());
            }else{
                $(".verifyimg img").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
            }
        });
    });
</script>
</body>
</html>
