<div class="card-content collapse show">
    <div class="card-body">
        <!--------------------------- Form -------------------------->
        <form class="form" action="{{ route($formPostRouteName, $formPostRoutePara) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="form-body">
                <h5 class="form-section"><i class="ft-info"></i> Category information </h5>
                @if ($job == 'edit')
                    <input type="hidden" name="id" value="{{ $category->id }}">
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
                                    @if ($job == 'edit') value = "{{ $category->name }}" @else value = "{{ old('name') }}" @endif
                                    placeholder="name of the Category" name="name">
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
                                    {{-- <span class="input-group-text" id="basic-addon1">@</span> --}}
                                    <button type="button" class="btn btn-info">
                                        <i class="la la-paper-plane"></i>
                                    </button>
                                </div>
                                {{-- <input hidden type="text" id="slug" class="form-control w-full" placeholder="slug" name="slug"
                                    aria-describedby="basic-addon1"
                                    @if ($job == 'edit') value = "{{ $category->slug }}" @else value = "{{ old('slug') }}" @endif
                                    readonly> --}}
                                {{-- <button type="button" class="btn btn-primary">
                                        <i class="la la-paper-plane"></i>
                                      </button> --}}
                                <p class='form-control alert-blue-grey' id='slug'>
                                    @if ($job == 'edit')
                                        {{ $category->slug }}
                                    @else
                                        {{ old('slug') }} @endif
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
                            <label for="is_main">is Main</label>
                            <label for="parent_category_id">&ensp;&ensp;Parent</label>
                            <div onload="setAtt()" class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <div id="test" class="skin skin-flat">
                                            <input type="checkbox" id="is_main" class="form-control"
                                                @if ($job == 'edit') @if ($category->is_main) checked value = "{{ $category->is_main }}" @endif
                                            @else value="{{ old('is_main') }}" @endif
                                            placeholder="" name="is_main">
                                            <div onclick="isChecked()" class="hidden"></div>
                                        </div>
                                    </span>
                                </div>
                                {{-- <input type="text"> --}}
                                <select placeholder="Select the Parent Category" id="parent_category_id"
                                    name="parent_category_id" class="select2 form-control"
                                    @if ($job == 'edit') value = "{{ $category->parent_category_id }}" @else value = "{{ old('parent_category_id') }}" @endif>
                                    <option value="" disabled selected>Select the Parent</option>
                                    <optgroup label="Category Name">
                                        @isset($mainCategories)
                                            @foreach ($mainCategories as $mainCategory)
                                                <option @if ($job == 'edit' && $category->parent_category_id == $mainCategory->id) selected @endif
                                                    value="{{ $mainCategory->id }}">{{ $mainCategory->name }}</option>
                                            @endforeach
                                        @endisset
                                    </optgroup>
                                </select>
                            </div>
                            @error('parent_category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!------------ description field --------------->
                        <div class="form-group">
                            <label for="description"> description</label>
                            <input type="description" id="description" class="form-control"
                                @if ($job == 'edit') value = "{{ $category->description }}" @else value = "{{ old('description') }}" @endif
                                placeholder="description" name="description">
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!------------------ Col 2-2 -------------------->

                </div>
                <!--------------------------- END Row 2 -------------------------->

                <!--------------------------- Row 3 -------------------------->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="block" for="active">Active</label>
                            <input hidden type="checkbox"
                                @if ($job == 'edit') value = "{{ $category->active }}" @else value = "{{ old('active') }}" @endif
                                name=" active" id="" class="switch form-control block"
                                @if ($job == 'edit') @if ($category->active == 1) checked @endif
                                @endif
                            />
                            @error('active')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!------------ logo field --------------->
                        <div class="form-group">
                            <label for="image">image</label>
                            <div style="cursor: pointer;" class="custom-file" role='button'>
                                <input onchange="getFileData(this)" role='button'
                                    class="form-control custom-file-input mt-1" type="file" id="inputGroupFile01"
                                    name="image"
                                    @if ($job == 'edit') value = "{{ $category->image }}" @else value = "{{ old('image') }}" @endif>
                                <label id="fileLabel" class="custom-file-label" for="inputGroupFile01">Choose
                                    File</label>
                                {{-- <span class="file-custom"></span> --}}
                            </div>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($job == 'edit')
                            <img src="{{ $category->getImage() }}" alt="{{ $category->name }}-photo"
                                class="img-fluid rounded-circle width-150 height-150">
                        @endif
                    </div>

                </div>
                <!--------------------------- END Row 3 -------------------------->



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
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/simple-line-icons/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/switch.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-switch.css') }}">
@endsection

@section('page-script')
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('app-assets/vendors/js/forms/toggle/switchery.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('app-assets/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/switch.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/tags/form-field.js') }}" type="text/javascript"></script>
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
            document.getElementById("fileLabel").innerHTML = filename;
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

        function myTest() {
            inputElem = "<input type='text' id='slug' class='form-control w-full' placeholder= 'slug' name='slug' aria-describedby='basic-addon1' @if ($job == 'edit') value = '{{ $category->slug }}' @else value = '{{ old('slug') }}' @endif>"
            // slugText = "<p class='form-control' id ='slug'></p>";
            slugText =  "<p class='form-control alert-blue-grey' id='slug'> @if ($job == 'edit'){{ $category->slug }}@else{{ old('slug') }}@endif</p>";
            // @if ($job == 'edit')
            //     {{ $category->slug }}@else{{ old('slug') }}
            // @endif <
            //     /p>";
            if (slugOn == 0) {
                $('#slug').replaceWith(inputElem);
                $('#slug').val("");
                document.getElementById("name").removeAttribute('oninput');
                document.getElementById('slug-info').setAttribute('hidden', '');
                // $('#slug-info').setAtt();
                slugOn = 1;
            } else {
                document.getElementById('slug-info').removeAttribute('hidden');
                textBox1Val = document.getElementById("name").value;
                $('#slug').replaceWith(slugText);
                document.getElementById("name").setAttribute('oninput', 'getSlug()');
                $('#slug').html(string_to_slug(textBox1Val));
                slugOn = 0;
            }
        }
    </script>
@endsection
