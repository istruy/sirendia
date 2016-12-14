<html>
	<header>
    	<title>Тест</title>
        <style>
			img {
				position:absolute;
			}
			img#one {
				background:#AEF12B;
				left:100px;
				top:30px;
			}
			img#two {
				left:400px;
				top:600px;
			}
			img#three {
				left:550px;
				top:500px;
			}
		</style>
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	</header>
    <body>
    	<div style="position:relative;width:100%;height:1300px;background:#32E4D1">
        	<img id="one" width="1600" height="1199" src="../img/back.jpg">
            <img id="two" width="374" height="322" src="../img/body.png">
            <img id="three" width="271" height="301" src="../img/head.png">
        </div>
        <script>
			$(document).ready(function(){
				img_one = $('img#one')
				img_two = $('img#two');
				img_three = $('img#three');
				curX = 0;
				curY = 0;
				$(window).mousemove(function(e){
					//dance(img_one,30,30,e);
					img_one.css('left', 
						parseFloat(
									img_one.css('left').replace('px','')) - 
									parseFloat((curX)/30) + 
									parseFloat((e.pageX)/30)  + 'px'
						);
					img_one.css('top', 
						parseFloat(
									img_one.css('top').replace('px','')) - 
									parseFloat((curY)/30) + 
									parseFloat((e.pageY)/30)  + 'px'
						);
						
					img_two.css('left', 
						parseFloat(
									img_two.css('left').replace('px','')) - 
									parseFloat((curX)/50) + 
									parseFloat((e.pageX)/50)  + 'px'
						);
					img_two.css('top', 
						parseFloat(
									img_two.css('top').replace('px','')) - 
									parseFloat((curY)/50) + 
									parseFloat((e.pageY)/50)  + 'px'
						);
					
					img_three.css('left', 
						parseFloat(
									img_three.css('left').replace('px','')) - 
									parseFloat((curX)/140) + 
									parseFloat((e.pageX)/140)  + 'px'
						);
					img_three.css('top', 
						parseFloat(
									img_three.css('top').replace('px','')) - 
									parseFloat((curY)/140) + 
									parseFloat((e.pageY)/140)  + 'px'
						);
					
					curX = e.pageX;
					curY = e.pageY;
				});
			});
		</script>
    </body>
</html>