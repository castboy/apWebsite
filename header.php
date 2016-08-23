<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>首页</title>
    <link href="/style/css/bootstrap.css" rel="stylesheet">
    <link href="/style/css/main.css" rel="stylesheet">
    <script src="/style/js/tempo.js"></script>
    <script src="/resource/json/movie.json"></script>
    <script src="/resource/json/app.json"></script>
    <script src="/style/js/jquery-1.11.3.min.js"></script>

    <script type="text/javascript">
      $(function () {
        veriAjax("post", "/Verification.php", false, "html", veriAjaxCall);

        function veriAjaxCall (res) {
          if ("1" === res) {
            showDiv($("#veriOk"));
          }else {
            showDiv($("#noVeri"));
          }
        }

        function veriAjax (type, url, cache, dataType, callback) {
          $.ajax({
            type: type,
            url: url,
            cache: cache,
            dataType: dataType,

            success: function (data) {
              callback(data);
            },

            error: function () {
              window.location.href = "#";
            }
          });

        }

        function showDiv (div) {
          div.css("display", "block");
        }
      });
    </script>
  </head>
  <body>
      <div class ="container-fluid">
        <div class='row' id="noVeri">
          <div class="col-xs-12 col-sm-12">
            <a id = "verification" href="/verifi.php">
              <button type="button" class="btn btn-success widthmax_main">点此认证上网</button>
            </a>
          </div>
        </div>
        <div class='row' id="veriOk">
          <div class="col-xs-12 col-sm-12">
            <a id = "verification" href="http://www.superwalle.com">
              <button type="button" class="btn btn-success widthmax_main">已经认证,点此畅游网络</button>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-6 col-sm-3 top_10_main">
            <a href="index.php"><div class="btn btn-primary widthmax_main">电影</div></a>
          </div>
          <div class="col-xs-6 col-sm-3 top_10_main">
            <a href="app.php"><div class="btn btn-info widthmax_main">应用</div></a>
            </div>
          <div class="col-xs-6 col-sm-3 top_10_main"><div class="btn btn-warning widthmax_main">游戏</div></div>
          <div class="col-xs-6 col-sm-3 top_10_main"><div class="btn btn-danger widthmax_main">推荐</div></div>
        </div>
<!--         <div class="row">
          <div class="col-xs-12"><div class="slide">轮播图在这里</div></div>
        </div> -->
