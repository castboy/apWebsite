<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>Document</title>
	<link rel="stylesheet" href="/style/css/main.css">
	<link href="/style/css/bootstrap.css" rel="stylesheet">
	<script src="/style/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript">

		$(function(){

			var phoneNo;
			var countdown;
			var getCodeAjax;
			var veriCodeAjax;

			Init();

			$("#phoneNo").keyup(function () {

				if (validPhoneNo($(this))) {

					ableElement($("#getCodeButton"));
				}else {

					disableElement($("#getCodeButton"));
				}
			});


			$("#veriCode").keyup(function () {

				if (inputNoNull($(this))) {

					ableElement($("#veriButton"));
				}else {

					disableElement($("#veriButton"));
				}
			});


			$("#getCodeButton").click(function(){

				getCode($(this));
			});

			$("#veriButton").click(function(){

				veriCode($(this));
			});

			//disableElements
			function Init () {

				inputFocus($("#phoneNo"));
				disableElement($("#veriButton"));
				disableElement($("#getCodeButton"));
				disableElement($("#veriCode"));
			}


			//get verification code
			function getCode (select) {

				getCodeButtonStyle(select);

				getCodeAjax();
			}
			//getCodeButton style after click
			function getCodeButtonStyle (select) {

				countdown = 60;
				countDown(select);
			}
			//ajax after click getCodeButton
			function getCodeAjax () {

				getCodeAjax = {type: "post",
								url: "./NochkCode.php",
								data: "phoneNo=" + phoneNo + "&checkCode=" + 0,
								cache:false,
								dataType: "html",
								callback: getCodeAjaxCall}
				ajax(getCodeAjax);
			}


			//veri veriCode
			function veriCode (select) {

				veriCodeButtonStyle(select);
				veriCodeAjax();
			}
			//veriCodeButton style after click
			function veriCodeButtonStyle (select) {

				setElementVal(select, "验证中...");
				disableElement(select);
			}
			//ajax after click veriCodeButton
			function veriCodeAjax () {

				veriCodeAjax = {type: "post",
								url: "./NochkCode.php",
								data: "phoneNo=" + phoneNo + "&checkCode=" + $("#veriCode").val(),
								cache:false,
								dataType: "html",
								callback: veriCodeAjaxCall}
				ajax(veriCodeAjax);
			}


			//Verify the correctness of the phone number
			function validPhoneNo (select) {

				phoneNo = select.val();

				if (phoneNo.length == 11) {

					return true;
				}

				return false;
			}

			//Ajax main program
			function ajax (param) {

				htmlObj = $.ajax({

					type: param["type"],
					url: param["url"],
					data: param["data"],
					cache: param["cache"],
					dataType: param["dataType"],
					success: function (data) {

						param["callback"](data);
					},
					error: function () {

						alert("出错了");
					}
				});

			}
			//callback if getCode ajax success
			function getCodeAjaxCall (res) {

				if (res == "1") {

					ableElement($("#veriCode"));
					inputFocus($("#veriCode"));
				}else {

				}
			}
			//callback if veriCode ajax success
			function veriCodeAjaxCall (res) {

				if (res == "1") {

					 window.location.href="./index.php";

				}else {

					ableElement($("#veriButton"));

					setElementVal($("#veriButton"), "重新验证");
				}
			}
			//input element focus
			function inputFocus (element) {
				element.focus();
			}
			//disable element
			function disableElement (element) {

				element.attr('disabled', true);
			}
			//able element
			function ableElement (element) {

				element.attr('disabled', false);
			}
			//check inputelement no null
			function inputNoNull (select) {

				if (select.val() == "") {

					return false;
				}

				return true;
			}
			//set element value
			function setElementVal (select, val) {

				select.val(val);
			}


			//count down
			function countDown(select) {

				if (countdown == 0) {

					ableElement(select);

					setElementVal(select, "重新发送");

				} else {

					disableElement(select);

					setElementVal(select, "重新发送(" + countdown + ")");

					countdown--;
				}

				setTimeout(function() {countDown(select)},1000)

			}

		});

	</script>
</head>
<body>
	<div class="verification">

		<input class="form-control top_30_main" style="width:200px;float: left;"
		 type="text" name="phoneNo" id="phoneNo" placeholder="请输入手机号" value="">

		<input class="btn btn-success top_30_main" style="width:100px;float: left;margin-left: 10px"
		 type="button" value="获取验证码" id="getCodeButton">

		<input class="form-control top_10_main" style="width:200px;float: left;"
		 type="text" name="veriCode" id="veriCode" placeholder="请输入验证码" value="">

		<input class="btn btn-info top_10_main" style="width:100px;float: left;margin-left: 10px"
		 type="button" value="验证" id="veriButton">
	</div>

</body>
</html>
