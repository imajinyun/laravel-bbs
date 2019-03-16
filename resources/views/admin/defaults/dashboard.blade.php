@extends('admin.layouts.app')

@section('content')
  <div class="alert alert-warning" role="alert">
    <span>欢迎使用 LaravelBBS 管理后台</span>
    <a href="#">系统相关设置</a>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default panel-150">
        <div class="panel-heading">
          <h3 class="panel-title">站长公告</h3>
        </div>
        <div class="panel-body">
          <ul class="admin-notice-list">
            <div class="empty">暂无公告</div>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-default panel-150">
        <div class="panel-heading">
          <h3 class="panel-title">状态栏</h3>
        </div>
        <div class="panel-body" id="system-status" data-url="#">
          <ul class="subfield-list four-subfield clearfix">
            <li>
              <div class="title">系统版本</div>
              <div class="info">
                <span class="glyphicon glyphicon-ok-sign text-success"></span>
                <span class="text-lg">v0.0.1</span>
              </div>
            </li>
            <li>
              <div class="title">Unknown</div>
              <div class="info">
                <span class="glyphicon glyphicon-ok-sign text-success"></span>
                <span class="text-lg">已更新</span>
              </div>
            </li>
            <li>
              <div class="title">Unknown</div>
              <div class="info">
                <span class="status-card-warp">
                  <span class="glyphicon glyphicon-exclamation-sign text-danger"></span>
                  <a class="text-lg link-underline text-danger" href="#"> 未开启</a>
                  <div class="status-card">
                    <ul class="open-serve-list">
                      <li>
                        <span class="key">1</span>
                        <a href="#" class="value value-danger"><i class="dot"></i>未开启</a>
                      </li>
                      <li>
                      <span class="key">云文档</span>
                                      <a href="#" class="value value-danger"><i class="dot"></i>未开启</a>
                                  </li>
                      <li>
                      <span class="key">云直播</span>
                                      <a href="#" class="value value-danger"><i
                                          class="dot"></i>未开启</a>
                                  </li>
                      <li>
                      <span class="key">云短信</span>
                                      <a href="#" class="value value-danger"><i
                                          class="dot"></i>未开启</a>
                                  </li>
                      <li>
                      <span class="key">云搜索</span>
                                      <a href="#" class="value value-danger"><i
                                          class="dot"></i>未开启</a>
                                  </li>
                      <li><span class="key">云问答</span><a href="#" class="value value-danger"><i class="dot"></i>未开启</a>
                      </li>
                    </ul>
                  </div>
                </span>
              </div>
            </li>
            <li>
              <div class="title">Unknown</div>
              <div class="info">
                <span class="glyphicon glyphicon-exclamation-sign text-danger"></span>
                <a href="#" class="text-lg link-underline text-danger"> 未开启</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <h3 class="panel-title">
        今日数据
        <span data-toggle="popover" class="glyphicon glyphicon-question-sign color-gray text-sm js-today-data-popover"
              data-original-title="" title=""></span>
        <div class="popover-content hidden">
          <div class="popover-item">
            <div class="title">登录用户</div>
            <div class="content">15分钟内活动的登录用户</div>
          </div>
          <div class="popover-item">
            <div class="title">在线总数</div>
            <div class="content">15分钟内活动用户数，包括登录用户及未登录用户</div>
          </div>
          <div class="popover-item">
            <div class="title">新增注册</div>
            <div class="content">平台新增用户数，包括自主注册、第三方注册及导入</div>
          </div>
          <div class="popover-item">
            <div class="title">新增话题</div>
            <div class="content">今日发布话题数</div>
          </div>
          <div class="popover-item">
            <div class="title">新增回复</div>
            <div class="content">今日发表回复数</div>
          </div>
          <div class="popover-item">
            <div class="title">未回复总数</div>
            <div class="content">到目前为止，未回答问题总数</div>
          </div>
        </div>
      </h3>
    </div>
    <div class="panel-body" id="site-overview-table" data-url="#">
      <ul class="subfield-list five-subfield clearfix">
        <li>
          <div class="title">登录用户</div>
          <span class="number"><a href="#" target="_blank">0</a></span>
          <p>在线总数: <a href="#" target="_blank">0</a></p>
        </li>
        <li>
          <div class="title">新增注册</div>
          <span class="number">1</span>
          <p>总数: 1</p>
        </li>
        <li>
          <div class="title">新增话题</div>
          <span class="number"> 0</span>
          <p>总人次: 0</p>
        </li>
        <li>
          <div class="title">新增回复</div>
          <span class="number"> 0</span>
          <p>总人次: 0</p>
        </li>
        <li>
          <div class="title">未回复话题</div>
          <span class="number">0</span>
          <p>总数: 0</p>
        </li>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-default panel-420 js-course-question-list">
        <div class="panel-heading">
          <a class="pull-right" href="#">更多</a>
          <h3 class="panel-title">最新问答</h3>
        </div>
        <div class="panel-body">
          <div class="empty">暂无最新未回复问答</div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-default panel-420">
        <div class="panel-heading">
          <a href="#" class="pull-right">更多</a>
          <h3 class="panel-title">最新评价</h3>
        </div>
        <div class="panel-body">
          <table class="table table-condensed table-noborder table-overflow">
            <thead>
            <tr>
              <th width="63%">评价内容</th>
              <th width="15%">评分</th>
              <th width="22%">操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>
                <div class="empty">暂无评价</div>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-default search-panel panel-420">
        <div class="panel-heading">
          <h3 class="panel-title">
            热门搜索
            <small>最近7天</small>
          </h3>
        </div>
        <div class="panel-body">
          <div class="empty">
            <a target="_blank" href="#">热门搜索关键词</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="cloud-ad" class="admin-cloud-ad modal fade text-center" aria-hidden="true" data-backdrop="static"
       tabindex="-1" role="dialog" data-url="#">
    <div class="modal-dialog">
      <a href="" target="_blank">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </a>
    </div>
  </div>
@stop
