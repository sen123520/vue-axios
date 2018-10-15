<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->IncludeComponent("vdg:system.auth.regist",".default",null,null);
global $USER;
if (!$USER->IsAuthorized())
{
?>
<script>
    var app;
</script>
<td class="header-menus-box-top">
    <div class="header-btn-box">
        <button type="button" class="header-btn header-reg" onclick="registBox.show()">注册</button>
        <button id="login-btn" type="button" class="header-btn header-log"  >登录</button>
    </div>
</td>
<?
}else{
?>
<td class="header-menus-box-top" id="useraction" v-on:mouseenter='hoverin()' v-on:mouseleave="hoverout()">
    <div class="usermsg-box">
        <span class='user-photo'<?if($arResult["User"]["PERSONAL_PHOTO"]){?>style="background-image:url('<?=$arResult["User"]["PERSONAL_PHOTO"]?>')" <?}?> ></span>
        <span class='user-name'><?=$arResult["User"]["NAME"]?></span>
    </div>
    <ul class="header_more_user" v-if='isshow' v-show='isshow'>
        <li style='height:0!important;border:0'><div class="popup-window-angly popup-window-angly-top" style="left: 40px; margin-left: 0px;"></div></li>
        <li class="header_more_index txt_more"> <a :href="personmsg.href" v-text='personmsg.text'></a></li>
        <li class="header_more_index txt_more"> <a :href="workmsg.href" v-text='workmsg.text'></a></li>
        <li class="header_more_index txt_more"> <a :href="logout.href" @click.prevent='logoutthis' v-text='logout.text'></a></li>
    </ul>
</td>
<script>
var useraction = new Vue({
    el:'#useraction',
    data:{
        personmsg:{
                text:'个人中心',
                href:'/vdg/company/personal/user/'+<?=$USER->GetID()?>+'/?header=personcenter',
                isprevent:false,
        },
        workmsg:{
                text:'协同平台',
                href:'/vdg/workgroups/index.php?header=projectcenter&filter_subject_id=2',
                isprevent:false,
        },
        logout:{
                text:'退出登录',
                href:'',
                isprevent:true,
        },
        isshow:false,
    },
    methods: {
        logoutthis:function(){
            axios({
                method: 'post',
                url: '/vdg/api/authorization/logout',
            }).then(function(data){
                console.log(data);
                    if(data.data.result == 'success') {
                        window.location.href = '/vdg/cloud_expert/index.php?header=cexpert&MenuType=hide';
                    } else {
                        _this.errormsg = data.data.errormsg;
                        console.log(data);
                    }
            }).catch(function(error) {
                console.log(error);
                _this.errormsg = 'error';
            });
        },
        hoverin:function(){
            this.isshow = true;
        },
        hoverout:function(){
            this.isshow = false;
        },
    }
});  
</script>
<?}?>
<div id="modal">
    <modal_template :errormsg="errormsg" :message="message" :focususername="focususername" :focuspassword="focuspassword" v-if='showModalCheck' @close="showModalCheck = false" @open="showModalCheck = true" v-on:submit="onSubmit" v-on:focus="focus" v-on:blur="losefocus" ></modal_template>
</div>
<script type="text/template" id="modal_template">
    <transition name="modal">
        <div class="modal-mask" @click="$emit('close')">
            <div class="modal-wrapper">
                <div class="modal-container" @click.stop="$emit('open')">
                    <div class="modal-content">
                        <div class="close" @click.stop="$emit('close')"><i></i></div>
                        <img src="/local/components/vdg/auth.form/templates/.default/images/logo-106X36.png" width="106" height="36" />
                        <div id="login">
                            <div class="holder">
                                <div class="with-line">使用第三方帐号登录</div>
                                <div class="btns">
                                    <a @click.prevent class='weibo' title="微博帐号登录" rel="nofollow"></a>
                                    <a @click.prevent class='qzone' title="QQ帐号登录" rel="nofollow"></a>
                                    <a @click.prevent class='wechat' title="微信帐号登录" rel="nofollow"></a>
                                    <a @click.prevent class='douban' title="豆瓣帐号登录" rel="nofollow"></a>
                                    <a @click.prevent class='renren' title="人人帐号登录" rel="nofollow"></a>
                                </div>
                                <div class="with-line">使用手机号/邮箱登录</div>
                                <form class="mail-login" @submit.prevent="$emit('submit')">
                                    <p class="pass-form-item">
                                        <span class="pass-generalError" v-if="errormsg" v-text="errormsg"></span>
                                    </p>
                                    <p class="pass-form-item" :class="{'activeinput':focususername}">
                                        <input type="text" class="clear-input" placeholder="输入手机号或者邮箱" autocomplete="off"  v-model="message.username" name="username" v-on:blur="$emit('blur','username')" />
                                    </p>
                                    <p class="pass-form-item" :class="{'activeinput':focuspassword}">
                                        <input type="password" class="clear-input" placeholder="密码" autocomplete="off" v-model="message.password" name="password" v-on:blur="$emit('blur','password')"/>
                                    </p>
                                    <button type="submit" class="rbtn">登录</button>
                                </form>
                                <a class="reset-password red-link" target="_blank" href="" @click.prevent>忘记密码»</a>
                                <div class="switch-back">
                                     还没有云华建帐号？
                                    <a class="red-link" @click.stop="$emit('close')">点击右上角注册»</a> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</script>
<script>
app = new Vue({
    el: '#modal',
    data: {
        showModalCheck: false,
        message: {},
        focususername: false,
        focuspassword: false,
        errormsg: '',
    },

    methods: {
        open: function() {
            this.showModalCheck = true;
            this.errormsg = '';
        },
        close: function() {
            this.showModalCheck = false;
            this.errormsg = '';
        },
        onSubmit: function() {
            if(this.message.username == '') {
                this.focus('username');
                this.errormsg = '请您输入手机号';
                return false;
            } else if(this.message.password == '') {
                this.focus('password');
                this.errormsg = '请您输入密码';
                return false;
            } else {
                this.errormsg = '';
            }
            var _this = this;
            axios({
                method: 'post',
                url: '/vdg/api/authorization/login',
                params:{
                    username: _this.message.username,
                    password: _this.message.password
                }
            }).then(function(data){
                console.log(data);
                    if(data.data.result == 'success') {
                        window.location.href = '/vdg/cloud_expert/index.php?header=cexpert&MenuType=hide';
                    } else {
                        _this.errormsg = data.data.errormsg;
                        console.log(data);
                    }
            }).catch(function(error) {
                console.log(error);
                _this.errormsg = 'error';
            });
        },
        focus: function(type) {
            console.log(type);
            if(type && type == 'username') {
                this.focuspassword = false;
                this.focususername = true;
            } else if(type && type == 'password') {
                this.focususername = false;
                this.focuspassword = true;
            }
        },
        losefocus: function(type) {
            if(type && type == 'username') {
                this.focususername = false;
            } else if(type && type == 'password') {
                this.focuspassword = false;
            }
        }
    },
});
Vue.component(
    'modal_template',
    {
        props: {
            message: Object,
            focususername: Boolean,
            focuspassword:Boolean,
            errormsg: String,
        },
        template: '#modal_template'
    }
);

document.getElementById('login-btn').addEventListener('click', app.open);

</script>