@extends('admin.layouts.app')

@section('title', '用户设置')

@section('sidebar')
  @php($sidebar = 'system')
@endsection

@section('content')
  <form class="form-horizontal" id="register-settings-form" method="post" novalidate="novalidate"
        data-save-url="{{ route('admin.settings.users.register') }}">

    <fieldset>
      <legend>注册设置</legend>
      <div class="form-group">
        <div class="col-md-3 control-label">
          <label>用户注册模式</label>
        </div>
        <div class="controls col-md-8">
          <div class="btn-group">
            <button type="button" class="btn btn-default model btn-primary" data-modle="email">邮箱注册</button>
            <button type="button" class="btn btn-default  model" data-modle="mobile">手机注册</button>
            <button type="button" class="btn btn-default  model" data-modle="email_or_mobile">邮箱或手机注册</button>
            <button type="button" class="btn btn-default  model" data-modle="closed">关闭</button>
          </div>
          <input type="hidden" value="email" name="register_mode">
          <div class="help-block">开启云短信后，才可使用“手机注册”或“邮箱或手机注册”</div>
        </div>
      </div>


      <div class="email-content">
        <div class="form-group">
          <div class="col-md-3 control-label">
            <label>邮箱验证登录</label>
          </div>
          <div class="controls col-md-8 radios">
            <label><input type="radio" name="email_enabled" value="opened" data-widget-cid="widget-2"
                          data-explain="开启后,邮箱未验证的用户将无法登录,请先保证邮件服务器已设置"> 开启</label>
            <label><input type="radio" name="email_enabled" value="closed" checked="checked"
                          data-explain="开启后,邮箱未验证的用户将无法登录,请先保证邮件服务器已设置">关闭</label>
            <button type="button" class="btn btn-primary btn-sm js-email-send-check hidden"
                    data-url="">检测邮箱服务
            </button>
            <div class="alert alert-info js-email-status hidden" data-url="/app.php/admin/setting/mailer" role="alert"
                 style="padding: 5px;margin-bottom: 0">正在检测.....
            </div>
            <div class="help-block">开启后,邮箱未验证的用户将无法登录,请先保证邮件服务器已设置</div>
          </div>
        </div>

        <input type="hidden" name="setting_time" value="">

        <div class="form-group">
          <div class="col-md-3 control-label">
            <label for="email_activation_title">新用户激活邮件标题</label>
          </div>
          <div class="controls col-md-8">
            <input type="text" id="email_activation_title" name="email_activation_title" class="form-control"
                   value="" data-explain="">
            <div class="help-block" style="display:none;"></div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-3 control-label">
            <label for="email_activation_body">新用户激活邮件内容</label>
          </div>
          <div class="controls col-md-8">
            <textarea id="email_activation_body" name="email_activation_body" class="form-control" rows="5"></textarea>
            <div class="help-block">
              <div>变量说明：</div>
              <ul>
                <li>为接收方用户昵称</li>
                <li>为网站名称</li>
                <li>为网站的地址</li>
                <li>为邮箱验证地址</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-3 control-label">
          <label>注册防护机制</label>
        </div>

        <div class="controls col-md-8 radios">
          <label>
            <input type="radio" name="register_protective" id="none" value="none" checked="checked"> 无
          </label>
          <label>
            <input type="radio" name="register_protective" id="low" value="low"> 低
          </label>
          <label>
            <input type="radio" name="register_protective" id="middle" value="middle"> 中
          </label>
          <label>
            <input type="radio" name="register_protective" id="high" value="high"> 高
          </label>
        </div>

        <button type="button" class="hiddenJsAction" style="display: none"></button>

        <div class="controls col-md-8 mtl col-md-offset-3 dync_visible not_closed_mode low_protective"
             style="display:none;">
          <div class="well">
            方案说明：
            <p class="mll mtm dync_visible low_protective_email low_protective_email_or_mobile" style="display: none;">
              邮箱注册时须要完成安全验证。</p>
            <p class="mll mtm dync_visible low_protective_mobile low_protective_email_or_mobile" style="display: none;">
              手机注册首次获取短信验证码时无安全验证。</p>
            <p class="mll mtm dync_visible low_protective_mobile low_protective_email_or_mobile" style="display: none;">
              60分钟内，同一IP地址第二次获取短信验证码时，须要完成安全验证。</p>
          </div>
        </div>

        <div class="controls col-md-8 mtl col-md-offset-3 dync_visible not_closed_mode middle_protective"
             style="display:none;">
          <div class="well">
            方案说明：
            <p class="mll mtm dync_visible middle_protective_email middle_protective_email_or_mobile"
               style="display: none;">邮箱注册时须要完成安全验证。</p>
            <p class="mll mtm dync_visible middle_protective_mobile middle_protective_email_or_mobile"
               style="display: none;">手机注册首次获取短信验证码时无安全验证。</p>
            <p class="mll mtm dync_visible middle_protective_mobile middle_protective_email_or_mobile"
               style="display: none;">60分钟内，同一IP地址第二次获取短信验证码时，须要完成安全验证。</p>
            <p class="mll mtm">同一IP24小时內只能注册30次。</p>
          </div>
        </div>

        <div class="controls col-md-8 mtl col-md-offset-3 dync_visible not_closed_mode high_protective"
             style="display:none;">
          <div class="well">
            方案说明：
            <p class="mll mtm dync_visible high_protective_email high_protective_email_or_mobile"
               style="display: none;">邮箱注册时须要完成安全验证。</p>
            <p class="mll mtm dync_visible high_protective_mobile high_protective_email_or_mobile"
               style="display: none;">手机注册获取短信验证码时须要完成安全验证。</p>
            <p class="mll mtm">同一IP24小时內只能注册10次。</p>
            <p class="mll mtm">同一IP1小时內只能注册1个帐号。</p>
          </div>
        </div>
      </div>

    </fieldset>

    <fieldset>
      <legend>欢迎信息设置</legend>
      <div class="form-group" style="display:none;">
        <div class="col-md-3 control-label">
          <label>发送欢迎信息</label>
        </div>
        <div class="controls col-md-8 checkboxs">
          <label><input type="checkbox" name="welcome_methods[]" value="message"> 站内私信</label><label><input
              type="checkbox" name="welcome_methods[]" value="email"> 电子邮件</label>
          <div class="help-block">新用户邮件激活开启时，电子邮件的发送欢迎信息方式无效。</div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-3 control-label">
          <label for="welcome_title">发送欢迎信息</label>
        </div>
        <div class="controls col-md-8 radios">
          <label><input type="radio" name="welcome_enabled" value="opened" checked="checked"> 开启</label><label><input
              type="radio" name="welcome_enabled" value="closed"> 关闭</label>
          <div class="help-block">欢迎信以站内私信的方式，发送给新用户。</div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-3 control-label">
          <label for="welcome_sender">欢迎信息发送方</label>
        </div>
        <div class="controls col-md-8">
          <input type="text" id="welcome_sender" name="welcome_sender" class="form-control" value="测试管理员">
          <div class="help-block">通常为这个网站的管理员，请输入用户用户名。</div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-3 control-label">
          <label for="welcome_title">欢迎信息标题</label>
        </div>
        <div class="controls col-md-8">
          <input type="text" id="welcome_title" name="welcome_title" class="form-control" value="">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-3 control-label">
          <label for="welcome_body">欢迎信息内容</label>
        </div>
        <div class="controls col-md-8">
          <textarea id="welcome_body" name="welcome_body" class="form-control" rows="5">
          </textarea>
          <div class="help-block">
            <div>注意： 私信长度不能超过1000个字符</div>
            <div>变量说明：</div>
            <ul>
              <li> 为接收方用户用户名</li>
              <li>sitename 为网站名称</li>
              <li>siteurl 为网站的地址</li>
            </ul>
          </div>
        </div>
      </div>
    </fieldset>

    <fieldset>
      <legend>服务条款设置</legend>
      <div class="form-group">
        <div class="col-md-3 control-label">
          <label for="user_terms">是否开启服务条款</label>
        </div>
        <div class="controls col-md-8 radios">
          <label><input type="radio" name="user_terms" value="opened"> 开启</label>
          <label><input type="radio" name="user_terms" value="closed" checked="checked">关闭</label>
          <div class="help-block">开启后用户注册时必须同意条款才能注册</div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-3 control-label">
          <label for="user_terms_body">条款内容</label>
        </div>
        <div class="controls col-md-8">
          <textarea class="form-control" id="user_terms_body" rows="16" name="user_terms_body"
                    data-image-upload-url=""
                    style="visibility: hidden; display: none;"></textarea>
        </div>
      </div>
    </fieldset>

    <div class="form-group">
      <div class="col-md-3 control-label"></div>
      <div class="controls col-md-8">
        <button type="submit" class="btn btn-primary">提交</button>
      </div>
    </div>
  </form>
@stop
