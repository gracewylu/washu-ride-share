<?php
/*Filename: chat_box.php
 *Author: Sam Teeter
 *Content: creates a slide out chat box
 *NOTE: pages will need to include this code within a <div class='row'> in the
 *body section, and wrap all other content in a <div class='col s9 pull-s3' id='main'>
 */

 echo<<<HTML

 <!--The chat box-->

 <style type='text/css'>
    #chat-box{
        position:fixed;
        width:200px;
        top:0; bottom:0; right:0;
    }
    #main-panel.chat-showing{
        margin-right:200px;        
    }
</style>
<div id='chat-box' class="grey lighten-3">
    Some text
</div>

<!--Add slideout behavior-->
<script>
$( "#chat-button" ).click(function() {
    $(this).toggleClass("white-text");
    $("#main-panel").toggleClass("chat-showing");
    $("#chat-box").toggle("fold");
});

$( document ).ready(function() {
    $("body").wrapInner('<div id="main-panel" class="chat-showing" />');
    $("body").append(document.getElementById("chat-box"));
});

</script>

HTML;
 
?>