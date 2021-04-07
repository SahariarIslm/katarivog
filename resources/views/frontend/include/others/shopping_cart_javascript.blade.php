<script>

  window.onload = function(e){ 
    CartView()
  }

var fadeTime = 0;

//add cart
function addCart(productId,price,element){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var qty = $('input[name=quantity]').val();
  console.log(qty);

  if(qty < 1){
    qty = 1
  }

  $.ajax({
    type: 'POST',
    url: '{{route('cart.addItem')}}',
    data : {
            productId:productId,
            price:price,
            qty:qty
          },
    success: function(response) {
      CartView()
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Product Added to Cart',
        showConfirmButton: false,
        timer: 2000
      })
    }
    
  });
};

 $(document).on('submit', '#shopping_cart_form', function (event) {
    event.preventDefault();
    let data = $(this).serialize();
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        dataType: 'JSON',
        cache: false,
        data: data,
        
        success: function (response) {
          CartView()
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Cart Updated',
            showConfirmButton: false,
            timer: 1500
          })
        },
        error: function (xhr) {
         
        }
    });
});


 //remove from mini cart
  function RemoveCartProduct(rowId){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

      $.ajax({
          type: "POST",
          url: "{{ route('cart.remove') }}",
          dataType: "JSON",
          data: {
              rowId:rowId,
          },
          success: function(response) {
            CartView()
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Product Remove from Cart',
              showConfirmButton: false,
              timer: 1500
            })
            
          },
          error: function(response) {  
          }
      });
    };

    function CartView(){
      $.ajax({
          type: "GET",
          url: '{{ route('cart.cart_view') }}',
          data:{},
          success:function(response){
           $('#mini_cart').html(response.mini_cart);
           $('#main_cart').html(response.main_cart);
          }
      })
    }
</script>

