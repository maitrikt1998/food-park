<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
    <div class="fp_dashboard_body fp__change_password">
        <div class="fp__message">
            <h3>Message</h3>
            <div class="fp__chat_area">
                <div class="fp__chat_body">

                </div>
                <form class="fp__single_chat_bottom chat_input">
                    @csrf
                    <label for="select_file"><i class="far fa-file-medical" aria-hidden="true"></i></label>
                    <input id="select_file" type="file" hidden="">
                    <input type="text" placeholder="Type a message..." name="message" class="fp_send_message">
                    <input type="hidden" name="receiver_id" value="1">
                    <button class="fp__massage_btn" type="submit"><i class="fas fa-paper-plane" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')

    <script>
        $(document).ready(function(){
            var userId = "{{ auth()->user()->id }}"

            function scrollToBottom()
            {
                let chatContent = $('.fp__chat_body');
                chatContent.scrollTop(chatContent.prop("scrollHeight"));
            }

            // fetch conversation
            $('.fp_chat_message').on('click',function(e){
                e.preventDefault();
                let senderId = 1;
                $('#receiver_id').val(senderId);
                $.ajax({
                    method: 'GET',
                    url: '{{ route("chat.get-conversation",":senderId") }}'.replace(":senderId",senderId),
                    beforeSend: function(){

                    },
                    success:  function(response){
                        $('.fp__chat_body').html('');
                        $.each(response, function( index, message ) {
                            let avatar = "{{ asset(':avatar') }}".replace(':avatar',message.sender.avatar);
                            let html = `
                                <div class="fp__chating ${message.sender_id == userId ? 'tf_chat_right':''} ">
                                    <div class="fp__chating_img">
                                        <img src="${avatar}" alt="person" class="img-fluid w-100">
                                    </div>
                                    <div class="fp__chating_text">
                                        <p>${message.message}</p>
                                    </div>
                                </div>`;

                            $('.fp__chat_body').append(html);
                        })
                        scrollToBottom()
                    },
                    error: function(xhr, status, error){

                    }
                })
            })

            // send message
            $('.chat_input').on('submit',function(e){
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    method:'POST',
                    url: "{{ route('chat.send-message') }}",
                    data: formData,
                    beforeSend: function(){
                      let message = $('.fp_send_message').val();
                      let html = `
                        <div class="fp__chating tf_chat_right">
                            <div class="fp__chating_img">
                                <img src="{{  auth()->user()->avatar }}" alt="person" class="img-fluid w-100" style="border-radius: 50%">
                            </div>
                            <div class="fp__chating_text">
                                <p>${message}</p>
                                <small>sending...</small>
                            </div>
                        </div>`;

                     $('.fp__chat_body').append(html);
                     $('.fp_send_message').val('');
                     scrollToBottom();
                    },
                    success: function(response){

                    },
                    error: function(xhr, status, error){
                        let errors = xhr.responseJSON.error;
                        $.each(errors, function(key, value){
                            toastr.error(value);
                        });
                    }
                })
            });
        });
    </script>
@endpush
