<script type="text/javascript">
  function PriceRange(){
    var priceRangeValue = $('#priceRange').val().split(",");
    $('#lowerPrice').val(priceRangeValue[0]);
    $('#higherPrice').val(priceRangeValue[1]);

    $('#minPrice').text(priceRangeValue[0]);
    $('#maxPrice').text(priceRangeValue[1]);

    GetCategoryProduct();
  }

  $('#sortBy').on('change', function(){
        var sortValue = $('#sortBy').val().split(",");
        $('#sortingBy').val(sortValue[0]);
        $('#sortingOrder').val(sortValue[1]);


      GetCategoryProduct(); 
    });

  $('#selectProductLimit').on('change', function(){
        var productLimit = $('#selectProductLimit').val();
        $('#productLimit').val(productLimit);
      GetCategoryProduct(); 
    });

  function GetCategoryProduct(page=null){
    var categoryId = $('.categoryId').val();
    var lowerPrice = $('#lowerPrice').val();
    var higherPrice = $('#higherPrice').val();
    var sortingBy = $('#sortingBy').val();
    var sortingOrder = $('#sortingOrder').val();
    var productLimit = $('#productLimit').val();

    if(categoryId && lowerPrice && higherPrice && productLimit){
      $('#loader').show();
    }
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }); 
   $.ajax({
        type: "POST",
        url: '{{ route('getCategoryProduct') }}',
        data : {
            categoryId:categoryId,
            lowerPrice:lowerPrice,
            higherPrice:higherPrice,
            sortingBy:sortingBy,
            sortingOrder:sortingOrder,
            productLimit:productLimit,
            page:page
        },
        success: function(response) {
          $('#gridProduct').html(response.gridProduct);
          $('#listProduct').html(response.listProduct);
          $('.categoryProductPaginate').html(response.categoryProductPaginate);

          $('.pagination').children('li').children('a').on('click', function(e){
            event.preventDefault();
            var page = $(this).text();
              GetCategoryProduct(page);
          });

            setTimeout(function(){
             $('#loader').hide();
            }, 300);
        }
    });
  }

</script>
