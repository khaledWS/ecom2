<div class="card-content collapse show">
    <div class="card-body">
        <!--------------------------- Form -------------------------->
        <form class="form" action="{{ route($formPostRouteName, $formPostRoutePara) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="form-body">
                <h5 class="form-section"><i class="ft-info"></i> Vendor information </h5>
                @if ($job == 'edit')
                    <input type="hidden" name="id" value="{{ $vendor->id }}">
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
                                    @if ($job == 'edit') value = "{{ $vendor->name }}" @else value = "{{ old('name') }}" @endif
                                    placeholder="Vendor name" name="name">
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
                            <label for="slug"> slug</label>
                            <div class="input-group">
                                <div id="for-test" onclick='myTest()' class="input-group-prepend">
                                    <button type="button" class="btn btn-info">
                                        <i class="la la-paper-plane"></i>
                                    </button>
                                </div>
                                <p class='form-control alert-blue-grey' id='slug'>
                                    @if ($job == 'edit')
                                        {{ $vendor->slug }}
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
                    <div class="col-md-6">
                        <!------------ main category field --------------->
                        <div class="form-group">
                            <label for="category">Category</label>
                            <div @if ($job == 'edit') onload="setAtt()" @endif class="input-group">
                                {{-- <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <div id="test" class="skin skin-flat">
                                            <input type="checkbox" id="is_main" class="form-control"
                                                @if ($job == 'edit') @if ($category->is_main) checked value = "{{ $category->is_main }}" @endif
                                            @else value="{{ old('is_main') }}" @endif
                                            placeholder="" name="is_main">
                                            <div onclick="isChecked()" class="hidden"></div>
                                        </div>
                                    </span>
                                </div> --}}
                                {{-- <input type="text"> --}}
                                <select placeholder="Select the main Category" id="category" name="category"
                                    class="select2 form-control"
                                    @if ($job == 'edit') value = "{{ $vendor->category->id }}" @else value = "{{ old('category') }}" @endif>
                                    <option value="" disabled selected>Select the Category</option>
                                    <optgroup label="Category Name">
                                        @isset($mainCategories)
                                            @foreach ($mainCategories as $mainCategory)
                                                <option @if ($job == 'edit' && $vendor->category->id == $mainCategory->id) selected @endif
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
                    @if ($job == 'edit')
                    <div class="col-md-6">
                        <!------------ main category field --------------->
                        <div class="form-group">
                            <label for="categories">sub Categories</label>
                            <div class="input-group">
                                <select multiple="multiple" placeholder="Select the sub categories" id="categories"
                                    name="categories[]" class="selectize-multiple input-group">
                                    @isset($subCategories)
                                        @foreach ($subCategories as $index => $subCategory)
                                            <option
                                                @if ($job == 'edit') @isset($vendor->categories)


                                                @foreach ($vendor->categories as $sub)
                                            @if ($sub == $subCategory->id)
                                            selected @endif
                                                @endforeach
                                            @endisset
                                    @endif
                                    value="{{ $subCategory->id }}">{{ $subCategory->name }}
                                    </option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        @error('categories')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    @endif
                </div>


            </div>
            <!--------------------------- END Row 2 -------------------------->

            <!--------------------------- Row 3 -------------------------->
            <div class="row">
                <!------------------ Col 3-1 -------------------->
                <div class="col-md-6">
                    <!------------ user field --------------->
                    <div class="form-group">
                        <label for="user"> User </label>
                        <div @if ($job == 'edit') onload="setAtt()" @endif class="input-group">
                            <select placeholder="Select the User" id="user" name="user" class="select2 form-control"
                                @if ($job == 'edit') value = "{{ $vendor->user->id }}" @else value = "{{ old('categories') }}" @endif>
                                <option value="" disabled selected>Select the categories</option>
                                <optgroup label="vendors">
                                    @isset($vendors)
                                        @foreach ($vendors as $staff)
                                            <option @if ($job == 'edit' && $vendor->user_id == $staff->id) selected @endif
                                                value="{{ $staff->id }}">{{ $staff->name }}
                                            </option>
                                        @endforeach
                                    @endisset
                                </optgroup>
                            </select>
                        </div>
                        @error('user_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!------------------ Col 3-2 -------------------->
                @if ($job == 'edit')
                <div class="col-md-6">
                    <!------------ staff field --------------->
                    <div class="form-group">
                        <label for="staff">staff</label>
                        <div class="input-group">
                            <select multiple="multiple" placeholder="Select the staff" id="staff" name="staff[]"
                                class="selectize-multiple input-group">
                                @isset($vendors)
                                    @foreach ($vendors as $index => $vendorUser)
                                        <option
                                            @if ($job == 'edit') @isset($vendor->staff)
                                            @foreach ($vendor->staff as $sub)
                                                @if ($sub == $vendorUser->id)
                                                selected @endif
                                            @endforeach
                                        @endisset
                                @endif
                                value="{{ $vendorUser->id }}">
                                {{ $vendorUser->name }}
                                </option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    @error('staff')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                @endif
            </div>

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
                        @if ($job == 'edit') value = "{{ $vendor->description }}" @else value = "{{ old('description') }}" @endif
                        placeholder="description" name="description">
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!------------------ Col 4-2 -------------------->
            <div class="col-md-6">
                <!------------ main category field --------------->
                <div class="form-group">
                    <label for="status">Status</label>
                    <div @if ($job == 'edit')  @endif class="input-group">
                        <select placeholder="Select the Status" id="status" name="status"
                            class="select2 form-control"
                            @if ($job == 'edit') value = "{{ $vendor->status }}" @else value = "{{ old('status') }}" @endif>
                            <option value="" disabled selected>Select the status</option>
                            @isset($statusList)
                                @foreach ($statusList as $status)
                                    <option @if ($job == 'edit' && $vendor->status == $status) selected @endif
                                        value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

        </div>
        <!--------------------------- END Row 4 -------------------------->


        <!--------------------------- Row 5 -------------------------->
        <div class="row">
            <!------------------ Col 5-1 -------------------->
            <div class="col-md-6">
                <!------------ Active field --------------->
                <div class="form-group">
                    <label class="block" for="active">Active</label>
                    <input hidden type="checkbox"
                        @if ($job == 'edit') value = "{{ $vendor->active }}" @else value = "{{ old('active') }}" @endif
                        name=" active" id="" class="switch form-control block"
                        @if ($job == 'edit') @if ($vendor->active == 1) checked @endif
                        @endif
                    />
                    @error('active')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!------------------ Col 5-2 -------------------->
            <div class="col-md-6">
                <!------------ Featured field --------------->
                <div class="form-group">
                    <label for="featured">Featured</label>
                    <div @if ($job == 'edit')  @endif class="input-group">
                        <select placeholder="Select the Status" id="featured" name="featured"
                            class="select2 form-control"
                            @if ($job == 'edit') value = "{{ $vendor->featured }}" @else value = "{{ old('featured') }}" @endif>
                            <option value="" disabled selected>Select the featured</option>
                            @isset($featuredList)
                                @foreach ($featuredList as $featured)
                                    <option @if ($job == 'edit' && $vendor->featured == $featured) selected @endif
                                        value="{{ $featured }}">{{ $featured }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

        </div>
        <!--------------------------- END Row 5 -------------------------->
        <!--------------------------- Row 6 -------------------------->
        <div class="row">
            <!---------------------------6-1 -------------------------->
            <div class="col-md-6">
                <!------------ profile field --------------->
                <div class="form-group">
                    <label for="profile">profile</label>
                    <div style="cursor: pointer;" class="custom-file" role='button'>
                        <input onchange="getFileData(this)" role='button'
                            class="form-control custom-file-input mt-1" type="file" id="inputGroupFile01"
                            name="profile"
                            @if ($job == 'edit') value = "{{ $vendor->profile }}" @else value = "{{ old('profile') }}" @endif>
                        <label id="fileLabel" class="custom-file-label" for="inputGroupFile01">Choose
                            File</label>
                        {{-- <span class="file-custom"></span> --}}
                    </div>
                    @error('profile')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                @if ($job == 'edit')
                    <img src="{{ $vendor->getProfile() }}" alt="{{ $vendor->name }}-photo"
                        class="img-fluid rounded-circle width-150 height-150">
                @endif
            </div>
            <!---------------------------6-2 -------------------------->
            <div class="col-md-6">
                <!------------ profile field --------------->
                <div class="form-group">
                    <label for="banner">banner</label>
                    <div style="cursor: pointer;" class="custom-file" role='button'>
                        <input onchange="getFileData(this)" role='button'
                            class="form-control custom-file-input mt-1" type="file" id="inputGroupFile02"
                            name="banner"
                            @if ($job == 'edit') value = "{{ $vendor->banner }}" @else value = "{{ old('banner') }}" @endif>
                        <label id="fileLabel" class="custom-file-label" for="inputGroupFile02">Choose
                            File</label>
                        {{-- <span class="file-custom"></span> --}}
                    </div>
                    @error('banner')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                @if ($job == 'edit')
                    <img src="{{ $vendor->getBanner() }}" alt="{{ $vendor->name }}-photo"
                        class="img-fluid rounded-circle width-150 height-150">
                @endif
            </div>
        </div>
        <!--------------------------- END Row 6 -------------------------->


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
