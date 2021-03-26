<script type='text/javascript'>
    $(document).ready(function() {
        //javascript contact messege
            $(".contactFormButton").click(function(e){
                e.preventDefault();
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            }); 
            var contactName = $('.contactName').val(); 
            var contactPhone = $('.contactPhone').val(); 
            var contactEmail = $('.contactEmail').val(); 
            var contactTitle = $('.contactTitle').val(); 
            var contactMessage = $('.contactMessage').val(); 
           $.ajax({
                type: "POST",
                url : "{{ route('contact.save') }}",
                data : {
                    contactName:contactName,
                    contactPhone:contactPhone,
                    contactEmail:contactEmail,
                    contactTitle:contactTitle,
                    contactMessage:contactMessage,
                },
                success: function(response) {
                    swal.fire({
                        title: "<small class='text-success'>Success!</small>", 
                        type: "success",
                        text: "Messege Successfully Sent!",
                        timer: 4000
                    });
                    $("form[name='contactForm']").trigger("reset");
                },
                error: function(response) {
                    errorMessage = Object.entries(response.responseJSON.errors);
                    swal.fire({
                        title: "<p class='text-danger' style='line-height:30px'>Error !  "+errorMessage[0][1]+"</p>", 
                        type: "error",
                        timer: 4000
                    });
                }

            });    
        }); 

    });
                
</script>