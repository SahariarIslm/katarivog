<script>
var fadeTime = 0;


//add cart
function addCart(productId,price){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  if($('#productQty').val() != null){
    var qty = $('#productQty').val();
  }else{
    var qty = 1;
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
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Product Added to Cart',
        showConfirmButton: false,
        timer: 2000
      })
      itemcount();
      minicartProduct();
    }
    
  });
};


  function UpdateShoppingCart(rowId){
    var inputQty = $('#inputQty_'+rowId).val();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        type: "POST",
        url: "{{ route('carts.update') }}",
        dataType: "JSON",
        data: {
            rowId:rowId,
            qty:inputQty,
        },
        success: function(response) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Cart Updated',
            showConfirmButton: false,
            timer: 1500
          })
          itemcount();
          minicartProduct();
          MainCartProduct();
        },
    });
  }


 //remove from mini cart
    function removeCartRow(rowId){
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
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Product Remove from Cart',
                showConfirmButton: false,
                timer: 1500
              })
              itemcount();
              minicartProduct();
              MainCartProduct()
            },
            error: function(response) {  
            }
        });
      };
     
      function minicartProduct(){
        $.ajax({
                type: "GET",
                url: '{{ route('cart.minicartProduct') }}',
                data:{},
                success:function(response){
                 $('#minicartProduct').html(response);
                }
            })
        }

      function MainCartProduct(){
        $.ajax({
          type: "GET",
          url: '{{ route('cart.MainCartProduct') }}',
          data:{},
          success:function(response){
           $('#cartProduct').html(response.cartProduct);
           $('#cartSummary').html(response.cartSummary);
           $('#checkOutBtn').html(response.checkOutBtn);
          }
        })
      }

    //subtotal for cart item
    function itemcount(){
      $.ajax({
        type: "GET",
        url: '{{ route('cart.itemcount') }}',
        data:{},
        success:function(response){
          var data = response.carts;
          $('.cart_count').text(response.carts);
          $('.mini_total').text(response.mini_total);
        }
      })
    }
</script>

