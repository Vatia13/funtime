<?defined('_JEXEC') or die('Restricted access');?>
<div id="content">
    <div class="test-result" align="center">
        <h3>გთხოვთ დაელოდოთ  <span>5</span></h3>
    </div>
</div>
<script>
    $(document).ready(function(){
        var i = 5;
        setInterval(function(){
            i--;
            if(i < 0) i=0;
            $('.test-result h3 span').html(i);
        },1000)
    });
</script>