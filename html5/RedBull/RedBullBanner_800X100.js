var RedBullBanner_800X100 = (function(canvasID,click)
{
	var width  = 800;
	var height = 100;
    var scope  = this;
    var canvas, context;
	var randomOffsets;
	
	var frame1 =
	{
		bg 	   :new Image(),
        phones :new Image(),
		text   :new Image(),
		frame  :0,
        context:null,
		visible:false,
		
        draw   :function()
        {
			var textSize = .45;
			var size     = .55;
			var posX     = -10;
			var posY     = -20;
		
			var bgX      = 0 + posX;
			var bgY      = 0 + posY;
			var bgWidth  = 510 * size;
			var bgHeight = 313 * size;
			
			var phoneX      = (134 * size) + posX;
			var phoneY      = (113 * size) + posY;
			var phoneWidth  = 276 * size;
			var phoneHeight = 560 * size;
			
			if(frame1.visible==true)
			{			
				context.drawImage(frame1.bg,bgX,bgY,bgWidth,bgHeight);
				
				context.drawImage(frame1.phones,0,(560/5) * Math.round(frame1.frame)+1,276,560/5,phoneX,phoneY,phoneWidth,(phoneHeight/5));
				
				context.drawImage(frame1.text,280,35,1114 * textSize,70 * textSize);
				
				frame1.frame+=.2;
				if(frame1.frame >= 4){frame1.frame = 0;}
			}
        },
		
		setVisible:function(isVisible)
		{
			frame1.visible = isVisible;
		},

        init   :function(context)
        {
            frame1.context    = context;
			frame1.bg.src     = '/img/uploads/files/banerebi/redbull_images/secretary.png';
			frame1.phones.src = '/img/uploads/files/banerebi/redbull_images/phones.png';
			frame1.text.src   = '/img/uploads/files/banerebi/redbull_images/text1.png';
        }
	};
	
	var frame2 =
	{
        can    :new Image(),
		text   :new Image(),
        context:null,
		canX   :1,
		textX  :1,
		textXOfsset:0,
		visible:false,
		
        draw   :function()
        {
			if(frame2.visible==true)
			{
				var textSize = .5;
				var size     = .7;
				
				context.drawImage(frame2.can,640*frame2.canX ,-140,188* size,500*size);
				
				context.drawImage(frame2.text,(60*frame2.textX) - (frame2.textXOfsset * 20),35,1114 * textSize,70 * textSize);
			}			
        },
		
		setVisible:function(isVisible)
		{
			frame2.canX        = -1;
			frame2.textX       = -20;
			frame2.textXOfsset =  0;
			frame2.visible     = isVisible;
			if(frame2.visible==true)
			{
				TweenLite.to(frame2,.7,{canX:1,textX:1,onComplete:function()
				{
					TweenLite.to(frame2,.5,{textXOfsset:1});
				}});
			}
		},

        init   :function(context)
        {
            frame2.context    = context;
			frame2.can.src    = '/img/uploads/files/banerebi/redbull_images/can.png';
			frame2.text.src   = '/img/uploads/files/banerebi/redbull_images/text2.png';
        }
	};
	
    var bg =
    {
        border :new Image(),
        corner :new Image(),
        context:null,

        draw   :function()
        {
			context.rect(0, 0,width, height);
			context.fillStyle = '#FFFFFF';
			context.fill();
			
			var random;
			var count = 0;
			for(var num = 0; num < 10 * 172; num+=172)
			{
				random = randomOffsets[count];
				
				context.drawImage(bg.border,num+random,		   0,172,8);
				context.drawImage(bg.border,num-random,height -8,172,8);
				context.rotate( 90*Math.PI/180);
				context.drawImage(bg.border,num+random,	      -8,172,8);
				context.drawImage(bg.border,num-random, -width-1,172,8);
				context.rotate(-90*Math.PI/180);
				count++;
			}
			
			context.drawImage(bg.corner,	  0,		0,8,8);
			context.rotate( 90*Math.PI/180);
			context.drawImage(bg.corner,	  1, -width-1,8,8);
			context.rotate( 90*Math.PI/180);
			context.drawImage(bg.corner, -width,-height-1,8,8);
			context.rotate( 90*Math.PI/180);
			context.drawImage(bg.corner,-height,       -1,8,8);
			context.rotate(-270*Math.PI/180);
        },

        init   :function(context)
        {
            bg.context    = context;
			bg.border.src = '/img/uploads/files/banerebi/redbull_images/border.png';
			bg.corner.src = '/img/uploads/files/banerebi/redbull_images/border_corner.png';
        }
    };
	
	function drawMask()
	{
		context.beginPath();
        context.rect(8, 8, width-15, height-15);
        context.fillStyle = 'blue';
        context.clip();
	};

    function draw()
    {
		context.clearRect(0, 0, canvas.width, canvas.height);
		
		bg.draw();
		drawMask();
		frame1.draw();
		frame2.draw();
    }

    function update()
    {
        setTimeout(function()
        {
            draw();
            requestAnimationFrame(update);
        }, 1000 / 30);
    }
	
	function changeFrameDeleyed()
	{
		TweenLite.delayedCall(3,
		function()
		{
			if(frame1.visible==true)
			{
				frame1.setVisible(false);
				frame2.setVisible(true);
				changeFrameDeleyed();
				return;
			}
			else
			{
				frame1.setVisible(true);
				frame2.setVisible(false);
				changeFrameDeleyed();
				return;
			}
		});
	}
	
    function init()
    {
        canvas  = document.getElementById(canvasID);
        context = canvas.getContext("2d");

        canvas.addEventListener("click",click);
        canvas.style.setProperty('cursor'  , 'pointer');
        canvas.style.setProperty('float'   ,    'left');

		randomOffsets = [];
		for(var num = 0; num < 10; num++)
		{
			randomOffsets[num] = Math.floor(Math.random() * 30);
		}
		
        bg.init(context);
		frame1.init(context);
		frame2.init(context);
		
		frame1.setVisible(true);
        update();
		changeFrameDeleyed();
    }
    init();
});