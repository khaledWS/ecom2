<div class="card-content collapse show">
    <div class="card-body">
        {{-- Begins Form --}}
        <form class="form" action="{{ route($formPostRouteName, $formPostRoutePara) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="form-body">
                <h5 class="form-section"><i class="ft-home"></i> بيانات القسم </h5>
                <input type="hidden" name="id" value="{{ $mainCategory->id }}">

                {{-- First Row --}}
                <div class="row">
                    {{-- First Col --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mc_name"> اسم القسم </label>
                            <input type="text" id="name" class="form-control" value="{{ $mainCategory->mc_name }}"
                                placeholder="ادخل اسم القسم" name="category[0][mc_name]">
                            @error('category.*.mc_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- 2nd Col --}}
                    {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> وصف القسم </label>
                                <input type="text" value="{{ $language->lang_abbr }}" id="name"
                                    class="form-control" placeholder="ادخل أختصار اللغة  "
                                    name="lang_abbr">
                                @error('lang_abbr')
                                    <span class="text-danger">{{ $message }} </span>
                                @enderror
                            </div>
                        </div> --}}
                </div>

                {{-- 2ND rOW --}}
                <div class="row">
                    {{-- 2-1 --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="mc_description">الوصف</label>
                            <textarea class=" form-control-sm. form-control" name="category[0][mc_Description]"
                                id="mc_description" cols="10" rows="5">{{ $mainCategory->mc_Description }}</textarea>
                            @error('category.0.mc_Description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- 2-2 --}}
                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="mc_photo">صوره
                                القسم*</label>
                            <input class="form-control-file" type="file" id="file" name="category[0][mc_photo]">
                            <span class="file-custom"></span>
                            @error('category.0.mc_photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <img src="{{ $mainCategory->getPhoto() }}" alt="category-photo"
                            class="img-fluid rounded-circle width-150 height-150">
                    </div>

                </div>

                {{-- 3RD ROW --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mt-1">
                            <input type="checkbox" value="{{ $mainCategory->mc_active }}"
                                name="category[0][mc_active]" id="switcheryColor4" class="switchery"
                                data-color="success" @if ($mainCategory->mc_active == 1) checked @endif />
                            <label for="switcheryColor4" class="ml-1">الحالة
                            </label>
                            @error('category.0.mc_active')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- FORM ACTIONS --}}
            <div class="form-actions">
                <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                    <i class="ft-x"></i> تراجع
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="la la-check-square-o"></i> تحديث
                </button>
            </div>

        </form>
    </div>
</div>
