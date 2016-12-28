@extends('store.store')

@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="table-responsive cart_info">

				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class-"image">Item</td>
							<td class-"description"></td>
							<td class-"price">Price</td>
							<td class-"price">Quantity</td>
							<td class-"price">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@forelse($cart->all() as $k => $item)
							<tr>
								<td class="cart_product">
									<a href="{{ route('store.product', ['id' => $k]) }}">
										<?php
											$product = LaravelCommerce\Product::find($k);
										?>
										@if(count($product->images))
											@if(isset($image_id))
				                    			<img width="50" height="50" src="{{ url('uploads/'. $product->images->find($image_id)->id . '.' . $product->images->first()->extension) }}" alt="" />
					                    	@else
					                    		<img width="50" height="50" src="{{ url('uploads/'. $product->images->first()->id . '.' . $product->images->first()->extension) }}" alt="" />
					                    	@endif
					                    @else
					                    	<img width="50" height="50" src="{{ url('images/no-img.jpg') }}" alt="" />
					                    @endif
									</a>
								</td>
								<td class="cart_description">
									<h4><a href="{{ route('store.product', ['id' => $k]) }}">{{ $item['name'] }}</a></h4>
									<p>Code: {{ $k }}</p>
								</td>
								<td class="cart_price">
									N {{ $item['price'] }}
								</td>
								<td class="cart_quantity">

									<div class="input-group spinner">
									  <input data-id="{{ $k }}"  id="cart-item-{{ $k }}" class="cart-qtd form-control" type="text" readonly="readonly" value="{{ $item['qtd'] }}">
									  <div class="input-group-btn-vertical">
									    <button data-id="{{ $k }}" class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
									    <button data-id="{{ $k }}" class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
									  </div>
									</div>

								</td>
								<td class="cart_total">
									N <p id="cart-item-total{{ $k }}" class="cart_total_price" >{{ $item['price'] * $item['qtd'] }}</p>
								</td>
								<td class="cart_delete">
								 	<a href="{{ route('cart.destroy', ['id' => $k]) }}" class="cart_quantity_delete">Delete</a>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="5" class="">
									Item not found.
								</td>
							</tr>
						@endforelse
						<tr class="cart_menu">
								<td colspan="6" class="">
									<div class="pull-right">
										TOTAL: N<p id="cart-total" >{{ number_format($cart->getTotal(),2,',','.') }}</p>
										<a href="{{ route('checkout.place') }}" class="btn btn-success">Checkout</a>
									</div>
								</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section>
@stop

@section('pagejs')
	<script type="text/javascript">
		$('.cart-qtd').change(function() {
			var id = $(this).data('id');
			$.ajax({
				url: '{{ route('cart.update')}}',
				type: 'POST',
				data: {
					'id': id,
					'qtd': $(this).val(),
					'_token': '{{ csrf_token() }}'
				}
			}).success(function(data){
				var objJSON = $.parseJSON(data);
				$('#cart-item-total'+id).html(objJSON.itemtotal);
				$('#cart-total').html(objJSON.carttotal);
			}).fail(function(){
				console.log('falha');
			});
		});
	</script>
@stop

