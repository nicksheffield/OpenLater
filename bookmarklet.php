<?php 
	$js = "(function(){
		var iframe=document.createElement('iframe');
		iframe.setAttribute('src','http://ron.nicksheffield.com/create.php?title='+document.title+'&url='+window.location.href);
		iframe.style.display='none';
		document.body.appendChild(iframe);
		
		var m=document.createElement('div');
		m.setAttribute('id','iframe-message');
		m.innerHTML='You can read this later!';
		
		var b=document.createElement('div');
		b.setAttribute('id','iframe-back');
		b.appendChild(m);
		document.body.appendChild(b);
		
		b.addEventListener('click',remove);
		
		function remove(){
			this.style.display='none';
		}
		
		var iframe_style=document.createElement('style');
		iframe_style.innerHTML=
			'#iframe-message{
				font-size:42px;
				font-family:Georgia;
				font-weight:normal;
				color:#222;
				background:rgb(221,221,221);
				background:-moz-linear-gradient(top,rgba(221,221,221,1) 0%,rgba(204,204,204,1) 100%);
				background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,rgba(221,221,221,1)),color-stop(100%,rgba(204,204,204,1)));
				background:-webkit-linear-gradient(top,rgba(221,221,221,1) 0%,rgba(204,204,204,1) 100%);
				background:-o-linear-gradient(top,rgba(221,221,221,1) 0%,rgba(204,204,204,1) 100%);
				background:-ms-linear-gradient(top,rgba(221,221,221,1) 0%,rgba(204,204,204,1) 100%);
				filter:progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#dddddd\',endColorstr=\'#cccccc\',GradientType=0 );
				background:linear-gradient(top,rgba(221,221,221,1) 0%,rgba(204,204,204,1) 100%);
				box-shadow:0px 0px 10px #eee;
				border-radius:3px;
				display:inline-block;
				height:70px;
				width:500px;
				line-height:70px;
				margin:40px auto 0;
				cursor:default;
			}
			
			#iframe-back{
				width:100%;
				height:100%;
				position:fixed;
				top:0;
				left:0;
				z-index:101;
				background:rgba(0,0,0,0.7);
				text-align:center;
			}';
		
		document.body.appendChild(iframe_style);
		
	})();";
	
	$js = str_replace("\n",'',$js);
	$js = str_replace("\r",'',$js);
	$js = str_replace("\t",'',$js);
	
?>

<a class="save" href="javascript:<?php echo $js; ?>">OpenLater</a>