@extends('admin.layouts.app')

@section('title', '用户设置')

@section('sidebar')
  @php($sidebar = 'system')
@endsection

@section('content')
  <form class="form-horizontal" id="login-setting-form" method="post" novalidate="novalidate"
        data-save-url="{{ route('admin.settings.user.login') }}">

    <fieldset>
      <div class="form-group">
        <div class="col-md-3 control-label">
          <label>用户登录限制</label>
        </div>
        <div class="controls col-md-8 radios">
          <label><input type="radio" name="login_limit" value="1"> 开启</label>
          <label><input type="radio" name="login_limit" value="0" checked="checked"> 关闭</label>
          <p class="help-block">开启后同一帐号只能在一处（同一IP下使用一个浏览器）进行登录</p>
        </div>
      </div>
    </fieldset>

    <fieldset>
      <div class="form-group">
        <div class="col-md-3 control-label">
          <label>第三方登录</label>
        </div>
        <div class="controls col-md-8 radios">
          <label><input type="radio" name="enabled" value="1"> 开启</label>
          <label><input type="radio" name="enabled" value="0" checked="checked">关闭</label>
        </div>
      </div>
    </fieldset>


    <fieldset>
      <div class="form-group">
        <div class="col-md-3 control-label">
          <label>用户登录保护</label>
        </div>
        <div class="controls col-md-8 radios">
          <label><input type="radio" name="temporary_lock_enabled" value="1"> 开启</label>
          <label><input type="radio" name="temporary_lock_enabled" value="0" checked="checked">关闭</label>
          <p class="help-block">开启后，登录时用户连续多次输入错误密码时暂时封禁用户,此功能不影响admin手动永久封禁用户</p>
        </div>

        <div id="times_and_minutes" class="col-md-8 col-md-offset-3" style="display:none">
          <div class="row">
            <div class="col-md-4 lock-user-text-right">用户连续输入错误密码</div>
            <div class="controls col-md-2 form-group">
              <input type="text" id="temporary_lock_allowed_times" name="temporary_lock_allowed_times"
                     class="form-control" value="5" data-explain="">
              <div class="help-block" style="display:none;"></div>
            </div>
            <div class="col-md-3 lock-user-text-left">次，将暂时封禁用户</div>
          </div>
          <div class="row">
            <div class="col-md-4 lock-user-text-right">
              同一IP连续输入错误密码
            </div>
            <div class="controls col-md-2 form-group">
              <input type="text" id="temporary_lock_allowed_times" name="ip_temporary_lock_allowed_times"
                     class="form-control" value="20">
            </div>
            <div class="col-md-3 lock-user-text-left">
              次，将暂时封禁IP
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 lock-user-text-right">经过</div>
            <div class="controls col-md-2 form-group">
              <input type="text" id="temporary_lock_minutes" name="temporary_lock_minutes" class="form-control"
                     value="20" data-explain="">
              <div class="help-block" style="display:none;"></div>
            </div>
            <div class="col-md-3 lock-user-text-left">分钟后，解锁用户/IP</div>
          </div>
        </div>
      </div>
    </fieldset>
    <fieldset id="third_login" style="display:none">
      <fieldset data-role="oauth2-setting" data-type="weibo">
        <legend>微博登录接口</legend>
        <div class="form-group">
          <div class="col-md-3 control-label">
            <label>微博登录接口</label>
          </div>
          <div class="controls col-md-8 radios">
            <label><input type="radio" name="weibo_enabled" value="1"> 开启</label>
            <label><input type="radio" name="weibo_enabled" value="0" checked="checked">关闭</label>
            <div class="help-block">
              <a href="http://open.weibo.com/authentication/" target="_blank">申请微博登录接口</a>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-3 control-label">
            <label for="weibo_key">App Key</label>
          </div>
          <div class="controls col-md-8">
            <input type="text" id="weibo_key" name="weibo_key" class="form-control" value="">
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-3 control-label">
            <label for="weibo_secret">App Secret</label>
          </div>
          <div class="controls col-md-8">
            <input type="text" id="weibo_secret" name="weibo_secret" class="form-control" value="">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-3 control-label">
            <label for=""></label>
          </div>
          <div class="controls col-md-8 radios">
            <div class="help-block"><a href="#port">最后一步,请在底部输入登录接口验证代码&gt;</a></div>
          </div>
        </div>
      </fieldset>
      <fieldset data-role="oauth2-setting" data-type="qq">
        <legend>QQ登录接口</legend>
        <div class="form-group">
          <div class="col-md-3 control-label">
            <label>QQ登录接口</label>
          </div>
          <div class="controls col-md-8 radios">
            <label><input type="radio" name="qq_enabled" value="1"> 开启</label>
            <label><input type="radio" name="qq_enabled" value="0" checked="checked">关闭</label>
            <div class="help-block"><a href="http://connect.qq.com/" target="_blank">申请QQ登录接口</a>
              <a class="pll" href="javascript:;" id="help" data-toggle="popover" data-trigger="click"
                 data-placement="top" title="" data-html="true" data-content="1.你的QQ开放平台帐号认证度（个人信息完善）要达到75%，才能创建应用在网站设置第三方登录；<br> 2.需填写的回调地址为：<br><a><span class='text-danger'>XXX</span>/login/bind/qq/callback;<span class='text-danger'>XXX</span>/settings/bind/qq/callback</a><br>，<span class='text-danger'>XXX</span>为你的ES系统网址。例如，气球鱼学院的回调地址填写为：http://www.qiqiuyu.com/login/bind/qq/callback;http://www.qiqiuyu.com/settings<br>/bind/qq/callback；网址一定要有www哦；<br> 3.QQ的按钮，在开放平台你的个人信息中，找到ID和key，填写到edusoho后台，开启ID上方的QQ登录。<br>如果QQ接入审核失败，提示“登录按钮位置不对”，请检查ES后台【系统】【用户设置】【登录】，开启第三方登录以及开启QQ登录。
" data-original-title="接入帮助：">接入帮助</a>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-3 control-label">
            <label for="qq_key">App ID</label>
          </div>
          <div class="controls col-md-8">
            <input type="text" id="qq_key" name="qq_key" class="form-control" value="">
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-3 control-label">
            <label for="qq_secret">App Key</label>
          </div>
          <div class="controls col-md-8">
            <input type="text" id="qq_secret" name="qq_secret" class="form-control" value="">
          </div>
        </div>
      </fieldset>
      <fieldset data-role="oauth2-setting" data-type="weixinweb">
        <legend>微信网页登录接口</legend>
        <div class="form-group">
          <div class="col-md-3 control-label">
            <label>微信网页登录接口</label>
          </div>
          <div class="controls col-md-8 radios">
            <label><input type="radio" name="weixinweb_enabled" value="1"> 开启</label>
            <label><input type="radio" name="weixinweb_enabled" value="0" checked="checked"> 关闭</label>
            <div class="help-block">请先到 <a target="_blank" href="https://open.weixin.qq.com">微信开放平台</a> 申请<a
                target="_blank"
                href="https://open.weixin.qq.com/cgi-bin/frame?t=home/web_tmpl&amp;lang=zh_CN">网站应用开发</a>，开通后，网站PC端将支持微信扫码登录；
            </div>
            <div class="help-block">
              申请条件：在微信开放平台注册并且完成实名认证。
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-3 control-label">
            <label for="weixinweb_key">App ID</label>
          </div>
          <div class="controls col-md-8">
            <input type="text" id="weixinweb_key" name="weixinweb_key" class="form-control" value="">
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-3 control-label">
            <label for="weixinweb_secret">App Secret</label>
          </div>
          <div class="controls col-md-8">
            <input type="text" id="weixinweb_secret" name="weixinweb_secret" class="form-control" value="">
            <div class="help-block">APP ID和APP Secret来自<a target="_blank" href="https://open.weixin.qq.com">微信开放平台</a>创建的网站应用
            </div>
          </div>
        </div>
      </fieldset>
      <fieldset data-role="oauth2-setting" data-type="weixinmob">
        <legend>微信内分享登录接口</legend>
        <div class="form-group">
          <div class="col-md-3 control-label">
            <label>微信内分享登录接口</label>
          </div>
          <div class="controls col-md-8 radios">
            <label><input type="radio" name="weixinmob_enabled" value="1"> 开启</label>
            <label><input type="radio" name="weixinmob_enabled" value="0" checked="checked"> 关闭</label>
            <div class="help-block">开通后，支持使用微信号在手机端微信APP内快捷注册或登录网站。</div>
            <div class="help-block">
              如何开通：
              1.一个已认证的<a target="_blank" href="https://mp.weixin.qq.com">微信服务号</a>；
              2.一个已认证的<a target="_blank" href="https://open.weixin.qq.com">微信开放平台</a>帐号；
              3.服务号绑定到<a target="_blank" href="https://open.weixin.qq.com">微信开放平台</a>。
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-3 control-label">
            <label for="weixinmob_key">App ID</label>
          </div>
          <div class="controls col-md-8">
            <input type="text" id="weixinmob_key" name="weixinmob_key" class="form-control" value="">
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-3 control-label">
            <label for="weixinmob_secret">App Secret</label>
          </div>
          <div class="controls col-md-8">
            <input type="text" id="weixinmob_secret" name="weixinmob_secret" class="form-control" value="">
            <div class="help-block">APP ID和APP Secret来自
              <a target="_blank" href="https://mp.weixin.qq.com/">微信公众平台</a>服务号内，在左侧栏【开发】-【基本配置】-【开发者ID】中。
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-3 control-label">
            <label for="weixinmob_mp_secret">MP文件验证码</label>
          </div>
          <div class="controls col-md-8">
            <input type="text" id="weixinmob_mp_secret" name="weixinmob_mp_secret" class="form-control" value="">
            <p class="help-block">请填写微信提供的MP_verify文件中的内容</p>
          </div>
        </div>
      </fieldset>

      <fieldset>
        <legend id="port">登录接口验证代码</legend>
        <div class="form-group">
          <div class="col-md-3 control-label">
            <label for="verify_code">验证代码</label>
          </div>
          <div class="controls col-md-8">
            <textarea id="verify_code" name="verify_code" class="form-control" rows="5"
                      data-explain="在申请第三方登录接口时，会要求验证您的网站域名。请把相关验证代码粘到此处，然后提交保存。"></textarea>
            <div class="help-block">在申请第三方登录接口时，会要求验证您的网站域名。请把相关验证代码粘到此处，然后提交保存。</div>
          </div>
        </div>
      </fieldset>
    </fieldset>
    <div class="form-group">
      <div class="controls col-md-offset-3 col-md-8">
        <button type="submit" class="btn btn-primary">提交</button>
      </div>
    </div>
  </form>
@stop
