;(function($){
    $(document).on('click','.redonleft-login-submit',function(){
        var $widget=$(this).closest('.redonleft-login-widget');
        var username=$widget.find('input[name="username"]').val();
        var password=$widget.find('input[name="password"]').val();
        var remember=$widget.find('input[name="remember"]').is(':checked');
        var $msg=$widget.find('.redonleft-login-message');
        $msg.text('');
        
        $.post(AsyncLoginData.ajax_url,{action:'redonleft_login_login',username:username,password:password,remember:remember,nonce:AsyncLoginData.nonce},function(resp){
            if(resp.success){ 
                // $widget.replaceWith(resp.data.widget); 
                location.reload();
            }else{ 
                $msg.text(resp.data.message||'Login failed'); 
            }
        });
    });


    $(document).on('click','.redonleft-logout-button',function(){
        var $widget=$(this).closest('.redonleft-login-widget');
        var $msg=$widget.find('.redonleft-login-message');
        $msg.text('');
        $.post(AsyncLoginData.ajax_url,{action:'redonleft_login_logout',nonce:AsyncLoginData.nonce},function(resp){
            if(resp.success){ 
                // $widget.replaceWith(resp.data.widget); 
                location.reload();
            }else{ 
                $msg.text(resp.data.message||'Logout failed'); 
            }
        });
    });
})(jQuery);