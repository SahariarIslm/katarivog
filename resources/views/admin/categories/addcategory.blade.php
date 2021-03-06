@extends('admin.layouts.master')

@section('content')
@php
   use App\Category;
@endphp
    <form class="form-horizontal" action="{{ route('category.save') }}" method="POST" enctype="multipart/form-data" id="newProduct" name="newProduct">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-12 m-b-20 text-right">    
                <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> SAVE</button> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('parent') ? ' has-danger' : '' }}">
                    <label for="parent">Select Parent</label>
                    <select class="form-control chosen-select" name="parent">
                        <option value="">--- Select Parent---</option>
                        @foreach($categories as $category)
                            @php
                                $childCategory = Category::where('parent',$category->id)->get();
                                if(count($childCategory) > 0 || $category->parent == NULL){
                            @endphp
                                <option value="{{ $category->id }}">{{ $category->categoryName }}</option>
                            @php } @endphp
                        @endforeach
                    </select>
                    @if ($errors->has('parent'))
                        @foreach($errors->get('parent') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('categoryName') ? ' has-danger' : '' }}">
                    <label for="categoryName">Category name</label>
                    <input type="text" class="form-control form-control-danger" placeholder="Category name" name="categoryName" value="{{ old('categoryName') }}" required>
                    @if ($errors->has('categoryName'))
                        @foreach($errors->get('categoryName') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('headerImage') ? ' has-danger' : '' }}">
                    <label for="headerImage">Title Image</label>
                    <input type="file" class="form-control form-control-danger" name="headerImage" style="margin-bottom: 10px;">
                    <span style="color: red;">/* width : 300 px, Height: 300 px */</span> <br>
                    @if ($errors->has('headerImage'))
                        @foreach($errors->get('headerImage') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                 <div class="form-group {{ $errors->has('image') ? ' has-danger' : '' }}">
                    <label for="image">Category Image</label>
                    <input type="file" class="form-control form-control-danger" placeholder="Category Image" name="image" value="{{ old('image') }}">
                    <span style="color: red;">/* width : 325px, Height: 225px */</span>
                    @if ($errors->has('image'))
                        @foreach($errors->get('image') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('icon') ? ' has-danger' : '' }}">
                            <label for="icon">Category Icon</label>
                            <input type="text" class="form-control" name="icon" value="{{(old('icon'))}}" placeholder='fa fa-tv'>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="showInMainMenu">Show in Main Menu </label>
                        <div class="form-group {{ $errors->has('showInMainMenu') ? ' has-danger' : '' }}">
                            <div class="form-control">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="showInMainMenu" name="showInMainMenu" class="custom-control-input" value="1" required>
                                    <label class="custom-control-label" for="showInMainMenu">Yes</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="hideInMainMenu" name="showInMainMenu" class="custom-control-input" value="0" checked="">
                                    <label class="custom-control-label" for="hideInMainMenu">No</label>
                                </div>
                            </div> 
                        </div>
                    </div>

                    {{-- <div class="col-md-6">
                        <label for="showInHomepage">Visible in Home Category</label>
                        <div class="form-group {{ $errors->has('showInHomepage') ? ' has-danger' : '' }}">
                            <div class="form-control">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="showInHomepageHome" name="showInHomepage" class="custom-control-input" value="1" required>
                                    <label class="custom-control-label" for="showInHomepageHome">Yes</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="hideInHomePage" name="showInHomepage" class="custom-control-input" value="0" checked="">
                                    <label class="custom-control-label" for="hideInHomePage">No</label>
                                </div>
                            </div> 
                        </div>
                    </div> --}}
                </div>
            </div>

            <div class="col-md-6">
                <label for="showInSidebarCategory">Show in Sidebar Category </label>
                <div class="form-group {{ $errors->has('showInSidebarCategory') ? ' has-danger' : '' }}">
                    <div class="form-control">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="showInSidebarCategory" name="showInSidebarCategory" class="custom-control-input" value="1" required checked="">
                            <label class="custom-control-label" for="showInSidebarCategory">Yes</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="hideInSidebarCategory" name="showInSidebarCategory" class="custom-control-input" value="0">
                            <label class="custom-control-label" for="hideInSidebarCategory">No</label>
                        </div>
                    </div> 
                </div>
            </div>

            {{-- <div class="col-md-6">
                <label for="showInHomeCategoryProduct">Visible in Home Category Product Without Subcategory and Product</label>
                <div class="form-group {{ $errors->has('showInHomeCategoryProduct') ? ' has-danger' : '' }}">
                    <div class="form-control">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="showInHomeCategoryProduct" name="showInHomeCategoryProduct" class="custom-control-input" value="1" required>
                            <label class="custom-control-label" for="showInHomeCategoryProduct">Yes</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="hideInHomeCategoryProduct" name="showInHomeCategoryProduct" class="custom-control-input" value="0" checked="">
                            <label class="custom-control-label" for="hideInHomeCategoryProduct">No</label>
                        </div>
                    </div> 
                </div>
            </div> --}}
        </div>

        {{-- <div class="row">
            <div class="col-md-6">
               <label for="showInHomeCategoryProductWithSubcategory">Visible in Home Category Product With Subcategory</label>
                <div class="form-group {{ $errors->has('showInHomeCategoryProductWithSubcategory') ? ' has-danger' : '' }}">
                    <div class="form-control">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="showInHomeCategoryProductWithSubcategory" name="showInHomeCategoryProductWithSubcategory" class="custom-control-input" value="1" required>
                            <label class="custom-control-label" for="showInHomeCategoryProductWithSubcategory">Yes</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="hideInHomeCategoryProductWithSubcategory" name="showInHomeCategoryProductWithSubcategory" class="custom-control-input" value="0" checked="">
                            <label class="custom-control-label" for="hideInHomeCategoryProductWithSubcategory">No</label>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="col-md-6">
               <label for="showInHomeCategoryProductWithProduct">Visible in Home Category Product only With Product</label>
                <div class="form-group {{ $errors->has('showInHomeCategoryProductWithProduct') ? ' has-danger' : '' }}">
                    <div class="form-control">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="showInHomeCategoryProductWithProduct" name="showInHomeCategoryProductWithProduct" class="custom-control-input" value="1" required>
                            <label class="custom-control-label" for="showInHomeCategoryProductWithProduct">Yes</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="hideInHomeCategoryProductWithProduct" name="showInHomeCategoryProductWithProduct" class="custom-control-input" value="0" checked="">
                            <label class="custom-control-label" for="hideInHomeCategoryProductWithProduct">No</label>
                        </div>
                    </div> 
                </div>
            </div>
        </div> --}}

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('metaTitle') ? ' has-danger' : '' }}">
                            <label for="meta-title">Meta Title</label>
                            <input type="text" class="form-control form-control-danger" placeholder="Meta Title" name="metaTitle" value="{{ old('metaTitle') }}">
                            @if ($errors->has('metaTitle'))
                                @foreach($errors->get('metaTitle') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                         <div class="form-group {{ $errors->has('metaKeyword') ? ' has-danger' : '' }}">
                            <label for="meta-keyword">Meta keyword</label>
                            <input type="text" class="form-control form-control-danger" name="metaKeyword" value="{{ old('metaKeyword') }}" data-role="tagsinput">
                            @if ($errors->has('metaKeyword'))
                                @foreach($errors->get('metaKeyword') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

             <div class="col-md-6">
                <div class="form-group {{ $errors->has('description') ? ' has-danger' : '' }}">
                    <label for="meta-description">Meta description</label>
                    <textarea style="min-height: 182px;" class="form-control" name="metaDescription">{{ old('metaDescription') }}</textarea>
                    @if ($errors->has('metaDescription'))
                        @foreach($errors->get('metaDescription') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group {{ $errors->has('productSection') ? ' has-danger' : '' }}">
                            <label for="productSection">View in Product Section</label>
                            <select class="form-control chosen-select" data-placeholder="Select Product Section" multiple>
                                @php
                                    foreach ($product_section_list as $product_section) {
                                @endphp
                                    <option value="{{$product_section->id}}">
                                        {{$product_section->name}}
                                    </option>
                                @php } @endphp
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group {{ $errors->has('orderBy') ? ' has-danger' : '' }}">
                            <label for="orderBy">Order By</label>
                            <input type="number"  name="orderBy" class="form-control" value="{{ old('orderBy') }}" required>
                            @if ($errors->has('orderBy'))
                                @foreach($errors->get('orderBy') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <label>Publication status</label>
                <div class="form-group {{ $errors->has('categoryStatus') ? ' has-danger' : '' }}">
                    <div class="form-control">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="published" name="categoryStatus" class="custom-control-input" checked="" value="1" required>
                            <label class="custom-control-label" for="published">Published</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="unpublished" name="categoryStatus" class="custom-control-input" value="0">
                            <label class="custom-control-label" for="unpublished">Unpublished</label>
                        </div>
                    </div> 
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 m-b-20 text-right">    
                <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> SAVE</button> 
            </div>
        </div>
    </form>
@endsection