<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <!-- BootstrapのCSS読み込み -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="css/shop_contents.css" rel="stylesheet">
    <link href="css/sweetalert2.css" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/cupertino/jquery-ui.min.css" />
  <!-- jQuery読み込み -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

  <!-- BootstrapのJS読み込み -->
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script src="js/sweetalert2.js"></script>
  <!-- ratyのJS読み込み -->
  <script src="js/jquery.raty.js" type="text/javascript"></script>

  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  <script>
    //--------------変数宣言--------------
    var res　 = ""; //HTMLタグ変数
    var hot_shop_id = localStorage.getItem('data'); //店ID
    var hot_rep = ""; //ホットペッパーget用変数
    const hot_api_key　 = 　"10f59688fc27c9e0"; //ホットペッパーapi_key
    var hot_get = ""; //ホットペッパーデータ格納用
    var keyid = ""; //ぐるなびapi_key
    var g_rep = ""; //ぐるなびget用変数
    var g_get = ""; //ぐるなびデータ格納用
    var params = ""; //　ぐるなびget設定変数
    var hot_p = ""; //ホットペッパー住所
    var guru_p = ""; //ぐるなび住所
    var showResult = ""; //
    var cnt = 0; //カウント変数
    var cnt2 = 0; //カウント変数
    var flag = 0; //フラグ変数
    var i; //for文用
    var r; //フラグ変数
    //緯度経度
    var shoplat ;
    var shoplog ;

    //androidかiPhoneを調べる変数
    var isiPhone = 0;
    var isAndroid = 0;
    //機種判別用
  //  var ua = navigator.userAgent.toLowerCase();


    //----------------------------------

    $(function(){
      console.log("logintest");
      if (window.sessionStorage.getItem(['UserID']) == null) {
        $('.nav').append('<li class="login-Label"><a href="login.html">login</a></li>');
        console.log(window.sessionStorage.getItem(['UserID']));
        //$('.nav').filter(":last").after('<li><a href="login.html">login</a></li>');
        console.log("login");
      }else {
      //  $(".login-Label").remove();
        //$('.nav').filter(":last").after('<li><a href="login.html">logout</a></li>');
        $('.nav').append('<li class="login-Label"><a href=login.html>logout</a></li>');
        console.log(window.sessionStorage.getItem(['UserID']));
        console.log("logout");
        logout();
      }
});
/*
function logout(){
  $(".login-Label").remove();
  window.sessionStorage.setItem(['UserID'],[null]);
  $('.nav').append('<li class="login-Label"><a href="login.html">logout</a></li>');
  console.log(window.sessionStorage.getItem(['UserID']));
}
*/


alert("ルート検索時、位置情報を使用します");
    function initMap() {
      //ユーザーエージェントを調べる
      // Geolocation APIに対応しているかどうか


      if (navigator.geolocation) {
        //alert("この端末では位置情報が取得できます");
      // Geolocation APIに対応していない
      } else {
    //  alert("この端末では位置情報が取得できません");
      }
    }

    //*********************HTML生成***************************


    function add_res() {　 //HTML生成
      console.log("SEIKOU");

      shoplat = hot_get.results.shop[0].lat;
      shoplog = hot_get.results.shop[0].lng;

      console.log(hot_get.results.shop[0].lat);

      res +='<div id=' + hot_get.results.shop[0].id + ' class="hot_contents scon" >';
      res += '<h4 class="hot_name sname">店舗名</h4>' + hot_get.results.shop[0].name + '<br />';

      if ((navigator.userAgent.indexOf('iPhone') > 0 && navigator.userAgent.indexOf( 'iPad') == -1) || navigator.userAgent.indexOf('iPod') > 0 || navigator.userAgent.indexOf('Android') > 0) {
        res += '<img src=' + hot_get.results.shop[0].photo.mobile.l + ' class="img-rounded" alt="" width="" height="" border="0" /><br />';

      } else {
        res +='<img src=' + hot_get.results.shop[0].photo.pc.l + ' class="img-rounded" alt="" width="" height="" border="0" /><br />';

      }

      res += '<table class="table table-bordered"><tbody><tr>'
      res += '<th class="warning">住所</th><th>' + hot_get.results.shop[0].address + '</th>';
      res += '</tr><tr>'
      res += '<th class="warning">開店時間</th><th>' + hot_get.results.shop[0].open + '</th>';
      res += '</tr><tr>'
      res += '<th class="warning">閉店時間</th><th>' + hot_get.results.shop[0].close + '</th>';
      res += '</tr><tr>'
      res += '<th class="warning">ランチ</th><th>' + hot_get.results.shop[0].lunch + '</th>';
      res += '</tr><tr>'
      res += '<th class="warning">２３時以降</th><th>' + hot_get.results.shop[0].midnight + '</th>';
      res += '</tr><tr>'
      res += '<th class="warning">パーキング</th><th>' + hot_get.results.shop[0].parking + '</th>';
      res += '</tr><tr>'

      if ((navigator.userAgent.indexOf('iPhone') > 0 && navigator.userAgent.indexOf( 'iPad') == -1) || navigator.userAgent.indexOf('iPod') > 0 || navigator.userAgent.indexOf('Android') > 0) {

        res += '<th class="warning">URL</th> <th>' + hot_get.results.shop[0].urls.mobile+ '</th>';

      } else {

        res += '<th class="warning">URL</th><th>' + hot_get.results.shop[0].urls.pc+ '</th>';

      }
      res += '</tr><tr>'



    //  res += '<h4 class="hot_name">' + hot_get.results.shop[0].genre.name + ' / <img src="img/yen.png">' + hot_get.results.shop[0].budget.average + '</h4>';

    //  res += '<h4 class="hot_name">' + hot_get.results.shop[0].catch + '</h4>';

  //    res += '<h4>' + g_get.rest.url_mobile + '</h4>';

  //    res += '<h4>' + g_get.rest.coupon_url.mobile + '</h4>';

    //  res += '<img src=' + g_get.rest.image_url.shop_image1 + ' />';

    //  res += '<h4>' + g_get.rest.image_url.shop_image1 + '</h4>';

    //  res += '<h4>' + g_get.rest.pr.pr_short + '</h4>';




      /*
      res　 += 　'<div id=' + hot_get.results.shop[0].id + ' class="hot_contents scon" ><h4 class="hot_name sname">' +
        hot_get.results.shop[0].name + '</h4><br /><img src=' + hot_get.results.shop[0].photo.mobile.l + ' class="img-rounded" alt="" width="" height="" border="0" /><h4 class="hot_name">' +
        hot_get.results.shop[0].genre.name + ' / <img src="img/yen.png">' +
        hot_get.results.shop[0].budget.average + '</h4><h4 class="hot_name">' +
        hot_get.results.shop[0].catch + '</h4><h4>' + g_get.rest.url_mobile + '</h4><h4>' + g_get.rest.coupon_url.mobile + '</h4><img src=' + g_get.rest.image_url.shop_image1 + ' /><h4>' +
        g_get.rest.image_url.shop_image1 + '</h4><h4>' + g_get.rest.pr.pr_short + '</h4>';
*/

/*
      if ("[object Object]" != g_get.rest.budget) {
        res += '<h4>' + g_get.rest.budget + '</h4>';
      } else {
        res += '<h4>データなし</h4>'
      }
      */

      /*
      if ("[object Object]" != g_get.rest.party) {
        res += '<h4>' + g_get.rest.party + '</h4>';
      } else {
        res += '<h4>データなし</h4>'
      }
*/
      /*
      if ("[object Object]" != g_get.rest.lunch) {
        res += '<h4>' + g_get.rest.lunch + '</h4>';
      } else {
        res += '<h4>データなし</h4>'
      }
      */

      res += '</tr><tr>'
      if ("[object Object]" != g_get.rest.credit_card) {
        res += '<th class="warning">カード利用</th><th>' + g_get.rest.credit_card + '</th>';
      } else {
        res += '<th class="warning">カード利用</th><th>データなし</th>'
      }
      res += '</tr><tr>'
      if ("[object Object]"　 != 　g_get.rest.e_money) {
        res += '<th class="warning">電子マネー利用</th><th>' + g_get.rest.e_money + '</th>';
      } else {
        res += '<th class="warning">電子マネー利用</th><th>データなし</th>'
      }
      res += '</tr></tbody></table>'
      res += '</div>';
    }

    function add_res2() {
      console.log("成功４５６５４３２４３４");
      cnt = 0;

      shoplat = hot_get.results.shop[0].lat;
      shoplog = hot_get.results.shop[0].lng;


      res +='<div id=' + hot_get.results.shop[0].id + ' class="hot_contents scon" >';
      res += '店舗名：<h4 class="hot_name sname">' + hot_get.results.shop[0].name + '</h4><br />';

      if ((navigator.userAgent.indexOf('iPhone') > 0 && navigator.userAgent.indexOf( 'iPad') == -1) || navigator.userAgent.indexOf('iPod') > 0 || navigator.userAgent.indexOf('Android') > 0) {
        res += '<img src=' + hot_get.results.shop[0].photo.mobile.l + ' class="img-rounded" alt="" width="" height="" border="0" />';

      } else {
        res +='<img src=' + hot_get.results.shop[0].photo.pc.l + ' class="img-rounded" alt="" width="" height="" border="0" />';

      }


      res += '<table class="table table-bordered"><tbody><tr>'
      res += '<th class="warning">住所</th><th>' + hot_get.results.shop[0].address + '</th>';
      res += '</tr><tr>'
      res += '<th class="warning">開店時間</th><th>' + hot_get.results.shop[0].open + '</th>';
      res += '</tr><tr>'
      res += '<th class="warning">閉店時間</th><th>' + hot_get.results.shop[0].close + '</th>';
      res += '</tr><tr>'
      res += '<th class="warning">ランチ</th><th>' + hot_get.results.shop[0].lunch + '</th>';
      res += '</tr><tr>'
      res += '<th class="warning">２３時以降</th><th>' + hot_get.results.shop[0].midnight + '</th>';
      res += '</tr><tr>'
      res += '<th class="warning">パーキング</th><th>' + hot_get.results.shop[0].parking + '</th>';
      res += '</tr><tr>'


      if ((navigator.userAgent.indexOf('iPhone') > 0 && navigator.userAgent.indexOf( 'iPad') == -1) || navigator.userAgent.indexOf('iPod') > 0 || navigator.userAgent.indexOf('Android') > 0) {

        res += '<th class="warning">URL</th><th>' + hot_get.results.shop[0].urls.mobile+ '</th>';

      } else {

        res += '<th class="warning">URL</th><th>' + hot_get.results.shop[0].urls.pc+ '</th>';

      }




    //  res += '<h4 class="hot_name">' + hot_get.results.shop[0].genre.name + ' / <img src="img/yen.png">' + hot_get.results.shop[0].budget.average + '</h4>';

    //  res += '<h4 class="hot_name">' + hot_get.results.shop[0].catch + '</h4>';

  //    res += '<h4>' + g_get.rest.url_mobile + '</h4>';

  //    res += '<h4>' + g_get.rest.coupon_url.mobile + '</h4>';

    //  res += '<img src=' + g_get.rest.image_url.shop_image1 + ' />';

    //  res += '<h4>' + g_get.rest.image_url.shop_image1 + '</h4>';

    //  res += '<h4>' + g_get.rest.pr.pr_short + '</h4>';




      /*
      res　 += 　'<div id=' + hot_get.results.shop[0].id + ' class="hot_contents scon" ><h4 class="hot_name sname">' +
        hot_get.results.shop[0].name + '</h4><br /><img src=' + hot_get.results.shop[0].photo.mobile.l + ' class="img-rounded" alt="" width="" height="" border="0" /><h4 class="hot_name">' +
        hot_get.results.shop[0].genre.name + ' / <img src="img/yen.png">' +
        hot_get.results.shop[0].budget.average + '</h4><h4 class="hot_name">' +
        hot_get.results.shop[0].catch + '</h4><h4>' + g_get.rest.url_mobile + '</h4><h4>' + g_get.rest.coupon_url.mobile + '</h4><img src=' + g_get.rest.image_url.shop_image1 + ' /><h4>' +
        g_get.rest.image_url.shop_image1 + '</h4><h4>' + g_get.rest.pr.pr_short + '</h4>';
*/

/*
      if ("[object Object]" != g_get.rest.budget) {
        res += '<h4>' + g_get.rest.budget + '</h4>';
      } else {
        res += '<h4>データなし</h4>'
      }
      */

      /*
      if ("[object Object]" != g_get.rest.party) {
        res += '<h4>' + g_get.rest.party + '</h4>';
      } else {
        res += '<h4>データなし</h4>'
      }
*/
      /*
      if ("[object Object]" != g_get.rest.lunch) {
        res += '<h4>' + g_get.rest.lunch + '</h4>';
      } else {
        res += '<h4>データなし</h4>'
      }
      */

      res += '</tr><tr>'
      if ("[object Object]" != g_get.rest.credit_card) {
        res += '<th class="warning">カード利用</th><th>' + g_get.rest.credit_card + '</th>';
      } else {
        res += '<th class="warning">カード利用</th><th>データなし</th>'
      }
      if ("[object Object]"　 != 　g_get.rest.e_money) {
        res += '<th class="warning">電子マネー利用</th><th>' + g_get.rest.e_money + '</th>';
      } else {
        res += '<th class="warning">電子マネー利用</th><th>データなし</th>'
      }
      res += '</tr></tbody></table>'
      res += '</div>';
    }

    function add_res3() {

      shoplat = hot_get.results.shop[0].lat;
      shoplog = hot_get.results.shop[0].lng;

      res +='<div id=' + hot_get.results.shop[0].id + ' class="hot_contents scon" >';
      res += '店舗名：<h4 class="hot_name sname">' + hot_get.results.shop[0].name + '</h4><br />';

      if ((navigator.userAgent.indexOf('iPhone') > 0 && navigator.userAgent.indexOf( 'iPad') == -1) || navigator.userAgent.indexOf('iPod') > 0 || navigator.userAgent.indexOf('Android') > 0) {
        res += '<img src=' + hot_get.results.shop[0].photo.pc.l + ' class="img-rounded" alt="" width="" height="" border="0" />';

      } else {
        res +='<img src=' + hot_get.results.shop[0].photo.mobile.l + ' class="img-rounded" alt="" width="" height="" border="0" />';

      }

      res += '<table class="table table-bordered"><tbody><tr>'
      res += '<th class="warning">住所</th><th>' + hot_get.results.shop[0].address + '</th>';
      res += '</tr><tr>'
      res += '<th class="warning">開店時間</th><th>' + hot_get.results.shop[0].open + '</th>';
      res += '</tr><tr>'
      res += '<th class="warning">閉店時間</th><th>' + hot_get.results.shop[0].close + '</th>';
      res += '</tr><tr>'
      res += '<th class="warning">ランチ</th><th>' + hot_get.results.shop[0].lunch + '</th>';
      res += '</tr><tr>'
      res += '<th class="warning">２３時以降</th><th>' + hot_get.results.shop[0].midnight + '</th>';
      res += '</tr><tr>'
      res += '<th class="warning">パーキング</th><th>' + hot_get.results.shop[0].parking + '</th>';
      res += '</tr><tr>'
      if ((navigator.userAgent.indexOf('iPhone') > 0 && navigator.userAgent.indexOf( 'iPad') == -1) || navigator.userAgent.indexOf('iPod') > 0 || navigator.userAgent.indexOf('Android') > 0) {

        res += '<th class="warning">URL</th><th>' + hot_get.results.shop[0].urls.mobile+ '</th>';

      } else {

        res += '<th class="warning">URL</th><th>' + hot_get.results.shop[0].urls.pc+ '</th>';

      }
      res += '</tr></tbody></table>'
      res += '</div>';

    }

    //*********************************************************

    function a() {
      var test = 0;
      for (var f = 0; f < hot_p.length; f++) {
        if (guru_p.charAt(f) == hot_p.charAt(f)) {
          test = f;

        } else {
          break;
        }
      }
      if (flag <= test) {
        flag = test;
        r = i;
      }
    }

    function b() {
      add_res2();
    }

    if (hot_shop_id != null) { //店IDの空白判定
      hot();　 //ホットペッパーデータ取得関数

      function hot() {
        //        console.log("hot");
        hot_rep = 'https://webservice.recruit.co.jp/hotpepper/gourmet/v1/?key=' + hot_api_key + '&id=' + hot_shop_id + '&range=1&order=4&count=100&format=jsonp';
        $.ajax({
          type: 'GET',
          url: hot_rep,
          dataType: 'jsonp',
          success: function(data) {
            hot_get = data;
            console.log(data);
            gurunabi();　 //ぐるなびデータ取得関数
          }
        });
      }
    } else {
      console.log("失敗");
    }

    showResult = function(result) {
      g_get = result;

      if (result.total_hit_count == 1) { //1件だけヒットした場合
        console.log("match成功1");
        //  console.log(result.total_hit_count);

        if (g_get.rest.address.charAt(0) == "〒") {



          hot_p = hot_get.results.shop[0].address.replace(/\s+/g, "").replace(/[‐－―]/g, '-').replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
            return String.fromCharCode(s.charCodeAt(0) - 0xFEE0)
          });

          guru_p = g_get.rest.address.replace(/\s+/g, "").replace(/[‐－―]/g, '-').replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
            return String.fromCharCode(s.charCodeAt(0) - 0xFEE0)
          }).slice(9);



          add_res();
          $('.hot_contents').filter(":last").after(res); //HMLTを追加
          console.log(hot_get);
          console.log(g_get);
          console.log(hot_p);
          console.log(guru_p);

        } else {
          console.log("エラー");
        }

      } else if (result.total_hit_count > 1) { // 1件以上ヒットした場合
        console.log("match成功2");
        console.log(result.total_hit_count);
        //  console.log(hot_get.results.shop[0].address);
        g_get = result;
        console.log(result);

        hot_p = hot_get.results.shop[0].address.replace(/\s+/g, "").replace(/[‐－―]/g, '-').replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
          return String.fromCharCode(s.charCodeAt(0) - 0xFEE0)
        }); //0-9や大角など変換

        for (i = 0; i < result.total_hit_count; i++) {
          if (g_get.rest[i].address.charAt(0) == "〒") {

            guru_p = g_get.rest[i].address.replace(/\s+/g, "").replace(/[‐－―]/g, '-').replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
              return String.fromCharCode(s.charCodeAt(0) - 0xFEE0)
            }).slice(9);
            if (hot_p == guru_p) {
              console.log(hot_p);
              console.log(guru_p);
              break;
            } else {
              console.log("複数件失敗");
              a();
            }
          } else {

          }
        }
        b();
        $('.hot_contents').filter(":last").after(res);

      } else { //0件の場合
        console.log(cnt);
        if (cnt != 3) {
          gurunabi()
        } else {
          console.log("あうととととっと2");
          add_res3();
          $('.hot_contents').filter(":last").after(res);
        }
      }
      cnt += 1;
    }

    function gurunabi() { //検索条件を変えていく

      g_rep = 'https://api.gnavi.co.jp/RestSearchAPI/20150630/?callback=?';
      if (cnt == 0) {
        console.log("cnt=0");
        params = {
          keyid: '06ebf6157586406aeebdc819d9ff3998',
          format: 'json',
          name: hot_get.results.shop[0].name,
        };
      } else if (cnt == 1) {
        console.log("cnt=1");
        params = {
          keyid: '06ebf6157586406aeebdc819d9ff3998',
          format: 'json',
          address: hot_get.results.shop[0].address,
        };
      } else if (cnt == 2) {
        console.log("cnt=2");
        var str = hiraToKana(hot_get.results.shop[0].name_kana);
        //console.log(str);
        params = {
          keyid: '06ebf6157586406aeebdc819d9ff3998',
          format: 'json',
          name_kana: str,
        };
      } else {
        console.log("あうととととっと");
      }

      $.getJSON(g_rep, params, function(result) {
        showResult(result);
      });
    }

    function hiraToKana(str) {　 //ひらがなをカタカナへ変換
      return str.replace(/[\u3041-\u3096]/g, function(match) {
        var chr = match.charCodeAt(0) + 0x60;
        return String.fromCharCode(chr);
      });
    }




    $(function () {
      var lat;
      var log;


      function cmanGetOk(argPos){

        lat = argPos.coords.latitude;          // 緯度
        log = argPos.coords.longitude;         // 経度
        console.log(lat);
        console.log(log);

      }

        navigator.geolocation.getCurrentPosition(cmanGetOk);



      //ボタン押されたとき
      $('.js--apply').click(function (e) {




          if (isAndroid > 0){

            //google map起動(現在地から目的地までのルート)
            location.href = 'https://maps.google.com/maps?daddr='+shoplat+','+shoplog+'&saddr='+lat+','+log;
          } else{

            //アップルのマップを起動(現在地から目的地までのルート)
            location.href = 'https://maps.apple.com/maps?daddr=' + shoplat + ',' + shoplog+'&saddr='+lat+','+log;
          }




        });

    });


    $(function() {

      $("#Dialog_form").dialog({
        autoOpen: false,
        modal: true,
        title: "ダイアログのタイトル",
        open: function(event, ui) {
          $(".ui-dialog-titlebar-close").hide();
        },
        buttons: [ // ボタン名 : 処理 を設定
          {
            text: '送信',
            click: function() {
              $(this).dialog('close');
              /*
              ReviewFormの空白判定
              */

              var RData=[];


              if (!$('input[name="sei"]:checked').val()) {//性別
                 //sei = $('input[name="sei"]:checked').val();

                  RData[0] = 3;
              }else {

                RData[0] =$('input[name="sei"]:checked').val();
              }
              if ($('.age').val() != "") {//年齢
                 RData[1] = $('.age').val();
              }else {
                 RData[1] = 0;
              }
              if ($('.h_num').val()　!=　 "") {
                 RData[2] =　$('.h_num').val();
              }else {
                 RData[2] =　0;
              }
              if ($('.volume').val()!= "") {
                 RData[3] =　$('.volume').val();
              }else {
                 RData[3] =0;
              }
              if ($('.atm').val()!= "") {
                 RData[4] =$('.atm').val();
              }else {
                 RData[4] =0;
              }
              if ($('#rateit1').raty('score')!= "") {
                 RData[5] =$('#rateit1').raty('score');
              }else {
                 RData[5] =0;
              }
              RData[6] = hot_shop_id;

            //  var b = $('.sei').val();

            //  var score = $('#rateit1').raty('score');


              $.ajax({
                type: 'POST',
                url: 'Review.php',
                data: {
                  /*
                  sei: sei,
                  age: age,
                  h_num: h_num,
                  volume: volume,
                  atm: atm,
                  hot_shop_id: hot_shop_id,
                  score: score
                  */
                  /*
                  hot_shop_id: hot_shop_id,
                  atm: atm,
                  sei: sei,
                  score: score,
                  */
                  RData:RData,
                },
                success: function(data) {


                  console.log(data);

                }
              });
              alert("ボタン1をクリックしました");
            }
          },
          {
            text: '閉じる',
            class: 'btn-delete',
            click: function() {
              $(this).dialog('close');
            }
          },

        ]

      });

      $('#Review_button').click(function() {
        if (window.sessionStorage.getItem(['UserID']) == null) {
          console.log(window.sessionStorage.getItem(['UserID']));
          alert("ログインしてください");
        }else {
          $("#Dialog_form").dialog("open");
          console.log(window.sessionStorage.getItem(['UserID']));
        }

      });

    });




    $(function raty() {
      $.fn.raty.defaults.path = "img/images";

      $('#rateit1').raty({
        number: 5,
        score: 0,
      });


      /*
            $('#btn').click(function() {
                var score = $('#rateit1').raty('score');
                var a = "test";
                var b = $('.sei').val();

                console.log(score);
                $.ajax({
                    type: 'POST',
                    url: './test1.php',
                    data:{
                      word1:score,
                      word2:a
      		},
                  success: function (data) {
                    alert(data);
            }
          });
        });*/
    });

  </script>
</head>

<body　onLoad="swal('SeetAlert2!')">

  <nav class="navbar navbar-default">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#gnavi">
        <span class="sr-only">メニュー</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div id="gnavi" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="search.html">みーる</a></li>
      <!--  <li><a href="login.html">login</a></li> -->
      </ul>
    </div>
  </nav>


  <!-- <h1>お店の詳細ページ</h1> -->
  <div class="container">

    <div class="row">

      <div class="hot_contents col-xs-12">

      </div>
      <!-- ルート検索ボタン -->
      <input type="button" value="ルート" class="js--apply route_btn" />
      <!-- レビュー -->
      <button id="Review_button" type="button" name="button" class="route_btn">レビュー</button>

      <div id="Dialog_form">

        <form class="" method="post">
          <h4 style="display:inline">性別</h4>
          男性
          <input type="radio" class="sei" name="sei" value="1"> 女性
          <input type="radio" class="sei" name="sei" value="2">
          <br>
          <h4 style="display:inline">年代</h4>
          <select class="age" name="">
              <option value="">---</option>
              <option value="1">10代</option>
              <option value="2">20代</option>
              <option value="3">30代</option>
              <option value="4">40代</option>
              <option value="5">50代</option>
              <option value="6">60代~</option>
            </select><br>
          <h4 style="display:inline">人数</h4>
          <select class="h_num" name="">
              <option value="">---</option>
              <option value="1">1人</option>
              <option value="2">2~4人</option>
              <option value="3">5~10人</option>
              <option value="4">それ以上</option>
            </select>
          <br>
          <h4 style="display:inline">ボリューム感</h4>
          <select class="volume" name="">
              <option value="">---</option>
              <option value="1">がっつり</option>
              <option value="2">ふつう</option>
              <option value="3">少なめ</option>
            </select>
          <br>
          <h4 style="display:inline">お店の雰囲気</h4>
          <select class="atm" name="" required>
              <option value="">---</option>
              <option value="1">静か</option>
              <option value="2">にぎやか</option>
              <option value="3">一人で入りやすい</option>
              <option value="4">女性でも入りやすい</option>
            </select>
          <br>
          <h4 style="display:inline">評価</h4>
          <div style="display:inline" id="rateit1" required></div>
          <br>
        </form>
      </div>
    </div>
  </div>



  <!-- フッター(クレジット) -->
  <footer class="footer">
    Powered by
      <!-- ぐるなび -->
        <a href="https://api.gnavi.co.jp/api/scope/" target="_blank">
          <img src="https://api.gnavi.co.jp/api/img/credit/api_90_35.gif" width="90" height="35" border="0" alt="グルメ情報検索サイト　ぐるなび">
        </a>

      <!-- ホットペッパー -->
        <a href="https://webservice.recruit.co.jp/">
          <img src="https://webservice.recruit.co.jp/banner/hotpepper-m.gif" alt="ホットペッパー Webサービス" width="88" height="35" border="0" title="ホットペッパー Webサービス">
        </a>
  </footer>

</body>

</html>
