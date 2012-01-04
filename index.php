<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script>
Animation = {
    direction: 1,
    iterations: 0,
    intervalId: false,
    element: '',
    active: false,
    cycle: function(element){
        this.element = element;
        if (!this.active){
            this.intervalId = setInterval(function(){ Animation.changeFrame(Animation.element);},50);
            this.active = true;
        }
    },
    changeFrame: function(element){
        if (this.iterations > 30){
            this.stop();
            this.revertToStart(element);
            this.active = false;
            this.iterations = 0;
        }
        var el = $(element);
        currentFrame = el.children('.active-frame');
        if (this.direction === 1){
            nextFrame = currentFrame.next('.frame');
        }else{
            nextFrame = currentFrame.prev('.frame');
        }
        if (nextFrame.length == 0){
            this.direction = this.direction ? 0 : 1;
            if (this.direction === 1){
                nextFrame = currentFrame.next('.frame');
            }else{
                nextFrame = currentFrame.prev('.frame');
            }
        }
        currentFrame.hide().removeClass('active-frame');
        nextFrame.show().addClass('active-frame');
        this.iterations++;
    },
    stop: function(){
        clearInterval(this.intervalId);
    },
    revertToStart: function(element){
        $(element).children('.frame').removeClass('active-frame');
        $(element).children('.frame').hide();
        $(element).children('.frame:first').show().addClass('active-frame');
    }
};
$(function(){
    $('#owl').each(function(){
        
    });
    $('#owl .frame:first').addClass('active-frame');
    var owl;
    $('#owl').hover(function(){
        Animation.cycle('#owl');
    });
});
</script>

<style>
#owl {
    position:relative;
    width:330px;
    height:330px;
}
.owl {
    width:350px;
    height:350px;
    position:absolute;
    top:0;
    left:0;
    background-position:top left;
    background-repeat:no-repeat;
}
</style>
</head>
<body>
  
<div id="owl">
    <?php
    $files = scandir('frames');
    $i = 0;
    foreach($files as $file){
        if (substr($file,0,1) != '.'){
            $style = 'background-image:url(frames/' . $file . ');';
            if ($i > 0){
                $style .= ' display:none;';
            }
            echo '<div class="owl frame" style="' . $style . '"></div>';
            $i++;
        }
    }
    ?>
</div>
</body>
</html>
