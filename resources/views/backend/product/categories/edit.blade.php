@extends('backend.layouts.app')

@section('content')

@php
    CoreComponentRepository::instantiateShopRepository();
    CoreComponentRepository::initializeCache();
@endphp

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Category Information')}}</h5>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body p-0">
                <ul class="nav nav-tabs nav-fill border-light">
                    @foreach (\App\Models\Language::all() as $key => $language)
                    <li class="nav-item">
                        <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('categories.edit', ['id'=>$category->id, 'lang'=> $language->code] ) }}">
                            <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
                            <span>{{$language->name}}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
                <form class="p-4" action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PATCH">
    	            <input type="hidden" name="lang" value="{{ $lang }}">
                	@csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Name')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
                        <div class="col-md-9">
                            <input type="text" name="name" value="{{ $category->getTranslation('name', $lang) }}" class="form-control" id="name" placeholder="{{translate('Name')}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Parent Category')}}</label>
                        <div class="col-md-9">
                            <select class="select2 form-control aiz-selectpicker" name="parent_id" data-toggle="select2" data-placeholder="Choose ..."data-live-search="true" data-selected="{{ $category->parent_id }}">
                                <option value="0">{{ translate('No Parent') }}</option>
                                @foreach ($categories as $acategory)
                                    <option value="{{ $acategory->id }}">{{ $acategory->getTranslation('name') }}</option>
                                    @foreach ($acategory->childrenCategories as $childCategory)
                                        @include('categories.child_category', ['child_category' => $childCategory])
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            {{translate('Ordering Number')}}
                        </label>
                        <div class="col-md-9">
                            <input type="number" name="order_level" value="{{ $category->order_level }}" class="form-control" id="order_level" placeholder="{{translate('Order Level')}}">
                            <small>{{translate('Higher number has high priority')}}</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Type')}}</label>
                        <div class="col-md-9">
                            <select name="digital" required class="form-control aiz-selectpicker mb-2 mb-md-0">
                                <option value="0" @if ($category->digital == '0') selected @endif>{{translate('Physical')}}</option>
                                <option value="1" @if ($category->digital == '1') selected @endif>{{translate('Digital')}}</option>
                            </select>
                        </div>
                    </div>
    	            <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Banner')}} <small>({{ translate('200x200') }})</small></label>
                        <div class="col-md-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="banner" class="selected-files" value="{{ $category->banner }}">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Icon')}} <small>({{ translate('32x32') }})</small></label>
                        <div class="col-md-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="icon" class="selected-files" value="{{ $category->icon }}">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Full Width Banner')}} <small>({{ translate('1200x300') }})</small></label>
                        <div class="col-md-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="full_width_banner" class="selected-files" value="{{ $category->full_width_banner }}">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Title')}}</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="title" value="{{ $category->title }}" placeholder="{{translate('Title')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Description')}}</label>
                        <div class="col-md-9">
                            <textarea name="description" rows="5" class="aiz-text-editor form-control">{{ $category->description }}</textarea>
                        </div>
                    </div>                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="mobile">{{translate('question & answer')}}</label>
                        <div class="col-sm-9">
                            <div class="faq-block">
                                @php 
                                    $faq = json_decode($category->faq, true);
                                @endphp   
                                @if(empty($faq))
                                <div class="faq-fields mb-2" id="id_0" data-id="0">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control mb-1" name="question[]" value="" placeholder="Question">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control mb-1" name="answer[]" placeholder="Answer">
                                        </div>                                        
                                        <div class="col-md-2 change">
                                            <div class="btn-faq-f mb-1">
                                                <div class="btn btn-block btn-success" onclick="addFaq(this);"><i class="las la-plus"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                    @php $x = 0; @endphp
                                    @foreach($faq as $question => $answer)
     
                                    <div class="faq-fields mb-2" id="id_{{$x}}" data-id="{{$x}}">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <input type="text" class="form-control mb-1" name="question[]" value="{{$question}}" placeholder="question">
                                            </div>
                                            <div class="col-md-5">
                                                <textarea name="answer[]" placeholder="answer" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$answer}}</textarea>

                                            </div>  
                                            
                                            <div class="col-md-2 change">
                                                <div class="btn-faq-f mb-1">
                                                    @if($x == 0)
                                                        <div class="btn-faq-f mb-1"><div class="btn btn-block btn-danger" onclick="removeFaq(this);"><i class="las la-minus"></i></div></div>
                                                    @else
                                                        <div class="btn btn-block btn-success" onclick="addFaq(this);"><i class="las la-plus"></i></div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php $x++; @endphp
                                    @endforeach
                                @endif
                            </div>                            
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Meta Title')}}</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="meta_title" value="{{ $category->meta_title }}" placeholder="{{translate('Meta Title')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Meta Description')}}</label>
                        <div class="col-md-9">
                            <textarea name="meta_description" rows="5" class="form-control">{{ $category->meta_description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Slug')}}</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="{{translate('Slug')}}" id="slug" name="slug" value="{{ $category->slug }}" class="form-control">
                        </div>
                    </div>
                    @if (get_setting('category_wise_commission') == 1)
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{translate('Commission Rate')}}</label>
                            <div class="col-md-9 input-group">
                                <input type="number" lang="en" min="0" step="0.01" id="commision_rate" name="commision_rate" value="{{ $category->commision_rate }}" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Filtering Attributes')}}</label>
                        <div class="col-md-9">
                            <select class="select2 form-control aiz-selectpicker" name="filtering_attributes[]" data-toggle="select2" data-placeholder="Choose ..."data-live-search="true" data-selected="{{ $category->attributes->pluck('id') }}" multiple>
                                @foreach (\App\Models\Attribute::all() as $attribute)
                                    <option value="{{ $attribute->id }}">{{ $attribute->getTranslation('name') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
<script> 
AIZ.plugins.textEditor();
    function addFaq(elem)
    {
        var dataId = parseFloat($('.faq-fields').last().attr('data-id')) + 1;
        var html = '<div class="faq-fields mb-2" id="id_'+ dataId +'" data-id="'+ dataId +'"><div class="row"><div class="col-md-5"><input type="text" class="form-control mb-1" name="question[]" value="" placeholder="Question"></div><div class="col-md-5"><textarea type="text" class="form-control mb-1" name="answer[]" placeholder="Answer"></textarea></div><div class="col-md-2 change"><div class="btn-faq-f mb-1"><div class="btn btn-block btn-success" onclick="addFaq(this)"><i class="las la-plus"></i></div></div></div></div></div>';    
        $(".faq-block").append(html);
        $(elem).closest('.btn-faq-f').html('<div class="btn btn-block btn-danger" onclick="removeFaq(this);"><i class="las la-minus"></i></div>');
        $('.faq-fields').last()[0].scrollIntoView({ behavior: 'smooth' });
    }
    
    function removeFaq(elem)
    {
        $(elem).closest('.faq-fields').remove();
    }
</script>