<?php
$lists = [
    'القائمة الرئيسية' => [],
    'التدقيق' => [
        'ادخال اقساط المؤسسات' => 'url1',
        'استعلام اقساط المؤسسات' => 'url1',
        'استعلام الافادة المالية' => 'url1',
        'استعلام البطاقات المطبوعة' => 'url1',
        'استعلام التخفيض المالي من وزارة التنمية' => 'url1',
        'استعلام التخفيضات المالية' => 'url1',
        'استعلام التخفيضات حسب المستخدم' => 'url1',
        'استعلام تامينات الشؤون المعدلة' => 'url1',
        'استعلام طلبات التخفيض السابقة من التنمية' => 'url1',
        'ضافة التخفيضات المالية' => 'url1',
        'اضافة مركز دفع للموظف' => 'url1',
        'السجلات المحذوفة بعد التحديث من الحاسوب' => 'url1',
        'تدقيق تسجيل دخول المستخدمين' => 'url1',
        'شاشة استعلام السجلات المضافة و المحذوفة' => 'url1',
        'شاشة اعتماد و حذف صور المواطنين' => 'url1',
        '' => 'url1',
    ],
    'التقارير' => [],
    'الدفعات' => [],
    'النظام العام' => [],
    'صاحب التأمين والمرافقين' => [],
    // 'استعلام بيانات' => ['test1' => 'url1', 'test2' => 'url2'],
    // 'اضافة خبرات المواطنين' => [],
    // 'اضافة صور المؤمن والمرافقين' => [],
    // 'اضافة وتعديل بيانات مؤمن عسكري' => [],
    // 'اضافة وتعديل بيانات مؤمن' => [],
    // 'الاستعلام العام' => [],
    // 'الاستعلام عن تاريخ المؤمن' => [],
    // 'الغاء بطاقات التامين' => [],
    // 'تأمينات العمال التي عليها سجلات' => [],
    // 'تعديل اضافة المرافق' => [],
    // 'تعديل بداية & سريات مفعول التأمين' => [],
    // 'تغيير رقم الهوية' => [],
    // 'تغيير وضع مؤمن' => [],
    // 'حذف تامين بالانتظار' => [],
    // 'قائمة المؤمنين' => [],
];
?>




<!--begin::Aside Menu-->
<div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
    data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
    data-kt-scroll-offset="0">
    <!--begin::Menu-->
    <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
        id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
        @foreach ($lists as $key => $list)
            <div data-kt-menu-trigger="click" class="menu-item here  menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                        <span class="svg-icon svg-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title">{{ $key }}</span>
                    <span class="menu-arrow"></span>
                </span>
                @foreach ($list as $sub => $url)
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link" href="{{ $url }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ $sub }}</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

        {{-- <span class="menu-icon">
			<!--begin::Svg Icon | path: assets/media/icons/duotune/abstract/abs050.svg-->
			<<span class="svg-icon svg-icon-muted svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" width="24px"
					height="24px" viewBox="0 0 24 24" version="1.1">
					<circle fill="#000000" cx="12" cy="12" r="5" />
				</svg>
		</span>
		<!--end::Svg Icon-->
		</span> --}}


    </div>
    <!--end::Menu-->
</div>
<!--end::Aside Menu-->