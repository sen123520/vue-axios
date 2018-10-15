<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
$APPLICATION->AddHeadScript("/vdg/mobile/js/jquery-1.11.1.js", true);

?>
	<!--以下是跳转部分-->
<div  id="blackOverlay">
	<registbox  v-if="box" v-on:increment="hide"></registbox>
</div>
<script  type="text/template" id="componentbox">
	<transition name="modal">
		<div class="black-overlay">
			<div id="appBox" v-bind:style="{top:topNum}">
				<img src="<?=$templateFolder?>/images/yunhuajian.png" width="106" height="36" data-baiduimageplus-ignore="1" v-show="index ==1 || index ==2">
				<div class="sign-up" v-bind:style="{marginTop:margin+'px'}">
					<div class="holder" v-show="index == 0">
						<div class="with-line">用第三方帐号注册</div>
						<div class="buttons">
							<a href="javascript:void(0);" title="微博帐号登录" rel="nofollow" class="weibo"></a>
							<a href="javascript:void(0);" title="QQ帐号登录" rel="nofollow" class="qzone"></a>
							<a href="javascript:void(0);" title="微信帐号登录" rel="nofollow" class="wechat"></a>
							<a href="javascript:void(0);" title="豆瓣帐号登录" rel="nofollow" class="douban"></a>
						</div>
						<a class="brown-link" @click="toRegist">使用手机号/邮箱注册</a>
					</div>
					<div class="holder" v-show="index == 1">
						<div class="with-line">使用手机号/邮箱注册</div>
						<div style="margin-top: 15px;">
							<input type="text" name="email" id="count_num" v-model="name" placeholder="输入手机号或者邮箱" class="clear-input">
							<div id="drag">
								<div class="drag_text" onselectstart="return false;" unselectable="on">拖动滑块验证</div>
							</div>
							<div style="position:relative;">
								<div id="divMask_regist"></div>
								<a href="#" onclick="return false;" class="btn18 rbtn"  @click="toBox">
									<span class="text"> 注册</span>
								</a>
							</div>
						</div>
						
						<a class="brown-link return_third" @click="toThird">« 返回第三方帐号登录</a>
					</div>
					<div class="regist-main"  v-show="index == 3">
						<h3 class="with-line-big">欢迎! 请完善你的信息</h3>
						<div class="bx-auth">
								<div class="">
									<div class="regist-item" v-if="index == 3">
										<span class="login-label">账号</span>
										<span :data="name" class="tel-number" id="tel">{{name}}</span>
									</div>
									<div class="regist-item">
										<span class="login-label">手机验证码</span>
										
										<input type="text" placeholder="收到的验证码" name="CODE" id="code" maxlength="50" value="" class="code-text" v-model="code"/>
										<input type="button" value="重新发送" class="code-btn" id="code-btn" onclick="sendSms()"/>
										
									</div>	
									<div class="regist-item">
										<span class="login-label">姓名</span>
										<input type="text" placeholder="姓名" maxlength="50" value="" class="login-inp" id="USER_NAME"  v-model="username"/>
									</div>			
						
									<div class="regist-item">
										<span class="login-label">密码</span>
										<input type="password" placeholder="设定登录密码" name="USER_PASSWORD" maxlength="50" value="" class="login-inp" id="USER_PASSWORD"  v-model="password"/>
									</div>
									
									<div class="regist-item">
										<span class="login-label">确认密码</span>
										<input type="password" placeholder="请再输入一次登录密码" id="USER_PASSWORD_CHECK" name="USER_CONFIRM_PASSWORD" maxlength="50" value="" class="login-inp"  v-model="pass_check"/>
									</div>
							</div>
							<div class="log-popup-footer">
								<label class="checkbox">
									<input id="agree" type="checkbox" v-model="checkbox">我已认真阅读并接受
										<a href="javascript:void(0);" target="_blank" class="red-link">
											《免责声明》
										</a>
								</label>
							</div>
							<div class="log-popup-footer"  v-if="index == 3">
								<div id="divMask_R"></div>
								<span  class="disabled  rbtn-submit login-btn" id="login-btn" @click="submit_regist">提交</span>
							</div>
						</div>
					</div>
					<div class="regist-main"  v-show="index == 4">
						<h3 class="with-line-big">欢迎! 请完善你的信息</h3>
						<div class="bx-auth">
								<div class="">
									<div class="regist-item" v-if="index == 4">
										<span class="login-label">账号</span>
										<span :data="name" class="tel-number" id="tel">{{name}}</span>
									</div>
									<div class="regist-item">
										<span class="login-label">姓名</span>
										<input type="text" placeholder="姓名" maxlength="50" value="" class="login-inp" id="USER_NAME"  v-model="username"/>
									</div>			
						
									<div class="regist-item">
										<span class="login-label">密码</span>
										<input type="password" placeholder="设定登录密码" name="USER_PASSWORD" maxlength="50" value="" class="login-inp" id="USER_PASSWORD"  v-model="password"/>
									</div>
									
									<div class="regist-item">
										<span class="login-label">确认密码</span>
										<input type="password" placeholder="请再输入一次登录密码" id="USER_PASSWORD_CHECK" name="USER_CONFIRM_PASSWORD" maxlength="50" value="" class="login-inp"  v-model="pass_check"/>
									</div>
									<div id="drag_email">
										<span class="login-label"></span>
										<div class="drag_text" onselectstart="return false;" unselectable="on">拖动滑块验证</div>
									</div>
							</div>
							<div class="log-popup-footer">
								<label class="checkbox">
									<input id="agree" type="checkbox" v-model="checkbox">我已认真阅读并接受
										<a href="javascript:void(0);" target="_blank" class="red-link">
											《免责声明》
										</a>
								</label>
							</div>
							<div class="log-popup-footer"  v-if="index == 4">
								<div id="divMask_R"></div>
								<span  class="disabled  rbtn-submit login-btn" id="login-btn" @click="submit_regist">提交</span>
							</div>
						</div>
					</div>
				</div>
				<div class="close" @click="hide">
					<i></i>
				</div>
			</div>
		</div>
	</transition>
</script>
	<?
		$GLOBALS['APPLICATION']->addHeadScript($templateFolder."/jquery-1.11.1.js");
		$GLOBALS['APPLICATION']->addHeadScript($templateFolder."/layer/layer.js");
		$APPLICATION->SetAdditionalCSS($templateFolder."/layer/skin/default/layer.css", true);
?>
	<script src="<?=$templateFolder.'/drag.js'?>"></script>
	<script src="/vdg/vue/vue.js"></script>
	<script type="text/javascript">
		Vue.component('registbox',{
			template:'#componentbox',
			data:function(){
				return {
					index:0,
					margin:30,
					name:'',
					topNum:'50%',
					username:'',
					password:'',
					pass_check:'',
					code:'',
					email:'',
					phone:'',
					checkbox:false,
				}
			},
			methods:{
				hide:function(){
					this.$emit('increment')
				},
				toRegist:function(){
					this.index = 1
					this.margin = 20
					this.topNum = '50%'
				},
				toThird:function(){
					this.index = 0;
					this.margin = 30
					this.topNum = '50%'
				},
				toBox:function(){
					if(this.name != ''){
						//对电子邮件的验证
						var myreg_email = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
						var myreg_phone = /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
						if(myreg_phone.test(this.name))
						{
							this.index = 3
							this.phone = this.name
							sendSms()
						}else if(myreg_email.test(this.name)){
							this.index = 4
							this.email = this.name
						}else{
							return false
						}
						this.topNum = '300px'
					}else{
						alert("请输入手机号或者邮箱！");
					}
				},
				disable_btn:function(){
						BX.addClass(BX("divMask_R"),"divMask_R");
				},
				activation_btn:function(){
						BX.removeClass(BX("divMask_R"),"divMask_R");
				},
				submit_regist:function(){
						/**/
						/*验证手机号验证码是否正确*/
						/**/
						var vm = this
						this.disable_btn()

						if((this.code != mcode) && this.index == 3){
							layer.msg('验证码不正确！',{icon: 5});
							this.activation_btn()
							return false;
						}

						var mobileNum =  this.phone;
						var password = this.password;
						var pass_check = this.pass_check
						var name = this.username
						var email = this.email
						var checked = this.checkbox
						if(checked == false){
							layer.msg('请阅读并接受 《免责声明》',{icon: 5});
							this.activation_btn();
							return false;
						}
						if(!password){
							layer.msg('请输入密码',{icon: 5});
							this.activation_btn();
							return false;
						}
						if(!pass_check || (pass_check != password)){
							layer.msg('请输入重复密码',{icon: 5});
							this.activation_btn();
							return false;
						}
						console.log("账号"+mobileNum+"姓名"+name+"password"+password+"pass_check"+pass_check);
						$.ajax({
							type:"post",
							url:"/vdg/api/authorization/register",
							data:{
								mobile:mobileNum,
								email:email,
								password:password,
								name:name
							},
							dataType:'json',
							async:true,
							success: function(data,status) {
								console.log(data)
								if(data.result == 'success'){
									vm.activation_btn();
									alert('注册成功！');
									vm.hide()
								}else{
									vm.activation_btn();
									console.log(data.result);
									alert('注册失败，请重新注册！');
								}
							},
							error: function(status, data) {
								alert('注册失败，请重新注册！');
								vm.activation_btn();
								console.log(data);
							}
						});
				}			
			},
			beforeUpdate:function(){
				if(((this.code != '') && (this.password != '') && (this.pass_check != '') && (this.checkbox == true) && (this.index == 3)) ||
				((this.password != '') && (this.pass_check != '') && (this.checkbox == true) && (this.index == 4))
				){
					BX.removeClass(BX("login-btn"),"disabled");
				}else{
					BX.addClass(BX("login-btn"),"disabled");
				}
			},
			watch:{
				index:function(val, oldVal){
					if(val == 1 && oldVal == 0){
						$('#drag').drag();
						function stopss(){
						return false;
						}
						document.oncontextmenu=stopss;
					}
					if(val == 4){
						console.log("look here::::::::::"+$('#drag_email'))
						$('#drag_email').drag();
						function stopss(){
							return false;
						}
						document.oncontextmenu=stopss;
					}
				}
			}
		})
	var registBox = new Vue({
		el:'#blackOverlay',
		data:{
			box:false,
		},
		methods:{
			show:function(){
				this.box = true
			},
			hide:function(){
				this.box = false
			},
		}
	});
	var mcode='5';

	var countdown=0;
	var t;
	function timedCount(){
		if (countdown == 0) { 
			$('#code-btn').attr("disabled",false);  
			$('#code-btn').attr("class","code-btn");  
			$('#code-btn').val("点击获取"); 
			stopCount();
		} else { 
			$('#code-btn').attr("disabled",true);
            $('#code-btn').attr("class","code-btn");
			$('#code-btn').val("重新发送(" + countdown + ")"); 
			countdown--; 
		} 

		t=setTimeout("timedCount()",1000);
	}

	function stopCount(){
		clearTimeout(t);
	}
	var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/;

	function sendSms()
	{
		var tel = $('#count_num')[0].value;
		if(!myreg.test(tel)) 
		{ 
			layer.msg('请输入有效的手机号码！',{icon: 5}); 
			return false; 
		} 
		stopCount();
	    countdown=60; 
        timedCount();
        
        var Num=""; 
        for(var i=0;i<6;i++) 
        { 
        	Num+=Math.floor(Math.random()*10); 
        } 

		mcode=Num;

		console.log('num+++++++++++++++++++++:::::::::'+mcode);

        layer.msg('验证码发送手机成功！');

		var str='您正在注册VDG云平台，您的验证码是'+mcode+',验证码5分钟内有效,请勿泄露！';

		$.post("http://api.sms.vdspace.cn/sms/send/", 
		{
			Mobiles:tel,
			Content:str,
			Needstatus:'false',
			SendType:'10',
			dataType:'jsonp'
		},
		function(data) {

		});
	}
    // var btn = BX("login-btn");
//    function disable_btn(){
// 		BX.addClass(btn, "popup-window-button-disabled");
// 		BX.addClass(btn, "popup-window-button-wait");
// 		btn.style.cursor = 'auto';
// 		BX.addClass(BX("divMask_R"),"divMask_R");
//    }
//    function activation_btn(){
// 		BX.removeClass(btn, "popup-window-button-disabled");
// 		BX.removeClass(btn, "popup-window-button-wait");
// 		btn.style.cursor = 'cursor';
// 		BX.removeClass(BX("divMask_R"),"divMask_R");
//    }
	// function submit_regist(){
	// 	/**/
	// 	/*验证手机号验证码是否正确*/
	// 	/**/
	// 	disable_btn();
	// 	var code=BX('code').value; 

	// 	if(code != mcode){
	// 		layer.msg('验证码不正确！',{icon: 5});
	// 		activation_btn();
	// 		return false;
	// 	}

	// 	var username =  $('#tel')[0].innerHTML;
	// 	var password = BX('USER_PASSWORD').value;
	// 	var pass_check = BX('USER_PASSWORD_CHECK').value;
	// 	var name = BX('USER_NAME').value;
	// 	if(!password){
	// 		layer.msg('请输入密码',{icon: 5});
	// 		activation_btn();
	// 		return false;
	// 	}
	// 	if(!pass_check || (pass_check != password)){
	// 		layer.msg('请输入重复密码',{icon: 5});
	// 		activation_btn();
	// 		return false;
	// 	}
	// 	console.log("账号"+username+"姓名"+name+"password"+password+"pass_check"+pass_check);
	// 	$.ajax({
	// 		type:"post",
	// 		url:"/vdg/api/authorization/register",
	// 		data:{
	// 			username:username,
	// 			password:password,
	// 			name:name
	// 		},
	// 		dataType:'json',
	// 		async:true,
	// 		success: function(data,status) {
	// 			console.log(data)
	// 			if(data.result=='success'){
	// 				activation_btn();
	// 				alert('注册成功！');
	// 				window.location.href = '/vdg/auth/login.php';
	// 			}else{
	// 				activation_btn();
	// 				console.log(data.result);
	// 			}
	// 		},
	// 		error: function(status, data) {
	// 			activation_btn();
	// 			console.log(data);
	// 		}
	// 	});
	// }

</script>
</div>