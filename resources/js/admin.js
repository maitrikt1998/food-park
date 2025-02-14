function scrollToBottom()
{
    let chatContent = $('.chat-content');
    chatContent.scrollTop(chatContent.prop("scrollHeight"));
}
window.Echo.private("chat."+loggedInUserId).listen(
    "ChatEvent",
    (e) => {
            if(e.senderId == $('#mychatbox').attr('data-inbox')){
                let html = `
                <div class="chat-item chat-left" style=""><img src="${e.avatar}" style="height:50px;width:50px;object-fit:cover;">
                    <div class="chat-details">
                        <div class="chat-text">${e.message}</div>
                    </div>
                </div>`;

                $('.chat-content').append(html);
                scrollToBottom();
            }

            //show message notification
            $('.fp_chat_user').each(function(){
                let senderId = $(this).data('user');
                if(e.senderId == senderId){
                    let html = `<i class="beep"></i> New message`;
                    $(this).find('.got_new_message').html(html);
                }
            })

            $('.message-envelope').addClass('beep');
    });
