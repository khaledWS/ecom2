<div class="card-content collapse show">
    <div class="card-body">
        <!--------------------------- Form -------------------------->
        <form class="form" action="{{ route($formPostRouteName, $formPostRoutePara) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="form-body">
                <h5 class="form-section"><i class="ft-info"></i> Vendor information </h5>
                @if ($job == 'edit')
                    <input type="hidden" name="id" value="{{ $product->id }}">
                @endif

                <!--------------------------- Row 1 -------------------------->
                <div class="row">
                    <!------------------ Col 1-1 -------------------->
                    <div class="col-md-6">
                        <!------------ name field --------------->
                        <div class="form-group">
                            <label for="name"> name </label>
                            <div class="input-group">
                                <input oninput="getSlug()" type="text" id="name" class="form-control"
                                    @if ($job == 'edit') value = "{{ $product->name }}" @else value = "{{ old('name') }}" @endif
                                    placeholder="product name" name="name">
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!------------------ Col 1-2 -------------------->
                    <div class="col-md-6">
                        <!------------ slug field --------------->
                        <div class="form-group">
                            <label for="slug">slug</label>
                            <div class="input-group">
                                <div id="for-test" onclick='myTest()' class="input-group-prepend">
                                    <button type="button" class="btn btn-info">
                                        <i class="la la-paper-plane"></i>
                                    </button>
                                </div>
                                <p class='form-control alert-blue-grey' id='slug'>
                                    @if ($job == 'edit')
                                        {{ $product->slug }}
                                    @else
                                        {{ old('slug') }}
                                    @endif
                                </p>
                            </div>
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div id="slug-info" class="font-small-1">the Slug will be generated from the name</div>
                        </div>

                    </div>
                </div>
                <!--------------------------- END Row 1 -------------------------->

                <!--------------------------- Row 2 -------------------------->
                <div class="row">
                    <!------------------ Col 2-1 -------------------->
                    <div class="col-md-4">
                        <!------------ main category field --------------->
                        <div class="form-group">
                            <label for="category">Category</label>
                            <div @if ($job == 'edit') onload="setAtt()" @endif class="input-group">
                                <select placeholder="Select the main Category" id="category" name="category"
                                    class="select2 form-control"
                                    @if ($job == 'edit') value = "{{ $product->category->id }}" @else value = "{{ old('category') }}" @endif>
                                    <option value="" disabled selected>Select the Category</option>
                                    <optgroup label="Category Name">
                                        @isset($mainCategories)
                                            @foreach ($mainCategories as $mainCategory)
                                                <option @if ($job == 'edit' && $product->category->id == $mainCategory->id) selected @endif
                                                    value="{{ $mainCategory->id }}">{{ $mainCategory->name }}</option>
                                            @endforeach
                                        @endisset
                                    </optgroup>
                                </select>
                            </div>
                            @error('category')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!------------------ Col 2-2 -------------------->
                    <div class="col-md-4">
                        <!------------ vendor field --------------->
                        <div class="form-group">
                            <label for="vendor">vendor</label>
                            <div @if ($job == 'edit') onload="setAtt()" @endif class="input-group">
                                <select placeholder="Select vendor" id="vendor" name="vendor"
                                    class="select2 form-control"
                                    @if ($job == 'edit') value = "{{ $product->vendor->id }}" @else value = "{{ old('vendor') }}" @endif>
                                    <option value="" disabled selected>Select the vendor</option>
                                    <optgroup label="vendor Name">
                                        @isset($vendors)
                                            @foreach ($vendors as $vendor)
                                                <option @if ($job == 'edit' && $product->vendor->id == $vendor->id) selected @endif
                                                    value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                            @endforeach
                                        @endisset
                                    </optgroup>
                                </select>
                            </div>
                            @error('vendor')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!------------------ Col 2-3 -------------------->
                    <div class="col-md-4">
                        <!------------ parent product field --------------->
                        <div class="form-group">
                            <label for="product_id">parent product?</label>
                            <div @if ($job == 'edit') onload="setAtt()" @endif class="input-group">
                                <select placeholder="Select parent product" id="product_id" name="product_id"
                                    class="select2 form-control"
                                    @if ($job == 'edit') value = "" @else value = "{{ old('product_id') }}" @endif>
                                    <option value="" disabled selected>Select the vendor</option>
                                    <optgroup label="product Name">
                                        @isset($mainProducts)
                                            @foreach ($mainProducts as $parent)
                                                <option @if ($job == 'edit' && $product->parentProduct->id == $parent->id) selected @endif
                                                    value="{{ $parent->id }}">{{ $parent->name }}</option>
                                            @endforeach
                                        @endisset
                                    </optgroup>
                                </select>
                            </div>
                            @error('product_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <!--------------------------- END Row 2 -------------------------->

                <!--------------------------- Row 3 -------------------------->
                <div class="row">
                    <!------------------ Col 3-1 -------------------->
                    <div class="col-md-6">
                        <!------------ main tag field --------------->
                        <div class="form-group">
                            <label for="tag"> main Tag </label>
                            <div @if ($job == 'edit') onload="setAtt()" @endif class="input-group">
                                <select placeholder="Select tag" id="tag" name="tag" class="select2 form-control"
                                    @if ($job == 'edit') value = "{{ $product->tag }}" @else value = "{{ old('tag') }}" @endif>
                                    <option value="" disabled selected>Select tag</option>
                                    <optgroup label="tag">
                                        @isset($tagList)
                                            @foreach ($tagList as $tag)
                                                <option @if ($job == 'edit' && $product->tag == $tag) selected @endif
                                                    value="{{ $tag }}">
                                                    {{ $tag }}
                                                </option>
                                            @endforeach
                                        @endisset
                                    </optgroup>
                                </select>
                            </div>
                            @error('tag')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!------------------ Col 3-2 -------------------->
                    {{-- @if ($job == 'edit')
                        <div class="col-md-6">
                            <!------------ tags field --------------->
                            <div class="form-group">
                                <label for="tags">other tags</label>
                                <div class="input-group">
                                    <select multiple="multiple" placeholder="Select tags" id="tags" name="tags[]"
                                        class="selectize-multiple input-group">
                                        @isset($tagList)
                                            @foreach ($tagList as $index => $tag)
                                                <option
                                                    @if ($job == 'edit') @isset($product->tags)
                                            @foreach ($product->tags as $sub)
                                                @if ($sub == $tag)
                                                selected @endif
                                                    @endforeach
                                                @endisset
                                        @endif
                                        value="{{ $tag }}">
                                        {{ $tag }}
                                        </option>

                                    </select>
                                </div>
                                @error('tags')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif --}}

                </div>
                <!--------------------------- END Row 3 -------------------------->


                <!--------------------------- Row 4 -------------------------->
                <div class="row">
                    <!------------------ Col 4-1 -------------------->
                    <div class="col-md-6">
                        <!------------ description field --------------->
                        <div class="form-group">
                            <label for="description"> description</label>
                            <input type="description" id="description" class="form-control"
                                @if ($job == 'edit') value = "{{ $product->description }}" @else value = "{{ old('description') }}" @endif
                                placeholder="description" name="description">
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!------------------ Col 4-2 -------------------->
                    <div class="col-md-6">
                        <!------------ info field --------------->
                        <div class="form-group">
                            <label for="info"> info</label>
                            <input type="text" id="info" class="form-control"
                                @if ($job == 'edit') value = "{{ $product->info }}" @else value = "{{ old('info') }}" @endif
                                placeholder="info" name="info_init">
                            @error('info')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <input type="text" id="info-true" class="form-control hidden"
                            @if ($job == 'edit') value = "{{ $product->info }}" @else value = "{{ old('info') }}" @endif
                            placeholder="info" name="info">
                        {{-- Have it that when we enter to the  field displayed and then enter whatever enterd gets a line in this div --}}
                        <div id="the-info"></div>
                    </div>

                </div>
                <!--------------------------- END Row 4 -------------------------->

                <!--------------------------- Row 5 -------------------------->
                <div class="row">
                    <!------------------ Col 5-1 -------------------->
                    <div class="col-md-6">
                        <!------------ details field --------------->
                        <div class="form-group">
                            <label for="details"> details</label>
                            <input type="text" id="details" class="form-control"
                                @if ($job == 'edit') value = "{{ $product->info }}" @else value = "" @endif
                                placeholder="details" name="details_init">
                            @error('details')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="details-true" class="form-control hidden"
                                @if ($job == 'edit') value = "{{ $product->details }}" @else value = "{{ old('details') }}" @endif
                                placeholder="details" name="details">
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="details-true" class="form-control hidden"
                                @if ($job == 'edit') value = "{{ $product->details }}" @else value = "{{ old('details') }}" @endif
                                placeholder="details" name="details">
                        </div>
                        {{-- Have it that when we enter to the  field displayed and then enter whatever enterd gets a line in this div --}}
                        <div id="the-details"></div>
                    </div>
                    <!------------------ Col 5-2 -------------------->
                    <div class="col-md-6">
                        <!------------ Featured field --------------->
                        <div class="form-group">
                            <label for="featured">Featured</label>
                            <div @if ($job == 'edit')  @endif class="input-group">
                                <select placeholder="Select the Status" id="featured" name="featured"
                                    class="select2 form-control"
                                    @if ($job == 'edit') value = "{{ $product->featured }}" @else value = "{{ old('featured') }}" @endif>
                                    <option value="" disabled selected>Select the featured</option>
                                    @isset($featuredList)
                                        @foreach ($featuredList as $featured)
                                            <option @if ($job == 'edit' && $product->featured == $featured) selected @endif
                                                value="{{ $featured }}">
                                                {{ $featured }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            @error('featured')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                </div>
                <!--------------------------- END Row 5 -------------------------->

                <!--------------------------- Row 6 -------------------------->
                <div class="row">
                    <!------------------ Col 6-1 -------------------->
                    <div class="col-md-3">
                        <!------------ base_price field --------------->
                        <div class="form-group">
                            <label for="base_price">base price</label>
                            <input type="text" id="base_price" class="form-control"
                                @if ($job == 'edit') value = "{{ $product->base_price }}" @else value = "{{ old('base_price') }}" @endif
                                placeholder="base price" name="base_price">
                            @error('base_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!------------------ Col 6-2 -------------------->
                    <div class="col-md-3">
                        <!------------ base_tax field --------------->
                        <div class="form-group">
                            <label for="base_tax">base tax</label>
                            <input type="text" id="base_tax" class="form-control"
                                @if ($job == 'edit') value = "{{ $product->base_tax }}" @else value = "{{ old('base_tax') }}" @endif
                                placeholder="base tax" name="base_tax">
                            @error('base_tax')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!------------------ Col 6-3 -------------------->
                    <div class="col-md-3">
                        <!------------ in_stock field --------------->
                        <div class="form-group">
                            <label class="block" for="in_stock">in stock?</label>
                            <input hidden type="checkbox"
                                @if ($job == 'edit') value = "{{ $product->in_stock }}" @else value = "{{ old('in_stock') }}" @endif
                                name=" in_stock" id="in_stock" class="switch form-control block"
                                @if ($job == 'edit') @if ($product->in_stock == 1) checked @endif
                                @endif
                            />
                            @error('in_stock')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!------------------ Col 6-4 -------------------->
                    <div class="col-md-3">
                        <!------------ base_tax field --------------->
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" id="quantity" class="form-control"
                                @if ($job == 'edit') value = "{{ $product->quantity }}" @else value = "{{ old('quantity') }}" @endif
                                placeholder="quantity" name="quantity">
                            @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <!--------------------------- END Row 6 -------------------------->

                <!--------------------------- Row 7 -------------------------->
                <div class="row">
                    <!------------------ Col 7-1 -------------------->
                    <div class="col-md-6">
                        <!------------ Active field --------------->
                        <div class="form-group">
                            <label class="block" for="active">Active</label>
                            <input hidden type="checkbox"
                                @if ($job == 'edit') value = "{{ $product->active }}" @else value = "{{ old('active') }}" @endif
                                name=" active" id="" class="switch form-control block"
                                @if ($job == 'edit') @if ($product->active == 1) checked @endif
                                @endif
                            />
                            @error('active')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!------------------ Col 7-2 -------------------->
                    <div class="col-md-6">
                        <!------------ discounts field --------------->
                        <div class="form-group">
                            <label for="discount_id">discount</label>
                            <div @if ($job == 'edit') onload="setAtt()" @endif class="input-group">
                                <select placeholder="Select discount" id="discount_id" name="discount_id"
                                    class="select2 form-control"
                                    @if ($job == 'edit') value = "" @else value = "{{ old('discount_id') }}" @endif>
                                    <option value="" disabled selected>Select discount</option>
                                    <optgroup label="discount ">
                                        @isset($discountList)
                                            @foreach ($discountList as $discount)
                                                <option @if ($job == 'edit' && $product->discount->id == $discount->id) selected @endif
                                                    value="{{ $discount->id }}">{{ $discount->name }}</option>
                                            @endforeach
                                        @endisset
                                    </optgroup>
                                </select>
                            </div>
                            @error('discount_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                </div>
                <!--------------------------- END Row 7 -------------------------->


                <!--------------------------- Row 8 -------------------------->
                <div class="row">
                    <!---------------------------6-1 -------------------------->
                    <div class="col-md-6">
                        <!------------ profile field --------------->
                        <div class="form-group">
                            <label for="image">front image</label>
                            <div style="cursor: pointer;" class="custom-file" role='button'>
                                <input onchange="getFileData(this)" role='button'
                                    class="form-control custom-file-input mt-1" type="file" id="inputGroupFile01"
                                    name="image"
                                    @if ($job == 'edit') value = "{{ $product->image }}" @else value = "{{ old('image') }}" @endif>
                                <label id="fileLabel" class="custom-file-label" for="inputGroupFile01">Choose
                                    File</label>
                                {{-- <span class="file-custom"></span> --}}
                            </div>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($job == 'edit')
                            <img src="{{ $product->getImage() }}" alt="{{ $product->name }}-photo"
                                class="img-fluid rounded-circle width-150 height-150">
                        @endif
                    </div>
                    <!---------------------------6-2 -------------------------->
                    <div class="col-md-6">
                        <!------------ profile field --------------->
                        <div class="form-group">
                            <label for="image2">image2</label>
                            <div style="cursor: pointer;" class="custom-file" role='button'>
                                <input onchange="getFileData(this)" role='button'
                                    class="form-control custom-file-input mt-1" type="file" id="inputGroupFile02"
                                    name="image2"
                                    @if ($job == 'edit') value = "{{ $product->image }}" @else value = "{{ old('image2') }}" @endif>
                                <label id="fileLabel" class="custom-file-label" for="inputGroupFile02">Choose
                                    File</label>
                                {{-- <span class="file-custom"></span> --}}
                            </div>
                            @error('banner')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($job == 'edit')
                            <img src="{{ $product->getImage() }}" alt="{{ $product->name }}-photo"
                                class="img-fluid rounded-circle width-150 height-150">
                        @endif
                    </div>
                </div>
                <!--------------------------- END Row 8 -------------------------->


                <!--------------------------- Actions -------------------------->
                <div class="form-actions right">
                    <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                        <i class="ft-x"></i> go back
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i> Submit
                    </button>
                </div>
                <!--------------------------- END Actions -------------------------->

        </form>
        <!--------------------------- END Form -------------------------->

    </div>
</div>

@section('page-css')
    <!-- BEGIN PAGE VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/toggle/switchery.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/selectize.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/app-assets/vendors/css/forms/selects/selectize.default.css') }}">
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/simple-line-icons/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/switch.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-switch.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/selectize/selectize.css') }}">
@endsection

@section('page-script')
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('app-assets/vendors/js/forms/toggle/switchery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/selectize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('app-assets/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/switch.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/tags/form-field.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/select/form-selectize.js') }}" type="text/javascript"></script>
    {{-- <script src="{{ asset('app-assets\vendors\js\forms\icheck\icheck.min.js') }}" type="text/javascript"></script> --}}
@endsection

@section('script')
    <script>
        var slugOn = 0;
        $('.icheckbox_flat-green').addClass('icheckbox_flat');
        $('.icheckbox_flat-green').removeClass('icheckbox_flat-green');
        setAtt();

        function setAtt() {
            divvy = document.getElementsByClassName('iCheck-helper')[0];
            divvy.setAttribute('onclick', 'isChecked()');
        }

        function getSlug() {

            textBox1Val = $('#name').val();

            if ($('#slug').prop('nodeName') == "INPUT") {
                $('#slug').attr('value', string_to_slug(textBox1Val));
            } else(
                $('#slug').html(string_to_slug(textBox1Val))
            )
            return textBox1Val;
        }


        function string_to_slug(str) {
            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
            var to = "aaaaeeeeiiiioooouuuunc------";
            for (var i = 0, l = from.length; i < l; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // collapse whitespace and replace by -
                .replace(/-+/g, '-'); // collapse dashes

            return str;
        }

        function isChecked() {
            checkbox = document.getElementById("is_main");
            if (checkbox.checked) {
                document.getElementById("parent_category_id").disabled = true;
            } else
                document.getElementById("parent_category_id").disabled = false;
        }

        function getFileData(myFile) {
            var file = myFile.files[0];
            var filename = file.name;
            var idOf = $(myFile).attr('id');
            document.querySelectorAll('label[for=' + idOf + ']')[0].innerHTML = filename;
            // document.getElementById("fileLabel").innerHTML = filename;
        }

        function takeCharge() {
            if (document.getElementById("slug").hasAttribute('readonly')) {
                document.getElementById("slug").removeAttribute('readonly');
                document.getElementById("name").removeAttribute('oninput');
                $('#basic-addon1').addClass('border-3');
                // document.getElementsByClassName('input-group-prepend').addClass('w-full');
            } else {
                slug = document.getElementById("slug");
                slug.value = "";
                slug.setAttribute('readonly', '');
                document.getElementById("name").setAttribute('oninput', 'getSlug()');
                textBox1Val = document.getElementById("name").value;
                document.getElementById("slug").setAttribute('value', string_to_slug(textBox1Val));
                $('#basic-addon1').removeClass('border-3');
            }
        }

        // function getcate() {
        //     $.get("http://127.0.0.1:8000/admin/vendors/values/cate?cate=1", function(data, status) {
        //         cate = jQuery.parseJSON(data);
        //         let text = "";
        //         for(let x = 0; x<cate.length; x++){
        //             text = text+'<div data-value="'+cate[x].id+'" data-selectable="" class="option">'+cate[x].name+'</div>';

        //         }
        //         $('.selectize-dropdown-content').html(text);
        //     });
        // }
    </script>
@endsection
