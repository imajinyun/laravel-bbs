@extends('admin.layouts.app')

@section('title', '设置管理')

@section('content')
  <div class="row">
    <div class="col-md-2">
      <div class="list-group left-navbar">
        <a href="#" class="list-group-item active" id="admin_menu_user" title="用户管理">
          站点设置
        </a>
        <a href="{{ route('admin.roles.index') }}" class="list-group-item" id="admin_menu_role" title="角色管理">
          角色设置
        </a>
      </div>
    </div>
    <div class="col-md-10">
      <div class="page-header clearfix">
        <h1 class="pull-left">
          站点设置
        </h1>
        <div class="pull-right"></div>
      </div>
      <ul class="nav nav-tabs mbm">
        <li class="active">
          <a title="基础信息" class="" href="#">
            基础信息
          </a>
        </li>
        <li>
          <a title="友情链接" class="" href="#">
            友情链接
          </a>
        </li>
      </ul>
      <form class="form-horizontal" id="site-form" method="post" data-save-url="">
        <fieldset>
          <div class="form-group">
            <div class="col-md-2 control-label">
              <label for="name">网站名称</label>
            </div>
            <div class="col-md-8 controls">
              <input type="text" id="name" name="name" class="form-control" value="">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-2 control-label">
              <label for="slogan">网站副标题</label>
            </div>
            <div class="col-md-8 controls">
              <input type="text" id="slogan" name="slogan" class="form-control" value="">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-2 control-label">
              <label for="url">网站域名</label>
            </div>
            <div class="col-md-8 controls">
              <input type="text" id="url" name="url" class="form-control" value="http://laravel-bbs.test">
              <p class="help-block">以『<b>http:// 或 https://</b>』开头</p>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-2 control-label">
              <label for="logo">网站LOGO</label>
            </div>
            <div class="col-md-8 controls">
              <div id="site-logo-container"></div>
              <a class="btn btn-default webuploader-container" id="site-logo-upload"
                 data-upload-token=""
                 data-goto-url="" data-widget-cid="widget-0">
                <div class="webuploader-pick">上传</div>
              </a>
              <button class="btn btn-default" id="site-logo-remove" type="button"
                      data-url="" style="display:none;">删除
              </button>
              <p class="help-block">请上传jpg, gif, png格式的图片。logo 图片尺寸建议不超过250×50px。图片大小建议不超过2MB。<br><a
                  href="" target="_blank">如何制作合适的图片？</a>网校 logo 设置后将显示顶部导航左侧，<a
                  href="" target="_blank">点击查看</a></p>
              <input type="hidden" name="logo" value="">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-2 control-label">
              <label for="favicon">浏览器图标</label>
            </div>
            <div class="col-md-8 controls">
              <div id="site-favicon-container"></div>
              <a class="btn btn-default webuploader-container" id="site-favicon-upload"
                 data-upload-token=""
                 data-goto-url="" data-widget-cid="widget-1">
                <div class="webuploader-pick">上传</div>
              </a>
              <button class="btn btn-default" id="site-favicon-remove" type="button"
                      data-url="" style="display:none;">删除
              </button>
              <p class="help-block">建议上传ico格式的图标文件，支持 ico, jpg, gif, png等格式, 建议尺寸 32×32px。<br><a
                  href="" target="_blank">如何制作合适的图片？</a></p>
              <input type="hidden" name="favicon" value="">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-2 control-label">
              <label for="seo_keywords">SEO关键词</label>
            </div>
            <div class="col-md-8 controls">
              <input type="text" id="seo_keywords" name="seo_keywords" class="form-control"
                     value="">
              <p class="help-block">设置多个关键词请用半角逗号","隔开。</p>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-2 control-label">
              <label for="seo_description">SEO描述信息</label>
            </div>
            <div class="col-md-8 controls">
              <input type="text" id="seo_description" name="seo_description" class="form-control"
                     value="">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-2 control-label">
              <label for="copyright">课程内容版权方</label>
            </div>
            <div class="col-md-8 controls">
              <input type="text" id="copyright" name="copyright" class="form-control" value="">
              <div class="help-block">您可以填写网站名称或公司名称。</div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-2 control-label">
              <label for="icp">ICP备案号</label>
            </div>
            <div class="col-md-8 controls">
              <input type="text" id="icp" name="icp" class="form-control" value="">
            </div>
          </div>
        </fieldset>
        <br>

        <fieldset>
          <legend>网站统计分析代码部署</legend>
          <div class="form-group">
            <div class="col-md-2 control-label">
              <label for="analytics">统计分析代码</label>
            </div>
            <div class="col-md-8 controls">
              <textarea id="analytics" name="analytics" class="form-control" rows="4"></textarea>
              <p class="help-block">统计代码是网站统计软件发布的一段代码，用以统计添加统计代码的网站的数据。</p>
              <p class="help-block">包括网站的访客来源，从哪个网页跳转到此网站，搜索什么关键词到网站，一共有多少人访问，每天多少人多少IP，平均访问时间是多少等等数据。</p>
              <p class="help-block">
                统计分析工具可以分析网校访问趋势，以及根据数据做推广调整，优化网校资源，建议使用
                <a href="http://tongji.baidu.com" target="_blank">百度统计</a>、
                <a href="http://ta.qq.com/" target="_blank">腾讯分析</a>或者
                <a target="_blank" href="http://www.umeng.com/">CNZZ。</a>
              </p>
            </div>
          </div>
        </fieldset>

        <fieldset style="display:none;">
          <legend>站点状态</legend>

          <div class="form-group">
            <div class="col-md-2 control-label">
              <label>站点状态</label>
            </div>
            <div class="col-md-8 controls radios">
              <label><input type="radio" name="status" value="open" checked="checked"> 开放</label><label><input
                  type="radio" name="status" value="closed"> 关闭</label>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-2 control-label">
              <label>网站关闭公告</label>
            </div>
            <div class="col-md-8 controls">
              <textarea id="closed_note" name="closed_note" class="form-control" rows="4"></textarea>
              <p class="help-block">网站处于关闭状态时，用户访问网站将显示此公告，支持HTML代码。</p>
            </div>
          </div>
        </fieldset>

        <div class="row form-group">
          <div class="controls col-md-offset-2 col-md-8">
            <button type="button" class="btn btn-primary" id="save-site">提交</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@stop
