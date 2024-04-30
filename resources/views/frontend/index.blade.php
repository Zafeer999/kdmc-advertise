<x-frontend.layout>

    <div id="textToSpeak">
        <div class="searchfilter">
            <div class="clearfix"></div>
        </div>
        <section class="sliders animate__animated animate__fadeIn">


            {{-- <div class="welcome Header">
                <img src="{{ asset('admin/dist/images/marathi.png') }}" alt="" class="img-fluid mb-md-4 mb-sm-2" style="width: 250px;">
                <h1>TEMPORARY ADVERTISE PERMISSION</h1>
            </div> --}}

            <div class="container-fluid p-0">

                <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class='carousel-inner banners'>
                        <div class='carousel-item active'>
                            <img src="{{ asset('frontend/img/banner_bg_img.jpg') }}" alt="">
                        </div>
                        <div class='carousel-item'>
                            <img src="{{ asset('frontend/img/banner_bg_img.jpg') }}" alt="">
                        </div>
                        <div class='carousel-item'>
                            <img src="{{ asset('frontend/img/banner_bg_img.jpg') }}" alt="">
                        </div>
                        <div class='carousel-item'>
                            <img src="{{ asset('frontend/img/banner_bg_img.jpg') }}" alt="">
                        </div>
                        <div class='carousel-item'>
                            <img src="{{ asset('frontend/img/banner_bg_img.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="megaMenus">
            <ul class="d-md-flex">
                <li class="flex-fill normalMenu"><a href="{{ route('application-form') }}"><i class="bi bi-vector-pen"></i> Apply Temporary Advertise Permission </a>
                    {{-- <div class="megaMenusList megaMenusListFirst"><a class="close fs-3"><i class="bi bi-x-square-fill"></i></a>
                        <ul class="row listLink menuIconList">
                            <li class="col"><a href="img/1560/General Information"><img class="img-fluid" src="{{ asset('frontend/img/icon/gr.png') }}" />परिचय</a></li>
                            <li class="col"><a href="img/1561/Schooling"><img class="img-fluid" src="{{ asset('frontend/img/icon/student.png') }}" />शाळा</a></li>
                            <li class="col"><a href="img/1563/Colleges and Universities"><img class="img-fluid" src="{{ asset('frontend/img/icon/college.png') }}" />महाविद्यालये आणि विद्यापीठे</a></li>
                            <li class="col"><a href="img/1564/Vocational Courses"><img class="img-fluid" src="{{ asset('frontend/img/icon/course.png') }}" />व्यावसायिक अभ्यासक्रम</a></li>
                            <li class="col"><a href="img/1562/Services"><img class="img-fluid" src="{{ asset('frontend/img/icon/requirement.png') }}" />सेवा </a></li>
                        </ul>
                    </div> --}}
                </li>
                <li class="flex-fill normalMenu"><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><span class="farming"><img src="{{ asset('frontend/img/farm.png') }}" /></span> GR </a>
                    {{-- <div class="megaMenusList megaMenusListFirst"><a class="close fs-3"><i class="bi bi-x-square-fill"></i></a>
                        <ul class="row listLink menuIconList">
                            <li class="col"><a href="img/1599/Introduction"><img class="img-fluid" src="{{ asset('frontend/img/icon/gr.png') }}" />परिचय </a></li>
                            <li class="col"><a href="img/1600/Essentials"><img class="img-fluid" src="{{ asset('frontend/img/gardening.png') }}" />मूलभूत घटक </a></li>
                            <li class="col"><a href="img/1604/scheme"><img class="img-fluid" src="{{ asset('frontend/img/process.png') }}" />योजना</a></li>
                            <li class="col"><a href="img/1601/Innovations"><img class="img-fluid" src="{{ asset('frontend/img/light-bulb.png') }}" />नाविन्याची कास</a></li>
                            <li class="col"><a href="img/1605/Allied Businesses"><img class="img-fluid" src="{{ asset('frontend/img/handshake.png') }}" />पुरक उद्योग</a></li>
                        </ul>
                    </div> --}}
                </li>
                <li class="flex-fill fullMenu"><a href="#"><i class="bi bi-briefcase"></i> Grivience </a>
                    {{-- <div class="megaMenusList megaMenusListFirst"><a class="close fs-3"><i class="bi bi-x-square-fill"></i></a>
                        <ul class="row listLink menuIconList">
                            <li class="col"><a href="img/1588/Overview"><img class="img-fluid" src="{{ asset('frontend/img/icon/gr.png') }}" />प्रस्तावना</a></li>
                            <li class="col"><a href="img/1592/Starting a Buisness"><img class="img-fluid" src="{{ asset('frontend/img/makeinindia.png') }}" />उद्योगाची पायाभरणी </a></li>
                            <li class="col"><a href="img/1596/Operate%20and%20Grow"><img class="img-fluid" src="{{ asset('frontend/img/startup.png') }}" />भरभराट</a></li>
                            <li class="col"><a href="img/1606/Closing a Business"><img class="img-fluid" src="{{ asset('frontend/img/icon/certificate.png') }}" />समापन</a></li>
                        </ul>
                    </div> --}}
                </li>
                @auth
                    @php
                        $id = App\Models\HoardingPermission::wherePaymentStatus(1)->where('user_id', Auth::id())->whereStatus(1)->latest()->value('id');
                    @endphp
                    @if ($id)
                        <li class="flex-fill fullMenu"><a href="{{ route('download-qr-code', $id) }}"><i class="bi bi-wrench-adjustable-circle"></i> Get Your QR Code </a>
                    @else
                        <li class="flex-fill fullMenu"><a href="{{ route('qr-code-list') }}"><i class="bi bi-wrench-adjustable-circle"></i> Get Your QR Code </a>
                    @endif
                @endauth
                @guest
                    <li class="flex-fill fullMenu"><a href="#"><i class="bi bi-wrench-adjustable-circle"></i> Get Your QR Code </a>
                @endguest
                    {{-- <div class="megaMenusList megaMenusListFirst"><a class="close fs-3"><i class="bi bi-x-square-fill"></i></a>
                        <ul class="row listLink menuIconList">
                            <li class="col"><a href="img/1574/Beaches"><img class="img-fluid" src="{{ asset('frontend/img/beach.png') }}" />समुद्रकिनारे</a></li>
                            <li class="col"><a href="img/1575/Lakeview Stay"><img class="img-fluid" src="{{ asset('frontend/img/lake.png') }}" />सरोवराकाठी</a></li>
                            <li class="col"><a href="img/1577/Nature and Wildlife"><img class="img-fluid" src="{{ asset('frontend/img/forest.png') }}" />निसर्ग आणि वन्यजीव</a></li>
                            <li class="col"><a href="img/1579/Hill Stations"><img class="img-fluid" src="{{ asset('frontend/img/hill.png') }}" />थंड हवेची ठिकाणे</a></li>
                            <li class="col"><a href="img/1580/Heritage"><img class="img-fluid" src="{{ asset('frontend/img/parthenon.png') }}" />वारसा स्थळे</a></li>
                        </ul>
                    </div> --}}
                </li>
            </ul>
        </section>




    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Download GR</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">

                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Dowload</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <tr>
                                            <th scope="row">1</th>
                                            <td>ठाणे महानगरपालिका क्षेत्रात लावण्यात येणारे कापडी फलक, बॅनर, होर्डिंग व पोस्टर ई. यांचे नियंत्रणाबाबतची कार्यपद्धती व मार्गदर्शक सूचना</td>
                                            <td>
                                                <a class="btn btn-info" href="{{ asset('frontend/img/pdf_1.pdf') }}" target="_blank"><i class="fas fa-download"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>महाराष्ट्र शासन राजपत्र असाधारण भाग एक-अ—मध्य उप-विभाग</td>
                                            <td><a class="btn btn-info" href="{{ asset('frontend/img/pdf_2.pdf') }}" target="_blank"><i class="fas fa-download"></i></a></td>
                                        </tr> --}}
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

</x-frontend.layout>
