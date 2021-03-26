@extends('frontend.master') 

@section('content')
<div class="shopping-cart">
    @if(Cart::count() > 0)
        <div class="shopping-cart-table ">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="cart-romove item">Remove</th>
                            <th class="cart-description item">Image</th>
                            <th class="cart-product-name item" style="text-align: left;">Product Name</th>
                            <th class="cart-qty item">Quantity</th>
                            <th class="cart-sub-total item" width="200px">Subtotal</th>
                            <th class="cart-total last-item" width="200px">Grandtotal</th>
                        </tr>
                    </thead>
                    
                    <tbody id="cartProduct">
                      
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="shopping-cart-btn">
                                    <span class="">
                                        <a href="{{ url('/') }}" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping
                                        </a>
                                        {{-- <a href="#" class="btn btn-upper btn-primary pull-right outer-right-xs">Update shopping cart
                                        </a> --}}
                                    </span>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>

        <div class="col-md-6 col-sm-12 estimate-ship-tax">
            {{-- <table class="table">
                <thead>
                    <tr>
                        <th>
                            <span class="estimate-title">Estimate Shipping Charge</span>
                            <p>Enter your destination to get shipping charge.</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label class="info-title control-label">Country <span>*</span></label>
                                <select class="form-control unicase-form-control selectpicker">
                                    <option>--Select options--</option>
                                    <option>India</option>
                                    <option>SriLanka</option>
                                    <option>united kingdom</option>
                                    <option>saudi arabia</option>
                                    <option>united arab emirates</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="info-title control-label">State/Province <span>*</span></label>
                                <select class="form-control unicase-form-control selectpicker">
                                    <option>--Select options--</option>
                                    <option>TamilNadu</option>
                                    <option>Kerala</option>
                                    <option>Andhra Pradesh</option>
                                    <option>Karnataka</option>
                                    <option>Madhya Pradesh</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="info-title control-label">Zip/Postal Code</label>
                                <input type="text" class="form-control unicase-form-control text-input" placeholder="">
                            </div>
                            <div class="pull-right">
                                <button type="submit" class="btn-upper btn btn-primary">GET A QOUTE</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table> --}}
        </div>

        <div class="col-md-2 col-sm-12 estimate-ship-tax">
            {{-- <table class="table">
                <thead>
                    <tr>
                        <th>
                            <span class="estimate-title">Discount Code</span>
                            <p>Enter your coupon code if you have one..</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control unicase-form-control text-input" placeholder="You Coupon..">
                            </div>
                            <div class="clearfix pull-right">
                                <button type="submit" class="btn-upper btn btn-primary">APPLY COUPON</button>
                            </div>
                        </td>
                    </tr>
                </tbody><!-- /tbody -->
            </table> --}}
        </div>

        <div class="col-md-4 col-sm-12 cart-shopping-total">
            <table class="table">
                <thead>
                    <tr id="cartSummary">
                        
                    </tr>
                </thead><!-- /thead -->
                <tbody>
                    <tr>
                        <td>
                            <div class="cart-checkout-btn pull-right" id="checkOutBtn">
                                
                                {{-- <span class="">Checkout with multiples address!</span> --}}
                            </div>
                        </td>
                    </tr>
                </tbody><!-- /tbody -->
            </table><!-- /table -->
        </div>
    @else 
    <div style="margin-bottom: 20px">
        <h1 style="text-align: center;color: red">Shopping Cart is Empty</h1>
    </div>
        
    @endif         
</div><!-- /.shopping-cart -->

@endsection