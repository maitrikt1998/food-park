function scrollToBottom()
{
    let chatContent = $('.fp__chat_body');
    chatContent.scrollTop(chatContent.prop("scrollHeight"));
}
window.Echo.private('chat.'+loggedInUserId).listen(
    'ChatEvent',
    (e) => {
        let html = `
        <div class="fp__chating ">
            <div class="fp__chating_img">
                <img src="${e.avatar}" alt="person" class="img-fluid w-100">
            </div>
            <div class="fp__chating_text">
                <p>${e.message}</p>
            </div>
        </div>`;
        $('.fp__chat_body').append(html);
        scrollToBottom();
        $('.unseen-message-count').text(1);
    }
);
