## Vue实战-----用户登录及注册

## 1.用户登录
    用户登录页面主要是获取当前页面用户输入的帐号跟密码，验证是否为空并通过`VUE axios(http请求插件)`,vue更新到2.0之后，作者就宣告不再对vue-resource更新，而是推荐的axios,前一段时间用了一下，现在说一下它的基本用法。
----------

配置文件选项,这里的config是对一些基本信息的配置，比如请求头，baseURL，请求方式等等，当然这里提供了一些比较方便配置项：

```js
//config
import Qs from 'qs'
{
  //请求的接口，在请求的时候，如axios.get(url,config);这里的url会覆盖掉config中的url
  url: '/user',

  // 请求方法同上
  method: 'get', // default
  // 基础url前缀
  baseURL: 'https://some-domain.com/api/',
　　
　　　　
  transformRequest: [function (data) {
    // 这里可以在发送请求之前对请求数据做处理，比如form-data格式化等，这里可以使用开头引入的Qs（这个模块在安装axios的时候就已经安装了，不需要另外安装）
　　data = Qs.stringify({});
    return data;
  }],

  transformResponse: [function (data) {
    // 这里提前处理返回的数据

    return data;
  }],

  // 请求头信息
  headers: {'X-Requested-With': 'XMLHttpRequest'},

  //parameter参数
  params: {
    ID: 12345
  },

  //post参数，使用axios.post(url,{},config);如果没有额外的也必须要用一个空对象，否则会报错
  data: {
    firstName: 'Fred'
  },

  //设置超时时间
  timeout: 1000,
  //返回数据类型
  responseType: 'json', // default

 
}
```
_______
当你配置完congig文件，我们就可以减少很多额外的处理代码也更优美，直接使用

  ``` js
        axios.post(url,{},config)
            .then(function(res){
                console.log(res);
            })
            .catch(function(err){
                console.log(err);
            })
        //axios请求返回的也是一个promise,跟踪错误只需要在最后加一个catch就可以了。
        //下面是关于同时发起多个请求时的处理
        axios.all([get1(), get2()])
        .then(axios.spread(function (res1, res2) {
            // 只有两个请求都完成才会成功，否则会被catch捕获
        }));
```
____
使用VUE的过渡效果，大家知道vue诞生的初衷就是为了做动画效果。我们使用自定义`name`为`modal`，实现弹框消失和出现时的缩放效果；
```css
.modal-container {
 	width: 520px;
 	margin: 0 auto;
 	background-color: #fff;
 	border-radius: 0px;
 	box-shadow: 0 2px 8px rgba(55, 55, 55, .6);
 	transition: all .3s ease;//设置最外层盒子的transition
 }
 .modal-enter {
 	opacity: 0;
 }
 
 .modal-leave-active {
 	opacity: 0;
 }
 
 .modal-enter .modal-container,
 .modal-leave-active .modal-container {
 	-webkit-transform: scale(1.1);
 	transform: scale(1.1);
 }
```

## 2.用户注册

用户注册流程仿照 [花瓣网](http://huaban.com/) 注册流程,分为多个小的页面，通过VUE`v-if`控制每个页面的动态加载，不得不提的是在滑块插件运用的过程中出现找不到元素的问题，主要是插件脚本和vue初始化加载顺序的问题，VUE实例还未渲染到页面，插件脚本就已经执行，当然会找不到元素，所以我一开是运用的是VUW声明周期钩子`mouted`，在页面实例加载完成后，加载插件脚本，VUE API中的原话是*el 被新创建的 vm.$el 替换，并挂载到实例上去之后调用该钩子。如果 root 实例挂载了一个文档内元素，当 mounted 被调用时 vm.$el 也在文档内。*；但是`moutrd`钩子每次页面刷新只能加载一次，所以后来我换成了`watch`动态监听事件，这样每次参数改变都会触发事件，调用验证滑块插件；
