@extends('layout')
@section('css')
    {!!Html::style('/assets/css/dropzone.css')!!}
    {!!Html::style('/assets/plugins/materialize-colorpicker/dist/css/materialize-colorpicker.min.css')!!}
    {!!Html::style('/assets/plugins/materialize-colorpicker/prism/themes/prism.css')!!}
@endsection
@section('content')
    <section class="">
        <div class="container">
					<div class="card-panel amber darken-4">
						<span class="white-text">Setarii generale pentru lot</span>
					</div>
					<div class="padding15 border lot">
						<div class="row">
							<div class="col l12 m12 s12">
								<span class="label">Imagini generale</span>
								<form action="http://amma/ro/product/413/add-image" class="dropzone product_gallery_dropzone dz-clickable" id="dropzone_form">
									<input type="file" multiple="" id="images" style="display: none">
									<div class="dz-default dz-message"><span>Drop files here to upload</span></div>
								</form>
								<div  id="preview_container" class="dropzone preview-img-box"></div>
							</div>
						</div>
						
						<div class="row">
							<form method="post" action="http://amma/ro/vendor/et-eum/product/413/create" class="form form-lot" enctype="multipart/form-data">
									<div class="col l6 m6 s12">
										<div class="input-field">
											<span class="label">NAME</span>
											<input type="text" required="" name="name" value="" placeholder="Product's name">
										</div>
									</div>
						
									<div class="col l6 m6 s12">
										<div class="input-field">
											<span class="label">{{ strtoupper('categories') }}</span>
											<select id="parent_categories" name="categories[]" required>
												<option value="">vvvvvvvvvvvv</option>
											</select>
										</div>
									</div><!-- Categories -->
						
									<div class="col l6 m6 s12">
										<div class="input-field date-published">
											<span class="label">{{ strtoupper('published date(from)') }}</span>
											<input type="date" class="datepicker-from" required name="published_date" value="" data-value="">
										</div>
									</div>
									<div class="col l6 m6 s12">
										<div class="input-field date-expiration">
											<span class="label">{{ strtoupper('expiration date(to)') }}</span>
											<input type="date" class="datepicker-to" required name="expiration_date" value="" data-value="">
										</div>
									</div><!-- Datetime -->
						
								    <div class="col l6 m6 s12">
								        <div class="input-field">
								            <span class="label">{{ strtoupper('Currency') }}</span>
								            <select name="currency" required>
								                <option value="MDL">MDL</option>
								                <option value="EUR">EUR</option>
								                <option value="USD">USD</option>
								            </select>
								        </div>
								    </div><!-- Currency -->
						
									<div class="col l3 m6 s12">
										<div class="input-field">
											<span class="label">Complete după nr. de unităţi</span>
											<input type="text" class="input-units" required="" name="units" value="" placeholder="0" >
										</div>
									</div>
						
									<div class="col l3 m6 s12">
										<div class="input-field">
											<span class="label">Complete dupa după sumă</span>
											<input type="text" class="input-amount" required="" name="amount" value="" placeholder="0">
										</div>
									</div><!-- Datetime -->
						
								                        <div class="col l12 m12 s12">
								                            <div class="input-field">
								                                <span class="label">DESCRIPTION</span>
								                                <textarea name="description"></textarea>
								                            </div>
								                        </div>
						
									<div class="col l12 m12 s12">
										<label>Specifications</label>
									</div>
						
									<div class="specification_suite_lot">
										<div class="specification_suite_item" data-suite-spec="1">
											<div class="col l6 m6 s12">
												<div class="input-field spec_name">
													<span class="label">NAME</span>
													<input type="text" name="spec[1][key]" value="">
												</div>
											</div>
											<div class="col l6 m6 s12">
											    <div class="input-field spec_value">
											        <span class="label">DESCRIPTION</span>
											        <input type="text" name="spec[1][value]" value="">
											    </div>
											</div>
										</div>
						
									</div>
									<div class="col l1 m1 s2 offset-s10 offset-l11 offset-m11 center-align">
										<a href="#add-spec" class="add_spec_btn" id="add_suite"><i class="material-icons center">library_add</i></a>
									</div>
						
							</form>
						</div>
					</div>
			<div class="card-panel amber darken-4">
				<span class="white-text">Adaugarea produselor in lot</span>
			</div>
			<form method="post" action="http://amma/ro/vendor/et-eum/product/413/create" class="form form-product" enctype="multipart/form-data">
				<div class="row add_product">
					<div class="inner_product border margin15">
						<div class="col l4 m6 s12">
							<div class="input-field">
								<p>PHOTO</p>
								<img class="materialboxed img-responsive" src="http://placehold.it/350x350">
							</div>
						</div>

						<div class="col l8 m6 s12">
							<div class="row">
								<div class="col l6 s12">
									<div class="input-field">
										<span class="label">NAME</span>
										<input type="text" required="" name="name" value="" placeholder="Product's name">
									</div>
								</div>

							    <div class="col l6 s12">
							        <div class="input-field">
							            <span class="label">{{ strtoupper('type') }}</span>
							            <select name="type" required>
							                <option value="new">New</option>
							                <option value="old">Old</option>
							            </select>
							        </div>
							    </div><!-- Type -->

								<div class="col l6 s12">
									<div class="input-field">
										<span class="label">Price</span>
										<input type="text" required="" name="price" value="" placeholder="0.00">
									</div>
								</div>

								<div class="col l6 s12">
			                        <div class="input-field">
			                            <span class="label">SALE</span>
			                            <input type="text" name="sale" placeholder="0%" value="0%">
			                        </div>
			                    </div>

								<div class="col l6 s12">
									<div class="input-field">
										<span class="label">Sold</span>
										<input type="text" required="" name="sold" value="" placeholder="0">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col l6 s12">
									<div class="row">
										<div class="wrap_spec_size overflow">

											<div class="spec_size">
												<div class="spec_size_item overflow">
													<div class="col l12 m12 s12">
														<div class="input-field">
															<span class="label">Size</span>
															<input type="text" required="" name="size" value="" placeholder="Size">
														</div>
													</div>
												</div>
											</div>

											<div class="col l2 m2 s2 offset-s10 offset-l10 offset-m10 center-align">
												<div class="input-field">
													<a href="#add-spec-size" class="add_spec_btn add_size"><i class="material-icons center">library_add</i></a>
												</div>
											</div>

										</div>
									</div>
								</div>

								<div class="col l6 s12">
									<div class="row">
										<div class="wrap_spec_color overflow">
											<div class="spec_color">
												<div class="spec_color_item overflow">
													<div class="col l12 m12 s12">
														<div class="input-field">
															<span class="label">COLORS</span>
															<div class="file-field input-colorpicker">
																<div class="btn"></div>
																<div class="file-path-wrapper">
																	<input type="text" name="color" class="" />
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col l2 m2 s2 offset-s10 offset-l10 offset-m10 center-align">
												<div class="input-field">
													<a href="#add-spec-color" class="add_spec_btn add_color"><i class="material-icons center">library_add</i></a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col l6 s12 offset-l6 right-align">
									<div class="input-field">
										<a href="#add-product" class="waves-effect waves-light btn"><i class="material-icons left">loop</i>Save</a>
									</div>
								</div>
							</div>
						</div>
	                </div>
				</div>

				<div class="row">
					<div class="margin15">
						<div class="col l4 m6 s12 offset-l8 offset-m6 right-align-600">
							<a href="#add-product" class="waves-effect waves-light btn" id="btn_add_product"><i class="material-icons left">library_add</i>Add product</a>
						</div>
					</div>
				</div>

			</form>
        </div>
    </section>
@endsection

@section('js')
    <script src="/assets/js/dropzone.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js" type="text/javascript"></script>
    <script src="/assets/plugins/materialize-colorpicker/prism/prism.js" type="text/javascript"></script>
    <script src="/assets/plugins/materialize-colorpicker/dist/js/materialize-colorpicker.min.js"></script>
    @include('html.partials.js')
@endsection