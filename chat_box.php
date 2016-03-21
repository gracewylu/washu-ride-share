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
        height:500px;
    }
</style>
<div id='chat-box' class='col s3 push-s9 grey lighten-4'>
    Some text
</div>

<!--Add slideout behavior-->
<script>
$( "#chat-button" ).click(function() {
    $("div #main").toggleClass( "s9 pull-s3" );
    $("div #main").toggleClass( "s12" );
    $(this).toggleClass("white-text");
    $("#chat-box").toggle();
});

</script>

HTML;
 
?>