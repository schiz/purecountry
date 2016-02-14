$(function(){
    $(document).on('submit','.buy-block',function(e){
        quantity_val = $('input[name*=quantity]').attr('value'); // quantity - имя input-а для ввода количества товара, задается в настройках компонента
        id_val = $('input[name*=id]').attr('value'); // id - имя input-а c id товара
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: {quantity: quantity_val, id: id_val, actionADD2BASKET: 'В корзину', action: "BUY"},
            dataType: "html",
            success: function(out){
                console.log(out);
                $('.small_cart').load('/basket-ajax.php?basket-ajax=Y');
            }

        });
        e.preventDefault();        
    });       
});
function getBasketHTML(html)
{
    txt = html.split('<!--start--><div class="small_cart">');
    console.log(txt);
    txt = txt[2];
    txt = txt.split('</div><!--end-->');
    txt = txt[0];
    return txt;
}   

$(document).ready(function() {
    if($('#icon_login').length){
        $("#icon_login").show();
        /*$("#open-auth-form").fancybox(
            {
                ajax: {
                    type: "POST",
                    data: 'ajax=Y',
                    //href:$linkHref
                    href:'/auth/'
                }
            }
        );*/
        $("#icon_login").fancybox(
            {
                //type: 'ajax', 
                autoSize:false, 
                //width:350, 
                //height:394, 
                margin:0, 
                padding:0,          // hide border
                autoWidth:true, 
                autoHeight:true,
                maxWidth	: 500,
                maxHeight	: 800,
                fitToView	: true,
                //modal:true,         // hide button and arrow
                closeBtn: true,
                closeClick: false,
                closeEffect: 'none',
                helpers: {
                    title: null, // hide title
                    overlay : {closeClick: true}
                },
                tpl: {
                    //closeBtn: '<div title="Close" id="myCloseID" class="fancybox-item fancybox-close">[CLOSE]</div>'
                },
                afterLoad: function(curr, prev){
                    //console.log(curr);
                    //$('.fancybox-close').click($.fancybox.close(true));
                }
            }
        );
        $('.fancybox-close').click($.fancybox.close(true));
        //$('.fancybox-close').fancybox().remove();
        //$.fancybox.close
        $(document).on('submit','.popup-fon form',function(e){
            console.log($(this).serialize()+'&ajax=Y&rand='+Math.random());
            $.post($(this).attr('action'), $(this).serialize()+'&ajax=Y&rand='+Math.random()).done(function(data){
                $( ".fancybox-inner" ).html(data);            
            });
            e.preventDefault();        
        });
        $(document).on('click','.popup-fon a',function(e){
            $( ".fancybox-inner" ).load( $(this).attr('href'),'ajax=Y');
            e.preventDefault();
        }); /**/   
    }
});